<?php

/**
 *
 * Facebook view
 *
 * @version             3.0.0
 * @package             Gavern Framework
 * @copyright			Copyright (C) 2010 - 2012 GavickPro. All rights reserved.
 *               
 */
 
// No direct access.
defined('_JEXEC') or die;

?><!DOCTYPE html>
<!--[if lt IE 7]><html lang="<?php echo $this->APITPL->language; ?>" xml:lang="<?php echo $this->APITPL->language; ?>" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html lang="<?php echo $this->APITPL->language; ?>" xml:lang="<?php echo $this->APITPL->language; ?>" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html lang="<?php echo $this->APITPL->language; ?>" xml:lang="<?php echo $this->APITPL->language; ?>" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="<?php echo $this->APITPL->language; ?>" xml:lang="<?php echo $this->APITPL->language; ?>" prefix="og: http://ogp.me/ns#" class="no-js"> <!--<![endif]-->
<head>
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" /><![endif]-->
<!--
▄████  ██▓  ▄████  ▄▄▄       ██░ ██ ▓█████  ██▀███  ▄▄▄█████▓▒███████▒
██▒ ▀█▒▓██▒ ██▒ ▀█▒▒████▄    ▓██░ ██▒▓█   ▀ ▓██ ▒ ██▒▓  ██▒ ▓▒▒ ▒ ▒ ▄▀░
▒██░▄▄▄░▒██▒▒██░▄▄▄░▒██  ▀█▄  ▒██▀▀██░▒███   ▓██ ░▄█ ▒▒ ▓██░ ▒░░ ▒ ▄▀▒░ 
░▓█  ██▓░██░░▓█  ██▓░██▄▄▄▄██ ░▓█ ░██ ▒▓█  ▄ ▒██▀▀█▄  ░ ▓██▓ ░   ▄▀▒   ░
░▒▓███▀▒░██░░▒▓███▀▒ ▓█   ▓██▒░▓█▒░██▓░▒████▒░██▓ ▒██▒  ▒██▒ ░ ▒███████▒
░▒   ▒ ░▓   ░▒   ▒  ▒▒   ▓▒█░ ▒ ░░▒░▒░░ ▒░ ░░ ▒▓ ░▒▓░  ▒ ░░   ░▒▒ ▓░▒░▒
░   ░  ▒ ░  ░   ░   ▒   ▒▒ ░ ▒ ░▒░ ░ ░ ░  ░  ░▒ ░ ▒░    ░    ░░▒ ▒ ░ ▒
░ ░   ░  ▒ ░░ ░   ░   ░   ▒    ░  ░░ ░   ░     ░░   ░   ░      ░ ░ ░ ░ ░
  ░  ░        ░       ░  ░ ░  ░  ░   ░  ░   ░                ░ ░    
														   ░        
<?php echo $app->getCfg('MetaDesc');?>
-->
<meta property="fb:app_id" content="447428348655998"/>
<meta property="fb:admins" content="ayan.don.79,ayan.debnath"/>

<meta property="og:locale" content="en_US"/>
<meta property="article:publisher" content="https://www.facebook.com/GigaHertZnet"/>

<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@GigaHertZnet"/>
<meta name="twitter:domain" content="GigaHertZ.net.in"/>
<meta name="twitter:creator" content="@https://twitter.com/GigaHertZnet"/>

<jdoc:include type="head" />
</head>
<body class="facebook">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>