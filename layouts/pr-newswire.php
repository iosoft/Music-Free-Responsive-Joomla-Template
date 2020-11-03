<?php
/**
 *
 * Default view
 *
 * @version             1.0.0
 * @package             Gavern Framework
 * @copyright			Copyright (C) 2010 - 2011 GavickPro. All rights reserved.
 *               
 */
 
// No direct access.
defined('_JEXEC') or die;
// 
$this->layout->generateLayout(20);
//
$app = JFactory::getApplication();
$user = JFactory::getUser();
// getting User ID
$userID = $user->get('id');
// getting params
$option = JRequest::getCmd('option', '');
$view = JRequest::getCmd('view', '');
// defines if login is active
define('GK_LOGIN', $this->API->modules('login'));
// defines if com_users
define('GK_COM_USERS', $option == 'com_users' && ($view == 'login' || $view == 'registration'));
// other variables
$btn_login_text = ($userID == 0) ? JText::_('TPL_GK_LANG_LOGIN') : JText::_('TPL_GK_LANG_LOGOUT');

//$tpl_page_suffix = $this->page_suffix != '' ? ' class="'.$this->page_suffix.'"' : '';
$custom_suffix = '';

if($_SERVER['HTTP_HOST']=='exabyte.gigahertz.net.in') {
	$custom_suffix .= 'exabyte ';
}
$menu=$app->getMenu();
if($menu->getActive()==$menu->getDefault()) {
	$custom_suffix .= 'home ';
}
if($option=='com_kunena') {

	if(JRequest::getCmd('catid', '')!='') {
		$custom_suffix .= ' forum-cat-'.JRequest::getCmd('catid', 0).' ';
	}
	if(JRequest::getCmd('id', '')!='') {
		$custom_suffix .= ' forum-post-'.JRequest::getCmd('id', 0).' ';
	}
	if($custom_suffix == '') {
		$custom_suffix .= ' forum-'.JRequest::getCmd('id', JRequest::getCmd('Itemid', '0')).' ';
	}
	
} elseif($option=='com_content') {

	/* article-cat- article-id-  */
	$custom_suffix .= str_ireplace('com_','', $option).'-'.JRequest::getCmd('id', JRequest::getCmd('Itemid', '0'));
	
} else {

	$custom_suffix .= str_ireplace('com_','', $option).'-'.JRequest::getCmd('id', JRequest::getCmd('Itemid', '0'));
}
$tpl_page_suffix = ' class="'.trim($this->page_suffix.' '.trim($custom_suffix)).'" ';
?><!DOCTYPE html>
<!--[if lt IE 7]><html lang="<?php echo $this->APITPL->language; ?>" xml:lang="<?php echo $this->APITPL->language; ?>" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html lang="<?php echo $this->APITPL->language; ?>" xml:lang="<?php echo $this->APITPL->language; ?>" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html lang="<?php echo $this->APITPL->language; ?>" xml:lang="<?php echo $this->APITPL->language; ?>" prefix="og: http://ogp.me/ns#" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="<?php echo $this->APITPL->language; ?>" xml:lang="<?php echo $this->APITPL->language; ?>" prefix="og: http://ogp.me/ns#" class="no-js"> <!--<![endif]-->
<head>
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=<?php echo $this->API->get("zoom_scale", "1.0"); ?>">
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

<?php if($_SERVER['HTTP_HOST']=='exabyte.gigahertz.net.in'):?>
<link rel="http://oexchange.org/spec/0.8/rel/related-target" type="application/xrd+xml" href="http://exabyte.gigahertz.net.in/oexchange.xrd"/>
<link rel="dns-prefetch" href="https://www.gigahertz.net.in/">
<?php else:?>	
<link rel="dns-prefetch" href="https://exabyte.gigahertz.net.in/">
<?php endif;?>
<link rel="dns-prefetch" href="https://cdn.gigahertz.net.in/">
<link rel="dns-prefetch" href="https://ghz-cdn-cloud.ga/">
<!--<link rel="dns-prefetch" href="https://gallery.gigahertz.net.in/">-->
<link rel="dns-prefetch" href="https://connect.facebook.net/">
<link rel="dns-prefetch" href="https://s7.addthis.com/">

<link rel="preconnect" href="https://cdn.gigahertz.net.in/" crossorigin>

<jdoc:include type="head" />

<?php if(isset($_POST['HTTP_HOST'])):?>
	<link rel="stylesheet" href="//www.gigahertz.net.in/templates/gk_music_free/css/menu/facebook.css" type="text/css" />
<?php endif;?>

<?php $this->layout->loadBlock('head'); ?>
<?php $this->layout->loadBlock('cookielaw'); ?>

<style type="text/css">
.img-fulltext-left {margin-bottom:0px;}
#prn_overrides table{background-color:transparent;border-style: none;}
#prn_overrides table tr td{background-color:transparent; border-right: none;border-left: none; border-top: none; border-bottom: 1px solid #DBDBDB; padding-bottom: 5px;padding-top: 5px;}
#prn_overrides a.headlinelink_prn {font-weight:normal; font-size:20px;line-height: 1.27em; _font-family: sans-serif; color:#222222;text-decoration: none;}
#prn_overrides a.headlinelink_prn:hover {text-decoration:none; color:#7cadde !important;}

#prn_overrides .bottom_prn {text-align:right;color:#fff;}

#prn_overrides a.bottomlinks_prn {_font-family:  sans-serif; font-weight:normal; font-size: 20px;line-height: 1.27em; color:#222222; text-decoration: none; margin:0cm 0cm 0cm 0cm; 
	
	padding:0 12px;
	width:72px;
	height:35px;
	color:#fff;
	background-color:#000;
	font-weight:bold;
	font-size:13px;
	line-height: 32px;
	border-radius: 2px;
	display:inline-block;
}
#prn_overrides a.bottomlinks_prn:hover {text-decoration: none;color:#7cadde;

	color:#fff;
	background-color:#7cadde;
}

#prn_overrides img.logoimg_prn {max-width:100px;}

#gkSocialAPI, .gkSocialAPI, .title_prn, .font_prn, #prnaddthis, #prn_overrides a.bottomlinks_prn:last-child {display:none !important;}
</style>
</head>
<body<?php echo $tpl_page_suffix; ?><?php if($this->browser->get("tablet") == true) echo ' data-tablet="true"'; ?><?php $this->layout->generateLayoutWidths(); ?><?php echo ' data-loading-translation="'.JText::_('TPL_GK_LANG_SIDEBAR_LOADING').'"'; ?>>
<?php if ($this->browser->get('browser') == 'ie7' || $this->browser->get('browser') == 'ie6') : ?>
<!--[if lte IE 7]>
<div id="ieToolbar"><div><?php echo JText::_('TPL_GK_LANG_IE_TOOLBAR'); ?></div></div>
<![endif]-->
<?php endif; ?>
<?php if(count($app->getMessageQueue())) : ?>
<jdoc:include type="message" />
<?php endif; ?>
<div id="gkPageWrap">
	<section id="gkPageTop">
		<?php $this->layout->loadBlock('logo'); ?>
		
		<?php if($this->API->modules('login or top_toolbar or lang') || ($this->API->get('register_link', 1) && $userID == 0) ) : ?>
		<div id="gkUserLinks">
			<?php if($this->API->modules('top_toolbar')) : ?>
			<div id="gkTopToolbar">
				<jdoc:include type="modules" name="top_toolbar" style="<?php echo $this->module_styles['top_toolbar']; ?>" />
			</div>
			<?php endif; ?>
			
			<?php if($this->API->modules('lang')) : ?>
				<jdoc:include type="modules" name="lang" style="<?php echo $this->module_styles['lang']; ?>" />
			<?php endif; ?>
			
			<?php if($this->API->get('register_link', 1) && $userID == 0) : ?>
				<a id="btnRegister" href="<?php echo JRoute::_($this->API->URLbase().'index.php?option=com_users&amp;view=registration', false);?>"><?php echo JText::_('TPL_GK_LANG_REGISTER'); ?></a>
			<?php endif; ?>
			
			<?php if($this->API->modules('login')) : ?>
				<a href="<?php echo JRoute::_($this->API->URLbase().'index.php?option=com_users&amp;view=login', false);?>" id="btnLogin"><?php echo $btn_login_text; ?></a>
			<?php endif; ?>

		</div>
		<?php endif; ?>
		<?php if($this->API->get('show_menu',1) == 1) : ?>
		<div id="gkMainMenu">
			<?php
				$this->mainmenu->loadMenu($this->API->get('menu_name','mainmenu')); 
			    $this->mainmenu->genMenu($this->API->get('startlevel', 0), $this->API->get('endlevel',-1));
			?>
			<div id="gkMobileMenu">
				<select onChange="window.location.href=this.value;">
				<?php 
    	    		$this->mobilemenu->loadMenu($this->API->get('menu_name','mainmenu')); 
    	    		$this->mobilemenu->genMenu($this->API->get('startlevel', 0), $this->API->get('endlevel',-1));
    			?>
				</select>
			</div>
		</div>
		<?php endif; ?>
	</section>
	
	<?php if($this->API->modules('social + toolbar')) : ?>
	<section id="gkToolbar">
		<jdoc:include type="modules" name="toolbar" style="<?php echo $this->module_styles['toolbar']; ?>" />
		<jdoc:include type="modules" name="social" style="<?php echo $this->module_styles['social']; ?>" />
	</section>
	<?php endif; ?>
	
	<?php if($this->API->modules('top')) : ?>
	<section id="gkTop" class="masonry">
		<jdoc:include type="modules" name="top" style="<?php echo $this->module_styles['top']; ?>" />
	</section>
	<?php endif; ?>
	
	<div id="gkPageContent">
		<section id="gkPage" class="masonry">
			<section id="gkContent" class="box">
				<div>
					<?php if($this->API->modules('mainbody_top')) : ?>
					<section id="gkMainbodyTop">
						<jdoc:include type="modules" name="mainbody_top" style="<?php echo $this->module_styles['mainbody_top']; ?>" />
					</section>
					<?php endif; ?>
						
					<?php if($this->API->modules('breadcrumb') || $this->getToolsOverride()) : ?>
					<section id="gkBreadcrumb">
						<?php if($this->API->modules('breadcrumb')) : ?>
						<jdoc:include type="modules" name="breadcrumb" style="<?php echo $this->module_styles['breadcrumb']; ?>" />
						<?php endif; ?>
						
						<?php if($this->getToolsOverride()) : ?>
						<?php $this->layout->loadBlock('tools/tools'); ?>
						<?php endif; ?>
					</section>
					<?php endif; ?>
					
					<section id="gkMainbody">
						<?php if(($this->layout->isFrontpage() && !$this->API->modules('mainbody')) || !$this->layout->isFrontpage()) : ?>
						
							<!--<pre><?php //print_r($this->layout);?></pre>-->
						
							<jdoc:include type="component" />
						<?php else : ?>
							<jdoc:include type="modules" name="mainbody" style="<?php echo $this->module_styles['mainbody']; ?>" />
						<?php endif; ?>
						
						<div id="prn_overrides" align="left" style="width: 100%; height: 100%;overflow:auto; margin:0cm 0cm 0cm 0cm;"></div>
						<!--<script type="text/javascript" src="//widget.prnewswire.com/widget/widget.js?showRelease=1&container=prn_overrides&rude=1&bkgcolor=FFFFFF&rowcolor1=FFFFFF&rowcolor2=FFFFFF&vicon=1&numresults=13&numvideos=1&numwords=30&industries=CPR,CSE,GAM,HRD,ITE,MEN,MLM,NET,PEL,SEM,SMD,STW,WEB,WIC&dir=25&social=1&back=1&bold=0&link=7cadde&datecolor=888888;font-size:11px;font-weight:normal;&textcolor=7D7B7A&fontface=sans-serif&fontsize=11&type=expand&height=&releasetitlestyle=color%3A%20%23222222;_font-family: sans-serif;font-size: 30px;font-weight:normal;line-height:1em;&titlestyle=color%3A%20%23222222;_font-family:sans-serif;font-size:13px;font-weight:700;&prnlogo=1&morevids=0&filter=0&p=//www.gigahertz.net.in/news/pr-newswire"></script>
					-->
					</section>
					
					<?php if($this->API->modules('mainbody_bottom')) : ?>
					<section id="gkMainbodyBottom">
						<jdoc:include type="modules" name="mainbody_bottom" style="<?php echo $this->module_styles['mainbody_bottom']; ?>" />
					</section>
					<?php endif; ?>
				</div>
			</section>
			
			<?php if($this->API->modules('sidebar')) : ?>
			<jdoc:include type="modules" name="sidebar" style="<?php echo $this->module_styles['sidebar']; ?>" />
			<?php endif; ?>
		</section>
	</div>
		
	<?php if($this->API->modules('bottom')) : ?>
	<section id="gkBottom" class="masonry">
		<jdoc:include type="modules" name="bottom" style="<?php echo $this->module_styles['bottom']; ?>" />
	</section>
	<?php endif; ?>
</div>

<?php $this->layout->loadBlock('footer'); ?>

<?php $this->layout->loadBlock('tools/login'); ?>
<div id="gkPopupOverlay"></div>
<?php $this->layout->loadBlock('social'); ?>

<script src="<?php echo JRoute::_($this->API->URLbase().'templates/custom.js', false); ?>" type="text/javascript"></script>

<jdoc:include type="modules" name="debug" />
</body>
</html>
