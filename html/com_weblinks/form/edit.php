<?php
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

// Create shortcut to parameters.
$params = $this->state->get('params');

if ($this->user->get('id') == 0): 

	$return = JURI::getInstance()->toString();
	$url    = 'index.php?option=com_users&view=login' . '&return='.base64_encode($return);
	
	$app = JFactory::getApplication();
	$app->redirect($url, JText::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'), $msgType='message');

endif;
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'weblink.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
			<?php //echo $this->form->getField('description')->save(); ?>
			Joomla.submitform(task);
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<section class="edit<?php echo $this->pageclass_sfx; ?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<header>
	<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
</header>
<?php endif; ?>
<form action="<?php echo JRoute::_('index.php?option=com_weblinks&view=form&w_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<fieldset>
		<legend><?php //echo JText::_('COM_WEBLINKS_LINK'); ?></legend>
			
			<div class="formelm">
				<?php echo $this->form->getLabel('url'); ?>
				<?php echo $this->form->getInput('url', null, JRequest::getVar('url', '', 'get','STRING')); ?>
			</div>			
			
			<div class="formelm">
				<?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title', null, JRequest::getVar('title', '', 'get','STRING')); ?>
			</div>
			
			<?php if(isset($_REQUEST['exabyte']) && trim($_REQUEST['exabyte'])=='1'): ?>
				<input type="hidden" id="jform_catid" name="jform[catid]" value="55" />
			<?php else: ?>
				<div class="formelm">
				<?php echo $this->form->getLabel('catid'); ?>
				<?php echo $this->form->getInput('catid'); ?>
				</div>
			<?php endif; ?>
			
			<!--div class="formelm">
				<?php echo $this->form->getInput('language'); ?>
			</div-->
			
			<div>
				<?php echo $this->form->getLabel('description'); ?>
				<?php echo $this->form->getInput('description', null, JRequest::getVar('description', '', 'get','STRING')); ?>
			</div>
			
			<?php if ($this->user->authorise('core.edit.state', 'com_weblinks.weblink')): ?>
				<div class="formelm">
				<?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?>
				</div>
			<?php else: ?>
				
				<?php // Check AUP rating ?>
				<input type="hidden" id="jform_state" name="jform[state]" value="1" />
				
			<?php endif; ?>
			
			<div class="formelm-buttons">
				<button type="button" onclick="Joomla.submitbutton('weblink.save')">
					<?php echo JText::_('JSAVE') ?>
				</button>
				<!--button onclick="Joomla.submitbutton('weblink.cancel')">
					<?php echo JText::_('JCANCEL') ?>
				</button-->
				or <a href="/" title="<?php echo JText::_('JCANCEL') ?>"><?php echo JText::_('JCANCEL') ?></a>
				
			</div>
			
	</fieldset>

	<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_( 'form.token' ); ?>
</form>
</section>