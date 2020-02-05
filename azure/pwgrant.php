<?php 

require(__DIR__.'/vendor/autoload.php');

$httpclient = new \microsoft\adalphp\HttpClient;
$storage = new \microsoft\adalphp\OIDC\StorageProviders\SQLite(__DIR__.'/storagedb.sqlite');
$client = new \microsoft\adalphp\AAD\Client($httpclient, $storage);

require(__DIR__.'/config.php');

$client->set_clientid(ADALPHP_CLIENTID);

$client->set_clientsecret(ADALPHP_CLIENTSECRET);

$client->set_redirecturi(ADALPHP_CLIENTREDIRECTURI);

$returned = $client->rocredsrequest($_POST['email'], $_POST['password']);

if(@$returned['id_token']!=''){
	$idtoken = \microsoft\adalphp\AAD\IDToken::instance_from_encoded($returned['id_token']);

	$data = array(
		'first_name' => $idtoken->claim('given_name'),
		'last_name' => $idtoken->claim('family_name'),
		'display_name' => $idtoken->claim('name'),
		'email' => $idtoken->claim('upn')
		);
	echo json_encode(array('status' => 'success', 'dataresult' => $data));
}
else{
	echo json_encode(array('status' => 'error', 'dataresult' => '0'));
}


