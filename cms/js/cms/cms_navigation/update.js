AJAX.config.base_url(base_url);

var icons = [{ icon: 'fa fa-glass' }, { icon: 'fa fa-music' }, { icon: 'fa fa-search' }, { icon: 'fa fa-envelope-o' }, { icon: 'fa fa-heart' }, { icon: 'fa fa-star' }, { icon: 'fa fa-star-o' }, { icon: 'fa fa-user' }, { icon: 'fa fa-film' }, { icon: 'fa fa-th-large' }, { icon: 'fa fa-th' }, { icon: 'fa fa-th-list' }, { icon: 'fa fa-check' }, { icon: 'fa fa-times' }, { icon: 'fa fa-search-plus' }, { icon: 'fa fa-search-minus' }, { icon: 'fa fa-power-off' }, { icon: 'fa fa-signal' }, { icon: 'fa fa-cog' }, { icon: 'fa fa-trash-o' }, { icon: 'fa fa-home' }, { icon: 'fa fa-file-o' }, { icon: 'fa fa-clock-o' }, { icon: 'fa fa-road' }, { icon: 'fa fa-download' }, { icon: 'fa fa-arrow-circle-o-down' }, { icon: 'fa fa-arrow-circle-o-up' }, { icon: 'fa fa-inbox' }, { icon: 'fa fa-play-circle-o' }, { icon: 'fa fa-repeat' }, { icon: 'fa fa-refresh' }, { icon: 'fa fa-list-alt' }, { icon: 'fa fa-lock' }, { icon: 'fa fa-flag' }, { icon: 'fa fa-headphones' }, { icon: 'fa fa-volume-off' }, { icon: 'fa fa-volume-down' }, { icon: 'fa fa-volume-up' }, { icon: 'fa fa-qrcode' }, { icon: 'fa fa-barcode' }, { icon: 'fa fa-tag' }, { icon: 'fa fa-tags' }, { icon: 'fa fa-book' }, { icon: 'fa fa-bookmark' }, { icon: 'fa fa-print' }, { icon: 'fa fa-camera' }, { icon: 'fa fa-font' }, { icon: 'fa fa-bold' }, { icon: 'fa fa-italic' }, { icon: 'fa fa-text-height' }, { icon: 'fa fa-text-width' }, { icon: 'fa fa-align-left' }, { icon: 'fa fa-align-center' }, { icon: 'fa fa-align-right' }, { icon: 'fa fa-align-justify' }, { icon: 'fa fa-list' }, { icon: 'fa fa-outdent' }, { icon: 'fa fa-indent' }, { icon: 'fa fa-video-camera' }, { icon: 'fa fa-picture-o' }, { icon: 'fa fa-pencil' }, { icon: 'fa fa-map-marker' }, { icon: 'fa fa-adjust' }, { icon: 'fa fa-tint' }, { icon: 'fa fa-pencil-square-o' }, { icon: 'fa fa-share-square-o' }, { icon: 'fa fa-check-square-o' }, { icon: 'fa fa-arrows' }, { icon: 'fa fa-step-backward' }, { icon: 'fa fa-fast-backward' }, { icon: 'fa fa-backward' }, { icon: 'fa fa-play' }, { icon: 'fa fa-pause' }, { icon: 'fa fa-stop' }, { icon: 'fa fa-forward' }, { icon: 'fa fa-fast-forward' }, { icon: 'fa fa-step-forward' }, { icon: 'fa fa-eject' }, { icon: 'fa fa-chevron-left' }, { icon: 'fa fa-chevron-right' }, { icon: 'fa fa-plus-circle' }, { icon: 'fa fa-minus-circle' }, { icon: 'fa fa-times-circle' }, { icon: 'fa fa-check-circle' }, { icon: 'fa fa-question-circle' }, { icon: 'fa fa-info-circle' }, { icon: 'fa fa-crosshairs' }, { icon: 'fa fa-times-circle-o' }, { icon: 'fa fa-check-circle-o' }, { icon: 'fa fa-ban' }, { icon: 'fa fa-arrow-left' }, { icon: 'fa fa-arrow-right' }, { icon: 'fa fa-arrow-up' }, { icon: 'fa fa-arrow-down' }, { icon: 'fa fa-share' }, { icon: 'fa fa-expand' }, { icon: 'fa fa-compress' }, { icon: 'fa fa-plus' }, { icon: 'fa fa-minus' }, { icon: 'fa fa-asterisk' }, { icon: 'fa fa-exclamation-circle' }, { icon: 'fa fa-gift' }, { icon: 'fa fa-leaf' }, { icon: 'fa fa-fire' }, { icon: 'fa fa-eye' }, { icon: 'fa fa-eye-slash' }, { icon: 'fa fa-exclamation-triangle' }, { icon: 'fa fa-plane' }, { icon: 'fa fa-calendar' }, { icon: 'fa fa-random' }, { icon: 'fa fa-comment' }, { icon: 'fa fa-magnet' }, { icon: 'fa fa-chevron-up' }, { icon: 'fa fa-chevron-down' }, { icon: 'fa fa-retweet' }, { icon: 'fa fa-shopping-cart' }, { icon: 'fa fa-folder' }, { icon: 'fa fa-folder-open' }, { icon: 'fa fa-arrows-v' }, { icon: 'fa fa-arrows-h' }, { icon: 'fa fa-bar-chart' }, { icon: 'fa fa-twitter-square' }, { icon: 'fa fa-facebook-square' }, { icon: 'fa fa-camera-retro' }, { icon: 'fa fa-key' }, { icon: 'fa fa-cogs' }, { icon: 'fa fa-comments' }, { icon: 'fa fa-thumbs-o-up' }, { icon: 'fa fa-thumbs-o-down' }, { icon: 'fa fa-star-half' }, { icon: 'fa fa-heart-o' }, { icon: 'fa fa-sign-out' }, { icon: 'fa fa-linkedin-square' }, { icon: 'fa fa-thumb-tack' }, { icon: 'fa fa-external-link' }, { icon: 'fa fa-sign-in' }, { icon: 'fa fa-trophy' }, { icon: 'fa fa-github-square' }, { icon: 'fa fa-upload' }, { icon: 'fa fa-lemon-o' }, { icon: 'fa fa-phone' }, { icon: 'fa fa-square-o' }, { icon: 'fa fa-bookmark-o' }, { icon: 'fa fa-phone-square' }, { icon: 'fa fa-twitter' }, { icon: 'fa fa-facebook' }, { icon: 'fa fa-github' }, { icon: 'fa fa-unlock' }, { icon: 'fa fa-credit-card' }, { icon: 'fa fa-rss' }, { icon: 'fa fa-hdd-o' }, { icon: 'fa fa-bullhorn' }, { icon: 'fa fa-bell' }, { icon: 'fa fa-certificate' }, { icon: 'fa fa-hand-o-right' }, { icon: 'fa fa-hand-o-left' }, { icon: 'fa fa-hand-o-up' }, { icon: 'fa fa-hand-o-down' }, { icon: 'fa fa-arrow-circle-left' }, { icon: 'fa fa-arrow-circle-right' }, { icon: 'fa fa-arrow-circle-up' }, { icon: 'fa fa-arrow-circle-down' }, { icon: 'fa fa-globe' }, { icon: 'fa fa-wrench' }, { icon: 'fa fa-tasks' }, { icon: 'fa fa-filter' }, { icon: 'fa fa-briefcase' }, { icon: 'fa fa-arrows-alt' }, { icon: 'fa fa-users' }, { icon: 'fa fa-link' }, { icon: 'fa fa-cloud' }, { icon: 'fa fa-flask' }, { icon: 'fa fa-scissors' }, { icon: 'fa fa-files-o' }, { icon: 'fa fa-paperclip' }, { icon: 'fa fa-floppy-o' }, { icon: 'fa fa-square' }, { icon: 'fa fa-bars' }, { icon: 'fa fa-list-ul' }, { icon: 'fa fa-list-ol' }, { icon: 'fa fa-strikethrough' }, { icon: 'fa fa-underline' }, { icon: 'fa fa-table' }, { icon: 'fa fa-magic' }, { icon: 'fa fa-truck' }, { icon: 'fa fa-pinterest' }, { icon: 'fa fa-pinterest-square' }, { icon: 'fa fa-google-plus-square' }, { icon: 'fa fa-google-plus' }, { icon: 'fa fa-money' }, { icon: 'fa fa-caret-down' }, { icon: 'fa fa-caret-up' }, { icon: 'fa fa-caret-left' }, { icon: 'fa fa-caret-right' }, { icon: 'fa fa-columns' }, { icon: 'fa fa-sort' }, { icon: 'fa fa-sort-desc' }, { icon: 'fa fa-sort-asc' }, { icon: 'fa fa-envelope' }, { icon: 'fa fa-linkedin' }, { icon: 'fa fa-undo' }, { icon: 'fa fa-gavel' }, { icon: 'fa fa-tachometer' }, { icon: 'fa fa-comment-o' }, { icon: 'fa fa-comments-o' }, { icon: 'fa fa-bolt' }, { icon: 'fa fa-sitemap' }, { icon: 'fa fa-umbrella' }, { icon: 'fa fa-clipboard' }, { icon: 'fa fa-lightbulb-o' }, { icon: 'fa fa-exchange' }, { icon: 'fa fa-cloud-download' }, { icon: 'fa fa-cloud-upload' }, { icon: 'fa fa-user-md' }, { icon: 'fa fa-stethoscope' }, { icon: 'fa fa-suitcase' }, { icon: 'fa fa-bell-o' }, { icon: 'fa fa-coffee' }, { icon: 'fa fa-cutlery' }, { icon: 'fa fa-file-text-o' }, { icon: 'fa fa-building-o' }, { icon: 'fa fa-hospital-o' }, { icon: 'fa fa-ambulance' }, { icon: 'fa fa-medkit' }, { icon: 'fa fa-fighter-jet' }, { icon: 'fa fa-beer' }, { icon: 'fa fa-h-square' }, { icon: 'fa fa-plus-square' }, { icon: 'fa fa-angle-double-left' }, { icon: 'fa fa-angle-double-right' }, { icon: 'fa fa-angle-double-up' }, { icon: 'fa fa-angle-double-down' }, { icon: 'fa fa-angle-left' }, { icon: 'fa fa-angle-right' }, { icon: 'fa fa-angle-up' }, { icon: 'fa fa-angle-down' }, { icon: 'fa fa-desktop' }, { icon: 'fa fa-laptop' }, { icon: 'fa fa-tablet' }, { icon: 'fa fa-mobile' }, { icon: 'fa fa-circle-o' }, { icon: 'fa fa-quote-left' }, { icon: 'fa fa-quote-right' }, { icon: 'fa fa-spinner' }, { icon: 'fa fa-circle' }, { icon: 'fa fa-reply' }, { icon: 'fa fa-github-alt' }, { icon: 'fa fa-folder-o' }, { icon: 'fa fa-folder-open-o' }, { icon: 'fa fa-smile-o' }, { icon: 'fa fa-frown-o' }, { icon: 'fa fa-meh-o' }, { icon: 'fa fa-gamepad' }, { icon: 'fa fa-keyboard-o' }, { icon: 'fa fa-flag-o' }, { icon: 'fa fa-flag-checkered' }, { icon: 'fa fa-terminal' }, { icon: 'fa fa-code' }, { icon: 'fa fa-reply-all' }, { icon: 'fa fa-star-half-o' }, { icon: 'fa fa-location-arrow' }, { icon: 'fa fa-crop' }, { icon: 'fa fa-code-fork' }, { icon: 'fa fa-chain-broken' }, { icon: 'fa fa-question' }, { icon: 'fa fa-info' }, { icon: 'fa fa-exclamation' }, { icon: 'fa fa-superscript' }, { icon: 'fa fa-subscript' }, { icon: 'fa fa-eraser' }, { icon: 'fa fa-puzzle-piece' }, { icon: 'fa fa-microphone' }, { icon: 'fa fa-microphone-slash' }, { icon: 'fa fa-shield' }, { icon: 'fa fa-calendar-o' }, { icon: 'fa fa-fire-extinguisher' }, { icon: 'fa fa-rocket' }, { icon: 'fa fa-maxcdn' }, { icon: 'fa fa-chevron-circle-left' }, { icon: 'fa fa-chevron-circle-right' }, { icon: 'fa fa-chevron-circle-up' }, { icon: 'fa fa-chevron-circle-down' }, { icon: 'fa fa-html5' }, { icon: 'fa fa-css3' }, { icon: 'fa fa-anchor' }, { icon: 'fa fa-unlock-alt' }, { icon: 'fa fa-bullseye' }, { icon: 'fa fa-ellipsis-h' }, { icon: 'fa fa-ellipsis-v' }, { icon: 'fa fa-rss-square' }, { icon: 'fa fa-play-circle' }, { icon: 'fa fa-ticket' }, { icon: 'fa fa-minus-square' }, { icon: 'fa fa-minus-square-o' }, { icon: 'fa fa-level-up' }, { icon: 'fa fa-level-down' }, { icon: 'fa fa-check-square' }, { icon: 'fa fa-pencil-square' }, { icon: 'fa fa-external-link-square' }, { icon: 'fa fa-share-square' }, { icon: 'fa fa-compass' }, { icon: 'fa fa-caret-square-o-down' }, { icon: 'fa fa-caret-square-o-up' }, { icon: 'fa fa-caret-square-o-right' }, { icon: 'fa fa-eur' }, { icon: 'fa fa-gbp' }, { icon: 'fa fa-usd' }, { icon: 'fa fa-inr' }, { icon: 'fa fa-jpy' }, { icon: 'fa fa-rub' }, { icon: 'fa fa-krw' }, { icon: 'fa fa-btc' }, { icon: 'fa fa-file' }, { icon: 'fa fa-file-text' }, { icon: 'fa fa-sort-alpha-asc' }, { icon: 'fa fa-sort-alpha-desc' }, { icon: 'fa fa-sort-amount-asc' }, { icon: 'fa fa-sort-amount-desc' }, { icon: 'fa fa-sort-numeric-asc' }, { icon: 'fa fa-sort-numeric-desc' }, { icon: 'fa fa-thumbs-up' }, { icon: 'fa fa-thumbs-down' }, { icon: 'fa fa-youtube-square' }, { icon: 'fa fa-youtube' }, { icon: 'fa fa-xing' }, { icon: 'fa fa-xing-square' }, { icon: 'fa fa-youtube-play' }, { icon: 'fa fa-dropbox' }, { icon: 'fa fa-stack-overflow' }, { icon: 'fa fa-instagram' }, { icon: 'fa fa-flickr' }, { icon: 'fa fa-adn' }, { icon: 'fa fa-bitbucket' }, { icon: 'fa fa-bitbucket-square' }, { icon: 'fa fa-tumblr' }, { icon: 'fa fa-tumblr-square' }, { icon: 'fa fa-long-arrow-down' }, { icon: 'fa fa-long-arrow-up' }, { icon: 'fa fa-long-arrow-left' }, { icon: 'fa fa-long-arrow-right' }, { icon: 'fa fa-apple' }, { icon: 'fa fa-windows' }, { icon: 'fa fa-android' }, { icon: 'fa fa-linux' }, { icon: 'fa fa-dribbble' }, { icon: 'fa fa-skype' }, { icon: 'fa fa-foursquare' }, { icon: 'fa fa-trello' }, { icon: 'fa fa-female' }, { icon: 'fa fa-male' }, { icon: 'fa fa-gratipay' }, { icon: 'fa fa-sun-o' }, { icon: 'fa fa-moon-o' }, { icon: 'fa fa-archive' }, { icon: 'fa fa-bug' }, { icon: 'fa fa-vk' }, { icon: 'fa fa-weibo' }, { icon: 'fa fa-renren' }, { icon: 'fa fa-pagelines' }, { icon: 'fa fa-stack-exchange' }, { icon: 'fa fa-arrow-circle-o-right' }, { icon: 'fa fa-arrow-circle-o-left' }, { icon: 'fa fa-caret-square-o-left' }, { icon: 'fa fa-dot-circle-o' }, { icon: 'fa fa-wheelchair' }, { icon: 'fa fa-vimeo-square' }, { icon: 'fa fa-try' }, { icon: 'fa fa-plus-square-o' }, { icon: 'fa fa-space-shuttle' }, { icon: 'fa fa-slack' }, { icon: 'fa fa-envelope-square' }, { icon: 'fa fa-wordpress' }, { icon: 'fa fa-openid' }, { icon: 'fa fa-university' }, { icon: 'fa fa-graduation-cap' }, { icon: 'fa fa-yahoo' }, { icon: 'fa fa-google' }, { icon: 'fa fa-reddit' }, { icon: 'fa fa-reddit-square' }, { icon: 'fa fa-stumbleupon-circle' }, { icon: 'fa fa-stumbleupon' }, { icon: 'fa fa-delicious' }, { icon: 'fa fa-digg' }, { icon: 'fa fa-pied-piper' }, { icon: 'fa fa-pied-piper-alt' }, { icon: 'fa fa-drupal' }, { icon: 'fa fa-joomla' }, { icon: 'fa fa-language' }, { icon: 'fa fa-fax' }, { icon: 'fa fa-building' }, { icon: 'fa fa-child' }, { icon: 'fa fa-paw' }, { icon: 'fa fa-spoon' }, { icon: 'fa fa-cube' }, { icon: 'fa fa-cubes' }, { icon: 'fa fa-behance' }, { icon: 'fa fa-behance-square' }, { icon: 'fa fa-steam' }, { icon: 'fa fa-steam-square' }, { icon: 'fa fa-recycle' }, { icon: 'fa fa-car' }, { icon: 'fa fa-taxi' }, { icon: 'fa fa-tree' }, { icon: 'fa fa-spotify' }, { icon: 'fa fa-deviantart' }, { icon: 'fa fa-soundcloud' }, { icon: 'fa fa-database' }, { icon: 'fa fa-file-pdf-o' }, { icon: 'fa fa-file-word-o' }, { icon: 'fa fa-file-excel-o' }, { icon: 'fa fa-file-powerpoint-o' }, { icon: 'fa fa-file-image-o' }, { icon: 'fa fa-file-archive-o' }, { icon: 'fa fa-file-audio-o' }, { icon: 'fa fa-file-video-o' }, { icon: 'fa fa-file-code-o' }, { icon: 'fa fa-vine' }, { icon: 'fa fa-codepen' }, { icon: 'fa fa-jsfiddle' }, { icon: 'fa fa-life-ring' }, { icon: 'fa fa-circle-o-notch' }, { icon: 'fa fa-rebel' }, { icon: 'fa fa-empire' }, { icon: 'fa fa-git-square' }, { icon: 'fa fa-git' }, { icon: 'fa fa-hacker-news' }, { icon: 'fa fa-tencent-weibo' }, { icon: 'fa fa-qq' }, { icon: 'fa fa-weixin' }, { icon: 'fa fa-paper-plane' }, { icon: 'fa fa-paper-plane-o' }, { icon: 'fa fa-history' }, { icon: 'fa fa-circle-thin' }, { icon: 'fa fa-header' }, { icon: 'fa fa-paragraph' }, { icon: 'fa fa-sliders' }, { icon: 'fa fa-share-alt' }, { icon: 'fa fa-share-alt-square' }, { icon: 'fa fa-bomb' }, { icon: 'fa fa-futbol-o' }, { icon: 'fa fa-tty' }, { icon: 'fa fa-binoculars' }, { icon: 'fa fa-plug' }, { icon: 'fa fa-slideshare' }, { icon: 'fa fa-twitch' }, { icon: 'fa fa-yelp' }, { icon: 'fa fa-newspaper-o' }, { icon: 'fa fa-wifi' }, { icon: 'fa fa-calculator' }, { icon: 'fa fa-paypal' }, { icon: 'fa fa-google-wallet' }, { icon: 'fa fa-cc-visa' }, { icon: 'fa fa-cc-mastercard' }, { icon: 'fa fa-cc-discover' }, { icon: 'fa fa-cc-amex' }, { icon: 'fa fa-cc-paypal' }, { icon: 'fa fa-cc-stripe' }, { icon: 'fa fa-bell-slash' }, { icon: 'fa fa-bell-slash-o' }, { icon: 'fa fa-trash' }, { icon: 'fa fa-copyright' }, { icon: 'fa fa-at' }, { icon: 'fa fa-eyedropper' }, { icon: 'fa fa-paint-brush' }, { icon: 'fa fa-birthday-cake' }, { icon: 'fa fa-area-chart' }, { icon: 'fa fa-pie-chart' }, { icon: 'fa fa-line-chart' }, { icon: 'fa fa-lastfm' }, { icon: 'fa fa-lastfm-square' }, { icon: 'fa fa-toggle-off' }, { icon: 'fa fa-toggle-on' }, { icon: 'fa fa-bicycle' }, { icon: 'fa fa-bus' }, { icon: 'fa fa-ioxhost' }, { icon: 'fa fa-angellist' }, { icon: 'fa fa-cc' }, { icon: 'fa fa-ils' }, { icon: 'fa fa-meanpath' }, { icon: 'fa fa-buysellads' }, { icon: 'fa fa-connectdevelop' }, { icon: 'fa fa-dashcube' }, { icon: 'fa fa-forumbee' }, { icon: 'fa fa-leanpub' }, { icon: 'fa fa-sellsy' }, { icon: 'fa fa-shirtsinbulk' }, { icon: 'fa fa-simplybuilt' }, { icon: 'fa fa-skyatlas' }, { icon: 'fa fa-cart-plus' }, { icon: 'fa fa-cart-arrow-down' }, { icon: 'fa fa-diamond' }, { icon: 'fa fa-ship' }, { icon: 'fa fa-user-secret' }, { icon: 'fa fa-motorcycle' }, { icon: 'fa fa-street-view' }, { icon: 'fa fa-heartbeat' }, { icon: 'fa fa-venus' }, { icon: 'fa fa-mars' }, { icon: 'fa fa-mercury' }, { icon: 'fa fa-transgender' }, { icon: 'fa fa-transgender-alt' }, { icon: 'fa fa-venus-double' }, { icon: 'fa fa-mars-double' }, { icon: 'fa fa-venus-mars' }, { icon: 'fa fa-mars-stroke' }, { icon: 'fa fa-mars-stroke-v' }, { icon: 'fa fa-mars-stroke-h' }, { icon: 'fa fa-neuter' }, { icon: 'fa fa-facebook-official' }, { icon: 'fa fa-pinterest-p' }, { icon: 'fa fa-whatsapp' }, { icon: 'fa fa-server' }, { icon: 'fa fa-user-plus' }, { icon: 'fa fa-user-times' }, { icon: 'fa fa-bed' }, { icon: 'fa fa-viacoin' }, { icon: 'fa fa-train' }, { icon: 'fa fa-subway' }, { icon: 'fa fa-medium' }, {icon : 'glyphicon glyphicon-asterisk'},{ icon : 'glyphicon glyphicon-plus'},{ icon : 'glyphicon glyphicon-minus'},{ icon : 'glyphicon glyphicon-eur'},{ icon : 'glyphicon glyphicon-euro'},{ icon : 'glyphicon glyphicon-cloud'},{ icon : 'glyphicon glyphicon-envelope'},{ icon : 'glyphicon glyphicon-pencil'},{ icon : 'glyphicon glyphicon-glass'},{ icon : 'glyphicon glyphicon-music'},{ icon : 'glyphicon glyphicon-search'},{ icon : 'glyphicon glyphicon-heart'},{ icon : 'glyphicon glyphicon-star'},{ icon : 'glyphicon glyphicon-star-empty'},{ icon : 'glyphicon glyphicon-user'},{ icon : 'glyphicon glyphicon-film'},{ icon : 'glyphicon glyphicon-th-large'},{ icon : 'glyphicon glyphicon-th'},{ icon : 'glyphicon glyphicon-th-list'},{ icon : 'glyphicon glyphicon-ok'},{ icon : 'glyphicon glyphicon-remove'},{ icon : 'glyphicon glyphicon-zoom-in'},{ icon : 'glyphicon glyphicon-zoom-out'},{ icon : 'glyphicon glyphicon-off'},{ icon : 'glyphicon glyphicon-signal'},{ icon : 'glyphicon glyphicon-cog'},{ icon : 'glyphicon glyphicon-trash'},{ icon : 'glyphicon glyphicon-home'},{ icon : 'glyphicon glyphicon-file'},{ icon : 'glyphicon glyphicon-time'},{ icon : 'glyphicon glyphicon-road'},{ icon : 'glyphicon glyphicon-download-alt'},{ icon : 'glyphicon glyphicon-download'},{ icon : 'glyphicon glyphicon-upload'},{ icon : 'glyphicon glyphicon-inbox'},{ icon : 'glyphicon glyphicon-play-circle'},{ icon : 'glyphicon glyphicon-repeat'},{ icon : 'glyphicon glyphicon-refresh'},{ icon : 'glyphicon glyphicon-list-alt'},{ icon : 'glyphicon glyphicon-lock'},{ icon : 'glyphicon glyphicon-flag'},{ icon : 'glyphicon glyphicon-headphones'},{ icon : 'glyphicon glyphicon-volume-off'},{ icon : 'glyphicon glyphicon-volume-down'},{ icon : 'glyphicon glyphicon-volume-up'},{ icon : 'glyphicon glyphicon-qrcode'},{ icon : 'glyphicon glyphicon-barcode'},{ icon : 'glyphicon glyphicon-tag'},{ icon : 'glyphicon glyphicon-tags'},{ icon : 'glyphicon glyphicon-book'},{ icon : 'glyphicon glyphicon-bookmark'},{ icon : 'glyphicon glyphicon-print'},{ icon : 'glyphicon glyphicon-camera'},{ icon : 'glyphicon glyphicon-font'},{ icon : 'glyphicon glyphicon-bold'},{ icon : 'glyphicon glyphicon-italic'},{ icon : 'glyphicon glyphicon-text-height'},{ icon : 'glyphicon glyphicon-text-width'},{ icon : 'glyphicon glyphicon-align-left'},{ icon : 'glyphicon glyphicon-align-center'},{ icon : 'glyphicon glyphicon-align-right'},{ icon : 'glyphicon glyphicon-align-justify'},{ icon : 'glyphicon glyphicon-list'},{ icon : 'glyphicon glyphicon-indent-left'},{ icon : 'glyphicon glyphicon-indent-right'},{ icon : 'glyphicon glyphicon-facetime-video'},{ icon : 'glyphicon glyphicon-picture'},{ icon : 'glyphicon glyphicon-map-marker'},{ icon : 'glyphicon glyphicon-adjust'},{ icon : 'glyphicon glyphicon-tint'},{ icon : 'glyphicon glyphicon-edit'},{ icon : 'glyphicon glyphicon-share'},{ icon : 'glyphicon glyphicon-check'},{ icon : 'glyphicon glyphicon-move'},{ icon : 'glyphicon glyphicon-step-backward'},{ icon : 'glyphicon glyphicon-fast-backward'},{ icon : 'glyphicon glyphicon-backward'},{ icon : 'glyphicon glyphicon-play'},{ icon : 'glyphicon glyphicon-pause'},{ icon : 'glyphicon glyphicon-stop'},{ icon : 'glyphicon glyphicon-forward'},{ icon : 'glyphicon glyphicon-fast-forward'},{ icon : 'glyphicon glyphicon-step-forward'},{ icon : 'glyphicon glyphicon-eject'},{ icon : 'glyphicon glyphicon-chevron-left'},{ icon : 'glyphicon glyphicon-chevron-right'},{ icon : 'glyphicon glyphicon-plus-sign'},{ icon : 'glyphicon glyphicon-minus-sign'},{ icon : 'glyphicon glyphicon-remove-sign'},{ icon : 'glyphicon glyphicon-ok-sign'},{ icon : 'glyphicon glyphicon-question-sign'},{ icon : 'glyphicon glyphicon-info-sign'},{ icon : 'glyphicon glyphicon-screenshot'},{ icon : 'glyphicon glyphicon-remove-circle'},{ icon : 'glyphicon glyphicon-ok-circle'},{ icon : 'glyphicon glyphicon-ban-circle'},{ icon : 'glyphicon glyphicon-arrow-left'},{ icon : 'glyphicon glyphicon-arrow-right'},{ icon : 'glyphicon glyphicon-arrow-up'},{ icon : 'glyphicon glyphicon-arrow-down'},{ icon : 'glyphicon glyphicon-share-alt'},{ icon : 'glyphicon glyphicon-resize-full'},{ icon : 'glyphicon glyphicon-resize-small'},{ icon : 'glyphicon glyphicon-exclamation-sign'},{ icon : 'glyphicon glyphicon-gift'},{ icon : 'glyphicon glyphicon-leaf'},{ icon : 'glyphicon glyphicon-fire'},{ icon : 'glyphicon glyphicon-eye-open'},{ icon : 'glyphicon glyphicon-eye-close'},{ icon : 'glyphicon glyphicon-warning-sign'},{ icon : 'glyphicon glyphicon-plane'},{ icon : 'glyphicon glyphicon-calendar'},{ icon : 'glyphicon glyphicon-random'},{ icon : 'glyphicon glyphicon-comment'},{ icon : 'glyphicon glyphicon-magnet'},{ icon : 'glyphicon glyphicon-chevron-up'},{ icon : 'glyphicon glyphicon-chevron-down'},{ icon : 'glyphicon glyphicon-retweet'},{ icon : 'glyphicon glyphicon-shopping-cart'},{ icon : 'glyphicon glyphicon-folder-close'},{ icon : 'glyphicon glyphicon-folder-open'},{ icon : 'glyphicon glyphicon-resize-vertical'},{ icon : 'glyphicon glyphicon-resize-horizontal'},{ icon : 'glyphicon glyphicon-hdd'},{ icon : 'glyphicon glyphicon-bullhorn'},{ icon : 'glyphicon glyphicon-bell'},{ icon : 'glyphicon glyphicon-certificate'},{ icon : 'glyphicon glyphicon-thumbs-up'},{ icon : 'glyphicon glyphicon-thumbs-down'},{ icon : 'glyphicon glyphicon-hand-right'},{ icon : 'glyphicon glyphicon-hand-left'},{ icon : 'glyphicon glyphicon-hand-up'},{ icon : 'glyphicon glyphicon-hand-down'},{ icon : 'glyphicon glyphicon-circle-arrow-right'},{ icon : 'glyphicon glyphicon-circle-arrow-left'},{ icon : 'glyphicon glyphicon-circle-arrow-up'},{ icon : 'glyphicon glyphicon-circle-arrow-down'},{ icon : 'glyphicon glyphicon-globe'},{ icon : 'glyphicon glyphicon-wrench'},{ icon : 'glyphicon glyphicon-tasks'},{ icon : 'glyphicon glyphicon-filter'},{ icon : 'glyphicon glyphicon-briefcase'},{ icon : 'glyphicon glyphicon-fullscreen'},{ icon : 'glyphicon glyphicon-dashboard'},{ icon : 'glyphicon glyphicon-paperclip'},{ icon : 'glyphicon glyphicon-heart-empty'},{ icon : 'glyphicon glyphicon-link'},{ icon : 'glyphicon glyphicon-phone'},{ icon : 'glyphicon glyphicon-pushpin'},{ icon : 'glyphicon glyphicon-usd'},{ icon : 'glyphicon glyphicon-gbp'},{ icon : 'glyphicon glyphicon-sort'},{ icon : 'glyphicon glyphicon-sort-by-alphabet'},{ icon : 'glyphicon glyphicon-sort-by-alphabet-alt'},{ icon : 'glyphicon glyphicon-sort-by-order'},{ icon : 'glyphicon glyphicon-sort-by-order-alt'},{ icon : 'glyphicon glyphicon-sort-by-attributes'},{ icon : 'glyphicon glyphicon-sort-by-attributes-alt'},{ icon : 'glyphicon glyphicon-unchecked'},{ icon : 'glyphicon glyphicon-expand'},{ icon : 'glyphicon glyphicon-collapse-down'},{ icon : 'glyphicon glyphicon-collapse-up'},{ icon : 'glyphicon glyphicon-log-in'},{ icon : 'glyphicon glyphicon-flash'},{ icon : 'glyphicon glyphicon-log-out'},{ icon : 'glyphicon glyphicon-new-window'},{ icon : 'glyphicon glyphicon-record'},{ icon : 'glyphicon glyphicon-save'},{ icon : 'glyphicon glyphicon-open'},{ icon : 'glyphicon glyphicon-saved'},{ icon : 'glyphicon glyphicon-import'},{ icon : 'glyphicon glyphicon-export'},{ icon : 'glyphicon glyphicon-send'},{ icon : 'glyphicon glyphicon-floppy-disk'},{ icon : 'glyphicon glyphicon-floppy-saved'},{ icon : 'glyphicon glyphicon-floppy-remove'},{ icon : 'glyphicon glyphicon-floppy-save'},{ icon : 'glyphicon glyphicon-floppy-open'},{ icon : 'glyphicon glyphicon-credit-card'},{ icon : 'glyphicon glyphicon-transfer'},{ icon : 'glyphicon glyphicon-cutlery'},{ icon : 'glyphicon glyphicon-header'},{ icon : 'glyphicon glyphicon-compressed'},{ icon : 'glyphicon glyphicon-earphone'},{ icon : 'glyphicon glyphicon-phone-alt'},{ icon : 'glyphicon glyphicon-tower'},{ icon : 'glyphicon glyphicon-stats'},{ icon : 'glyphicon glyphicon-sd-video'},{ icon : 'glyphicon glyphicon-hd-video'},{ icon : 'glyphicon glyphicon-subtitles'},{ icon : 'glyphicon glyphicon-sound-stereo'},{ icon : 'glyphicon glyphicon-sound-dolby'},{ icon : 'glyphicon glyphicon-sound-5-1'},{ icon : 'glyphicon glyphicon-sound-6-1'},{ icon : 'glyphicon glyphicon-sound-7-1'},{ icon : 'glyphicon glyphicon-copyright-mark'},{ icon : 'glyphicon glyphicon-registration-mark'},{ icon : 'glyphicon glyphicon-cloud-download'},{ icon : 'glyphicon glyphicon-cloud-upload'},{ icon : 'glyphicon glyphicon-tree-conifer'},{ icon : 'glyphicon glyphicon-tree-deciduous'},{ icon : 'glyphicon glyphicon-cd'},{ icon : 'glyphicon glyphicon-save-file'},{ icon : 'glyphicon glyphicon-open-file'},{ icon : 'glyphicon glyphicon-level-up'},{ icon : 'glyphicon glyphicon-copy'},{ icon : 'glyphicon glyphicon-paste'},{ icon : 'glyphicon glyphicon-alert'},{ icon : 'glyphicon glyphicon-equalizer'},{ icon : 'glyphicon glyphicon-king'},{ icon : 'glyphicon glyphicon-queen'},{ icon : 'glyphicon glyphicon-pawn'},{ icon : 'glyphicon glyphicon-bishop'},{ icon : 'glyphicon glyphicon-knight'},{ icon : 'glyphicon glyphicon-baby-formula'},{ icon : 'glyphicon glyphicon-tent'},{ icon : 'glyphicon glyphicon-blackboard'},{ icon : 'glyphicon glyphicon-bed'},{ icon : 'glyphicon glyphicon-apple'},{ icon : 'glyphicon glyphicon-erase'},{ icon : 'glyphicon glyphicon-hourglass'},{ icon : 'glyphicon glyphicon-lamp'},{ icon : 'glyphicon glyphicon-duplicate'},{ icon : 'glyphicon glyphicon-piggy-bank'},{ icon : 'glyphicon glyphicon-scissors'},{ icon : 'glyphicon glyphicon-bitcoin'},{ icon : 'glyphicon glyphicon-yen'},{ icon : 'glyphicon glyphicon-ruble'},{ icon : 'glyphicon glyphicon-scale'},{ icon : 'glyphicon glyphicon-ice-lolly'},{ icon : 'glyphicon glyphicon-ice-lolly-tasted'},{ icon : 'glyphicon glyphicon-education'},{ icon : 'glyphicon glyphicon-option-horizontal'},{ icon : 'glyphicon glyphicon-option-vertical'},{ icon : 'glyphicon glyphicon-menu-hamburger'},{ icon : 'glyphicon glyphicon-modal-window'},{ icon : 'glyphicon glyphicon-oil'},{ icon : 'glyphicon glyphicon-grain'},{ icon : 'glyphicon glyphicon-sunglasses'},{ icon : 'glyphicon glyphicon-text-size'},{ icon : 'glyphicon glyphicon-text-color'},{ icon : 'glyphicon glyphicon-text-background'},{ icon : 'glyphicon glyphicon-object-align-top'},{ icon : 'glyphicon glyphicon-object-align-bottom'},{ icon : 'glyphicon glyphicon-object-align-horizontal'},{ icon : 'glyphicon glyphicon-object-align-left'},{ icon : 'glyphicon glyphicon-object-align-vertical'},{ icon : 'glyphicon glyphicon-object-align-right'},{ icon : 'glyphicon glyphicon-triangle-right'},{ icon : 'glyphicon glyphicon-triangle-left'},{ icon : 'glyphicon glyphicon-triangle-bottom'},{ icon : 'glyphicon glyphicon-triangle-top'},{ icon : 'glyphicon glyphicon-console'},{ icon : 'glyphicon glyphicon-superscript'},{ icon : 'glyphicon glyphicon-subscript'},{ icon : 'glyphicon glyphicon-menu-left'},{ icon : 'glyphicon glyphicon-menu-right'},{ icon : 'glyphicon glyphicon-menu-down'},{ icon : 'glyphicon glyphicon-menu-up'}];

var html = "";
$.each(icons, function(x,y){
	html += '<li>';
	html += '	<a data-class="'+y.icon+'" class="font_select">';
	html += '		<span class="'+y.icon+'"></span>';
	html += '	</a>';
	html += '</li>';
});
$('.icon-picker-list').html(html);

$(document).on('click', '#icon', function(e){
	modal.custom("#iconPicker","show");
});

$(document).on('click', '.font_select', function(e){
	modal.custom("#iconPicker","hide");
	var font_value = $(this).attr("data-class");
	$('#icon').val(font_value);
	$('.icon_preview').html('<i class="' +font_value + ' fa-lg"></i>');
});

var old_type = '';
var counter = 0;
$(document).ready(function(){
	get_data();
});

// get data
function get_data(){

    AJAX.select.table("cms_menu");
    AJAX.select.select("id,menu_name,menu_icon,menu_type,menu_status");
    AJAX.select.where.equal("id", ids);

    AJAX.select.exec(function(result){
    	var obj = result; 
    	$.each(obj,function(x,y){
    		old_type = y.menu_type;
    		$('#name').val(y.menu_name);
    		$('#icon').val(y.menu_icon);
    		$('.type').val(y.menu_type);
    		$('.icon_preview').html('<i class="' +y.menu_icon + ' fa-lg"></i>');
    		$('#status').val(y.menu_status);
    	});

    });
    get_roles();
       
}

function get_roles(){
	AJAX.select.table("cms_user_roles");
	AJAX.select.select("cms_user_roles.id as role_id,name,status,cms_menu_roles.role_id as menu_role_id,menu_id,menu_role_read,menu_role_write,menu_role_delete");
	AJAX.select.where.equal("menu_id", menu_id);
    AJAX.select.where.equal("status", "1");
	AJAX.select.join.left("cms_menu_roles", "cms_menu_roles.role_id", "cms_user_roles.id");
	
	AJAX.select.exec(function(result){
		var obj = result;
		var htm = '';
		$.each(obj, function(x, y) {

			var checked_write = "";
			var checked_delete = "";
		    var checked_read = ( y.menu_role_read == 1 ) ? checked_read = "checked" : checked_read = "";

			if( y.menu_role_write == 1 ){
				checked_read = "checked disabled='disabled'" ;
				checked_write = "checked";
			}

			if( y.menu_role_delete == 1 ){
				checked_read = "checked disabled='disabled'";
				checked_delete = "checked";
			}

			htm += "<tr>";
			htm += "   <td><input type='hidden' class='role_id_"+counter+"' data-id="+y.role_id+">" +y.name+ "</td>";
			htm += "   <td class='chckbx_td'><input class='chckbx_role read_role_"+counter+"' type=checkbox name='menu_role_read' data-id="+y.role_id+" value="+y.menu_role_read+" "+checked_read+"></td>";
			htm += "   <td class='chckbx_td'><input class='chckbx_role write_role_"+counter+"' type=checkbox name='menu_role_write'  data-id="+y.role_id+" value="+y.menu_role_write+" onchange='chckboxfunction("+counter+")' "+checked_write+"></td>";
			htm += "   <td class='chckbx_td'><input class='chckbx_role delete_role_"+counter+"' type=checkbox name='menu_role_delete'  data-id="+y.role_id+" value="+y.menu_role_delete+" onchange='chckboxfunction("+counter+")' "+checked_delete+"></td>";
			htm += "</tr>";

			counter++;
		});

		$('.table_body').html(htm);
	});
}

function chckboxfunction(count_id){
	if(($('input.write_role_'+count_id+'').is(':checked'))){
		$('.read_role_'+count_id+'').prop("checked", true).attr('disabled',true).val(1);    
	}else if(($('input.delete_role_'+count_id+'').is(':checked'))){
		$('.read_role_'+count_id+'').prop("checked", true).attr('disabled',true).val(1);    
	}else{
	  $('.read_role_'+count_id+'').attr('disabled',false).val(0);    
	}
}

$(document).on('click','#btn_update', function(){   
    if(validate.standard('menu')){
        if(old_title.toLowerCase() == $('#name').val().toLowerCase()){
            update_data();
        }else{
            if(is_exists('cms_menu', 'menu_name', $('#name').val(), 'menu_status') != 0){
                var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
                $('#name').css('border-color','red');
                $(error_message).insertAfter($('#name'));
            }else{
                update_data();
            }
        }
    }
}); 

$(document).on('change', '.chckbx_role', function(){
	if(this.checked==true){ 
	 	$(this).val(1);
	}else{
		$(this).val(0);
	}
});

// update menu
function update_data(){

	if(validate.standard('menu')){

		urls = '#';
		if($('.type').val() == 2){
			if(old_title_id > 20){
				urls = 'content_management/site_'+$('#name').val().replace(/ /g, '_');
			}else{
				urls = old_url;
			}		
		}

		var menu_level = ($('#parent').val() > 0) ? "2" : "1";
		
		modal.standard(confirm_update, function(result){
			if(result == true){
						    AJAX.update.table("cms_menu");
		    AJAX.update.where("id", ids);
		    AJAX.update.params("menu_name", $('#name').val());
		    AJAX.update.params("menu_icon", $('#icon').val());
		    AJAX.update.params("menu_role", $('#role').val());
		    AJAX.update.params("menu_type", $('.type').val());
		    AJAX.update.params("menu_url", urls.toLowerCase());
		    AJAX.update.params("menu_status", $('#status').val());
		    AJAX.update.params("menu_parent_id", $('#parent').val());
		    AJAX.update.params("menu_level", menu_level);
		    AJAX.update.params("menu_updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

		    AJAX.update.exec(function(result){
			    var obj = result;
				console.log(result.success);
                 
                if(result.success){
			    	update_menu_roles();
			    	if(urls == "#"){
			    		modal.alert(update_success, function(){
				    		location.href = content_management + '/cms_menu/menu';
				    	});
			    	}else{
			    		if(old_type != $('.type').val()){
			    			url2 = content_management + '/preference/navigation/update_menu';
							data2 = {
								menu : $('#name').val()
							}
							aJax.post(url2, data2, function(result1){
								modal.alert(update_success, function(){
						    		location.href = content_management + '/cms_menu/menu';
						    	});
							});
			    		}else{
			    			modal.alert(update_success, function(){
					    		location.href = content_management + '/cms_menu/menu';
					    	});
			    		}
			    	}
			    }
		    });
			}else{
				location.href = content_management +'/cms_menu/menu';
			}

		});
	}
}

function update_menu_roles(){
    var url = content_management + '/user_role/update_role';
    for(var i = 0; i < counter; i++){
    	role_id = $('.role_id_'+i+'').attr('data-id');
        var data = {
             table : "cms_menu_roles",
             where : "role_id = "+role_id+" AND menu_id = "+menu_id+"",
             data : {
				menu_role_read: $('.read_role_'+i+'').val(),
				menu_role_write: $('.write_role_'+i+'').val(),
				menu_role_delete: $('.delete_role_'+i+'').val(),
				menu_role_updated_date: moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
				menu_role_created_date: moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
	    	}
		}
	 	aJax.post(url ,data ,function(result){
	 		var obj = is_json(result);
	 	});
	}
}

$(document).on('change','.type',function(){
	if($(this).val() == 1){
	    if(hasUnder == 2){
	        modal.alert(menu_has_under, function(){
	            $('.type option[value="1"]').prop("selected", true);
	        });
	    }
	}
});
	
$(document).on('click', '#btn_cancel', function(e){
	modal.standard(confirm_cancel, function(result){
		if(result){
			location.href = content_management + '/cms_menu/menu';
		}
    });
});