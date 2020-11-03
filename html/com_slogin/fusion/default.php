<?php
/**
 * Social Login
 *
 * @version 	1.0
 * @author		Ayan Debnath, SmokerMan, Arkadiy, Joomline
 * @copyright	© 2012. All rights reserved.
 * @license 	GNU/GPL v.3 or later.
 */

// No direct access to this file
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
//$doc = JFactory::getDocument();
//$doc->addStyleSheet(JURI::root().'media/com_slogin/comslogin.css')
?>
<div class="login">

	<h3>
        <?php echo JText::_('COM_SLOGIN_FUSION'); ?>
        <i><?php echo $this->user->get('username'); ?></i>
    </h3>

    <div class="login-description">
        <p class="gkTips1"><?php echo JText::_('COM_SLOGIN_FUSION_DESC'); ?></p>
    </div>
    <?php if ($this->user->get('id') == 0):
		
		$return = JURI::getInstance()->toString();
		$url    = 'index.php?option=com_users&view=login' . '&return='.base64_encode($return);
		
		$app = JFactory::getApplication();
		$app->redirect($url, JText::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'), $msgType='message');
		
    else : ?>
		
		<?php if(!empty($this->attachedProviders)): ?>
			<h4><?php echo JText::_('COM_SLOGIN_ATTACH_PROVIDERS')?>:</h4>
			<div id="slogin-buttons" class="slogin-buttons">
				<?php
				foreach($this->attachedProviders as $provider) :

					if($provider['plugin_name'] == 'ulogin')
						continue;

					$linkParams = '';
					if(isset($provider['params'])){
						foreach($provider['params'] as $k => $v){
							$linkParams .= ' ' . $k . '="' . $v . '"';
						}
					}
					?>
				<a <?php echo $linkParams;?> href="<?php echo JRoute::_($provider['link']);?>">
					<span class="<?php echo $provider['class'];?>">&nbsp;</span>
				</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		
		<div class="slogin-clear clear overflow"></div>
		
		<?php if(!empty($this->unattachedProviders)): ?>
			<br />
			<h4><?php echo JText::_('COM_SLOGIN_DETACH_PROVIDERS')?>:</h4>
			<div id="slogin-buttons" class="slogin-buttons">
				<?php foreach($this->unattachedProviders as $provider) : ?>
				<a href="<?php echo JRoute::_('index.php?option=com_slogin&task=detach_provider&plugin='.$provider['plugin_name']);?>">
					<span class="<?php echo $provider['class'];?>">&nbsp;</span>
				</a>
				<?php endforeach; ?>
			</div>
			<div class="slogin-clear clear overflow"></div>
		<?php endif; ?>
	
    <?php endif; ?>
</div>