<?php

// no direct access
defined('_JEXEC') or die;

?>

<?php if (count($this->children[$this->category->id]) > 0) : ?>
<ul>
<?php foreach($this->children[$this->category->id] as $id => $child) : ?>
	<?php if ($this->params->get('show_empty_categories') || $child->getNumItems(true) || count($child->getChildren())) : ?>
	<li>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
			<?php echo $this->escape($child->title); ?>
		</a>
		
		<?php if ($this->params->get('show_subcat_desc') == 1 && $child->description) :?>
		<div><?php echo JHtml::_('content.prepare', $child->description, '', 'com_content.category'); ?></div>
		<?php endif; ?>

		<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
		<dl>
			<dt><?php echo JText::_('COM_CONTENT_NUM_ITEMS') ; ?></dt>
			<dd><?php echo $child->getNumItems(true); ?></dd>
		</dl>
		<?php endif ; ?>

		<?php if (count($child->getChildren()) > 0 ) :
			$this->children[$child->id] = $child->getChildren();
			$this->category = $child;
			$this->maxLevel--;
			if ($this->maxLevel != 0) :
				echo $this->loadTemplate('children');
			endif;
			$this->category = $child->getParent();
			$this->maxLevel++;
		endif; ?>
		</li>
	<?php endif; ?>
<?php endforeach; ?>
</ul>
<?php endif; ?>