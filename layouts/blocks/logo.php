<?php

// No direct access.
defined('_JEXEC') or die;

$logo_image = $this->API->get('logo_image', '');

if(($logo_image == '') || ($this->API->get('logo_type', '') == 'css')) {
     $logo_image = $this->API->URLtemplate() . '/images/logo.png';
} else {
     $logo_image = $this->API->URLbase() . $logo_image;
}

$logo_text = $this->API->get('logo_text', '');
$logo_slogan = $this->API->get('logo_slogan', '');

$logo_type = $this->API->get('logo_type', 'image');
$logo_type = 'css';
$logo_type = 'combined';
?>

<?php if ($logo_type!=='none'): ?>
     <?php if($logo_type == 'css') : ?>
	     <a href="<?php echo JURI::root(); ?>" id="gkLogo" class="cssLogo"><?php echo $this->API->get('logo_text', ''); ?></a>
     <?php elseif($logo_type == 'text') : ?>
	     <a href="<?php echo JURI::root(); ?>" id="gkLogo" class="text">
		<span><?php echo $this->API->get('logo_text', ''); ?></span>
	        <small class="gkLogoSlogan"><?php echo $this->API->get('logo_slogan', ''); ?></small>
	     </a>
     <?php elseif($logo_type == 'image') : ?>
	     <a href="<?php echo JURI::root(); ?>" id="gkLogo" class="logo">
        	<img src="<?php echo $logo_image; ?>" alt="<?php echo $this->API->getPageName(); ?>" />
	     </a>
     <?php elseif($logo_type == 'combined'): ?>

	     <a href="<?php echo JURI::root(); ?>" id="gkLogo" class="logo">
	        <img src="<?php echo $logo_image; ?>" alt="<?php echo $this->API->getPageName(); ?>" />
	     </a>

	     <a href="<?php echo JURI::root(); ?>" id="gkLogo" class="text">
		<span><?php echo $this->API->get('logo_text', ''); ?></span>
		<small class="gkLogoSlogan"><?php echo $this->API->get('logo_slogan', ''); ?></small>
	     </a>
     <?php endif; ?>
<?php endif; ?>
