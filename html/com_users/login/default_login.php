<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::stylesheet('slogin.css', 'modules/mod_slogin/tmpl/compact/');
JHtml::script('slogin.js', 'modules/mod_slogin/media/');
?>
<section class="login<?php echo $this->pageclass_sfx?>">
	<?php if($this->params->get('show_page_heading') || (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '')) : ?>
	<header>
		<?php if ($this->params->get('show_page_heading')) : ?>
		<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		<?php endif; ?>
	
		<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
		<div>
		<?php endif ; ?>
			<?php if (($this->params->get('login_image')!='')) :?>
			<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JTEXT::_('COM_USER_LOGIN_IMAGE_ALT')?>"/>
			<?php endif; ?>
	
			<?php if($this->params->get('logindescription_show') == 1) : ?>
			<div><?php echo $this->params->get('login_description'); ?></div>
			<?php endif; ?>
		<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
		</div>
		<?php endif ; ?>
	</header>
	<?php else: ?>
		<h3>Sign In</h3>
	<?php endif; ?>
	
	<noindex>
	<div id="slogin-buttons" class="slogin-buttons <?php echo $moduleclass_sfx?>">
		<?php 
		$dispatcher = JDispatcher::getInstance();
		JPluginHelper::importPlugin('slogin_auth');
		$plugins = array();
		$callbackUrl = '&return='.base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return')));
		$dispatcher->trigger('onCreateSloginLink', array(&$plugins,	$callbackUrl));
		?>

		<?php if (count($plugins)): ?>
			<?php
			foreach($plugins as $link):
				$linkParams = '';
				if(isset($link['params'])){
					foreach($link['params'] as $k => $v){
						$linkParams .= ' ' . $k . '="' . $v . '"';
					}
				}
				?>
				<a rel="nofollow" <?php echo $linkParams;?> href="<?php echo JRoute::_($link['link']);?>"><span class="<?php echo $link['class'];?>">&nbsp;</span></a>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	</noindex>
	<div class="slogin-clear"></div>
	
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" id="login-form">
		<fieldset>
			<?php foreach ($this->form->getFieldset('credentials') as $field): ?>
				<?php if (!$field->hidden): ?>
				<div class="login-fields">
					<?php echo $field->label; ?>
					<?php echo $field->input; ?>
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
			
			<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
				<p id="form-login-remember">
				<label for="modlgn-remember">
					<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
					<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>
				</label>
				</p>
				<div class="slogin-clear"></div>
			<?php endif; ?>
			
			<button type="submit" class="button"><?php echo JText::_('JLOGIN'); ?></button>
			
			<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</fieldset>
	</form>
	
	<ul>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
			<?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
		</li>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
			<?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></a>
		</li>
		<?php
		$usersConfig = JComponentHelper::getParams('com_users');
		if ($usersConfig->get('allowUserRegistration')) : ?>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
				<?php echo JText::_('COM_USERS_LOGIN_REGISTER'); ?></a>
		</li>
		<?php endif; ?>
	</ul>
</section>