<?php
define('BASEPATH', 'appmonitoring');
require 'application/config/database.php';
$link = @mysql_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(isset($_GET['verify'])){
    echo "success";
    die();
}

$appurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$result = array();

extract_elements('a', http_request($appurl));
$depth = 20;

$urls = $result;
$applicationid = {applicationid};
$report = array();
foreach($urls as $url) {
    $report[] = array(
        "url"           => $url,
        "status"        => check_alive($url),
        "assets"        => get_assets($url),
        "meta"          => get_meta($url),
        "header"        => get_info($url),
        "html"          => get_html($url)
    );
}

$return = array(
    "applicationid" => $applicationid,
    "ip"            => $_SERVER['SERVER_ADDR'],
    "port"          => $_SERVER['SERVER_PORT'],
    "dbconnect"     => check_db_connect(),
    "version"       => array(
        "php"           => phpversion(),
        "mysql"         => mysql_get_server_info()
    ),
    "certificate"   => array(
        "IssuedTo"      => @get_certificate($url)['subject']['CN'],
        "IssuedBy"      => @get_certificate($url)['issuer']['CN'],
        "ValidFrom"     => @get_certificate($url)['validFrom_time_t'],
        "validTo_time_t"=> @get_certificate($url)['validFrom_time_t']
    ),
    "urls"          => $report
);

echo json_encode($return, JSON_PRETTY_PRINT);

function check_db_connect(){
    if($GLOBALS['link']){
        return true;
    } else {
        return false;
    }
}

function get_assets($url) {
        $GLOBALS['depth'] = $GLOBALS['depth'] - 1;
        if($GLOBALS['depth'] == 0){
            return false;
        }
        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:47.0) Gecko/20100101 Firefox/47.0");
        $request_headers = [
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8;',
                        'Accept-Encoding: gzip, deflate',
                        "Connection: keep-alive",
                        "Content-Type: text/html; charset=UTF-8",

                    ];
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__).'/cookie.txt');
        $cl  = curl_exec($ch);
        $h = curl_getinfo($ch);
        $e = curl_error($ch);
        curl_close($ch);
        
        $regex_css = "/href=['\"](?P<css>([^'\"]+?\.css)[^'\"]*)/";
        $regex_js = "/src=['\"](?P<js>([^'\"]+?\.js)[^'\"]*)/";
        $regex_image = '/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s';
        $regex_video = '/<source(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s';
        preg_match_all($regex_css, $cl, $matches_css);
        preg_match_all($regex_js, $cl, $matches_js);
        preg_match_all($regex_image, $cl, $matches_images);
        preg_match_all($regex_video, $cl, $matches_videos);
        $result = array();
        
        foreach ($matches_css['css'] as $key => $value) {
            $link = $value;
            if(rtrim(ltrim(trim($link),"/"),"/") != ""){
                if(!filter_var($link, FILTER_VALIDATE_URL)){
                    if (strpos($link, 'cdn-akamai.mookie1.com')) {
                        $link = ltrim($link,"/");
                    } else {
                        $link = rtrim($GLOBALS['appurl'],"/") . "/" . ltrim($link,"/");
                    }
                    
                }
                $result[] = array(
                    "url"       => utf8_encode($link),
                    "status"    => check_alive($link)
                );
            }
        }
        
        foreach ($matches_js['js'] as $key => $value) {
            $link = $value;
            if(rtrim(ltrim(trim($link),"/"),"/") != ""){
                if(!filter_var($link, FILTER_VALIDATE_URL)){
                    if (strpos($link, 'cdn-akamai.mookie1.com')) {
                        $link = ltrim($link,"/");
                    } else {
                        $link = rtrim($GLOBALS['appurl'],"/") . "/" . ltrim($link,"/");
                    }
                }
                $result[] = array(
                    "url"       => utf8_encode($link),
                    "status"    => check_alive($link)
                );
            }
        }
        
        foreach ($matches_images[3] as $key => $value) {
            $link = $value;
            if(rtrim(ltrim(trim($link),"/"),"/") != ""){
                if(!filter_var($link, FILTER_VALIDATE_URL)){
                    if (strpos($link, 'cdn-akamai.mookie1.com')) {
                        $link = ltrim($link,"/");
                    } else {
                        $link = rtrim($GLOBALS['appurl'],"/") . "/" . ltrim($link,"/");
                    }
                }
                $result[] = array(
                    "url"       => utf8_encode($link),
                    "status"    => check_alive($link)
                );
            }
        }
        
        foreach ($matches_videos[3] as $key => $value) {
            $link = $value;
            if(rtrim(ltrim(trim($link),"/"),"/") != ""){
                if(!filter_var($link, FILTER_VALIDATE_URL)){
                    if (strpos($link, 'cdn-akamai.mookie1.com')) {
                        $link = ltrim($link,"/");
                    } else {
                        $link = rtrim($GLOBALS['appurl'],"/") . "/" . ltrim($link,"/");
                    }
                }
                $result[] = array(
                    "url"       => utf8_encode($link),
                    "status"    => check_alive($link)
                );
            }
        }

        return $result;
    }

function check_alive($url, $timeout = 10, $successOn = array(200, 301)) {
    $ch = curl_init($url);
    curl_setopt_array($ch, array(
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_NOBODY => true,
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_USERAGENT => "page-check/1.0",
        CURLOPT_SSL_VERIFYPEER => false 
    ));
    curl_exec($ch);
    if(curl_errno($ch)) {
        curl_close($ch);
        return false;
    }
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $code;
}

function get_meta($url){
    $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );
        
    return getMetaTags($content);
}


function getMetaTags($str)
{
  $pattern = '
  ~<\s*meta\s

  # using lookahead to capture type to $1
    (?=[^>]*?
    \b(?:name|property|http-equiv)\s*=\s*
    (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
    ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
  )

  # capture content to $2
  [^>]*?\bcontent\s*=\s*
    (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
    ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
  [^>]*>

  ~ix';
 
  if(preg_match_all($pattern, $str, $out))
    return array_combine($out[1], $out[2]);
  return array();
}

function http_request($url) {
        $GLOBALS['depth'] = $GLOBALS['depth'] - 1;
        if($GLOBALS['depth'] == 0){
            return false;
        }
        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:47.0) Gecko/20100101 Firefox/47.0");
        $request_headers = [
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8;',
                        'Accept-Encoding: gzip, deflate',
                        "Connection: keep-alive",
                        "Content-Type: text/html; charset=UTF-8",

                    ];
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__).'/cookie.txt');
        $cl  = curl_exec($ch);
        $h = curl_getinfo($ch);
        $e = curl_error($ch);
        curl_close($ch);
        return $cl;
   }

   function strip_whitespace($data) {
      $data = preg_replace('/\s+/', ' ', $data);
      return trim($data);
   }

   function extract_elements($tag, $data) {
      if($data == false){
           exit();
      }
      $response = array();
      $dom      = new DOMDocument;
      @$dom->loadHTML($data);
      foreach ( $dom->getElementsByTagName($tag) as $index => $element ) {
         foreach ( $element->attributes as $attribute ) {
             if( $attribute->nodeName == "href"){
                 $link = strip_whitespace($attribute->nodeValue);
                 if(in_array($link, $GLOBALS['result']) == false){
                     if(getBase($link)){
                         array_push($GLOBALS['result'],$link);
                         extract_elements('a', http_request($link));
                     }
                     
                 }
                 
             }
         }
      }
   }

    function getBase($url){
        $pu = parse_url($url);
        $base = $pu["scheme"] . "://" . $pu["host"];
        if($base == rtrim($GLOBALS['appurl'], '/')){
            return true;
        } else {
            return false;   
        }
    }

function get_html($url){
    $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );
        
    return $content;
}

function get_certificate($url){
    $orignal_parse = parse_url($url, PHP_URL_HOST);
    $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
    $read = @stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
    $cert = @stream_context_get_params($read);
    $certinfo = @openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
    return $certinfo;
}

function get_info($url){
    $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );
        
    return $header;
}

