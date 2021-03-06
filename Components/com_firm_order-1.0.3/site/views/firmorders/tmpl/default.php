<?php
/**
 * @version     1.0.0
 * @package     com_firm_order
 * @copyright   Copyright Aviation Media (TM) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Jose Cuenca <jose@aviationmedia.aero> - http://www.aviationmedia.aero
 */
// no direct access
defined('_JEXEC') or die;
?>
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_FIRM_ORDER_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-deals-delete-' + item_id).submit();
        }
    }
</script>


<h1><?php echo $this->Pagetitle;?></h1>
<div style="clear: both;"></div>
<?php if ($this->params->get('Supliedby')): ?>
<div style="float: right;">
<img src="<?php echo $this->params->get('imageSupliedby');  ?>" alt="suplied by Logo" />
</div>
<?php endif; ?>
<div style="float: left;"></div>
<form name="searchForm" id="searchForm"  method="get" class="form-inline" action="<?php echo JURI::current(); ?>" style="margin: 50px 0px 0px;" >
<input type="text" name="search" value="" class="form-control"/>
<input type="submit" value="Search" class="btn btn-default"/>
<input type="reset" value="Reset" class="btn btn-default"/>
</form>
 <div style="clear: both;"></div> 

<div class="items">

<?php $show = false; ?>
<form id="adminForm" method="post" name="adminForm">
<table class="table table-striped" style="-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: -moz-none; -ms-user-select: none; user-select: none;" oncontextmenu='alert("Unauthorised use and/or duplication of this material without express and written permission from www.afm.aero is strictly prohibited.");return false;'>
      <thead>
        <tr>
          <th><?php echo JHTML::_( 'grid.sort', 'MANUFACTURER <i class="icon-resize-vertical fa fa-sort"></i>', 'manufacturer' , $this->sortDirection, $this->sortColumn); ?></th>
          <th><?php echo JHTML::_( 'grid.sort', 'VARIANT <i class="icon-resize-vertical fa fa-sort"></i>', 'variant', $this->sortDirection, $this->sortColumn); ?></th>
          <th><?php echo JHTML::_( 'grid.sort', 'CUSTOMER <i class="icon-resize-vertical fa fa-sort"></i>', 'customer', $this->sortDirection, $this->sortColumn); ?></th>
          <th><?php echo JHTML::_( 'grid.sort', 'ORDER DATA <i class="icon-resize-vertical fa fa-sort"></i>', 'orderdate', $this->sortDirection, $this->sortColumn); ?></th>
           <th><?php echo JHTML::_( 'grid.sort', 'No OF AIRCRAFT <i class="icon-resize-vertical fa fa-sort"></i>', 'noofaircraft', $this->sortDirection, $this->sortColumn); ?></th>
          <th><?php echo JHTML::_( 'grid.sort', 'ENGINES <i class="icon-resize-vertical fa fa-sort"></i>', 'engines', $this->sortDirection, $this->sortColumn); ?></th>
        </tr>
       </thead>
       <tbody>
        <?php foreach ($this->items as $item) : ?>
		
                   	<?php
					if($item->state == 1 || ($item->state == 0 && JFactory::getUser()->authorise('core.edit.own',' com_firm_order.deals.'.$item->id))):
						$show = true;
						?>
							<?php
									if(JFactory::getUser()->authorise('core.edit.state','com_firm_order.deals.'.$item->id)):
									?>
										<a href="javascript:document.getElementById('form-deals-state-<?php echo $item->id; ?>').submit()"><?php if($item->state == 1): echo JText::_("COM_FIRM_ORDER_UNPUBLISH_ITEM"); else: echo JText::_("COM_FIRM_ORDER_PUBLISH_ITEM"); endif; ?></a>
										<form id="form-deals-state-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_firm_order&task=deals.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="jform[state]" value="<?php echo (int)!((int)$item->state); ?>" />
											<input type="hidden" name="option" value="com_firm_order" />
											<input type="hidden" name="task" value="deals.publish" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									endif;
									if(JFactory::getUser()->authorise('core.delete','com_firm_order.deals.'.$item->id)):
									?>
										<a href="javascript:deleteItem(<?php echo $item->id; ?>);"><?php echo JText::_("COM_FIRM_ORDER_DELETE_ITEM"); ?></a>
										<form id="form-deals-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_firm_order&task=deals.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="option" value="com_firm_order" />
											<input type="hidden" name="task" value="deals.remove" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									endif;
								?>
						
						<?php endif; ?>
	  <td><?php echo $item->manufacturer; ?></td>
	  <td><?php echo $item->variant; ?></td>  
	  <td><?php echo $item->customer; ?></td>
	  <td><?php echo $item->orderdate; ?></td>
	  <td><?php echo $item->noofaircraft; ?></td>
	  <td><?php echo $item->engines; ?></td>
	 </tr>
<?php endforeach; ?>
  </tbody>
</table>
<input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
</form>
        <?php
        if (!$show):
            echo JText::_('COM_FIRM_ORDER_NO_ITEMS');
        endif;
        ?>
   
</div>
<?php if ($show): ?>
    <div class="pagination" style="float: left;margin: 5px 0px 5px;">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
    <?php if ($this->params->get('whatbanner')!=null): ?>
    <?php
    $Banner = explode("|", $this->params->get('whatbanner'));
    $ban =json_decode($Banner[0]);
    ?>
    <div style="float: right;margin: 5px 0px 5px;">
    <a href="<?php echo $Banner[0]; ?>" alt="banner Data"><img src="<?php echo $ban->imageurl; ?>" alt="banner" /></a>
    </div>
    <?php endif; ?>
<?php endif; ?>



									<?php if(JFactory::getUser()->authorise('core.create','com_firm_order')): ?><a href="<?php echo JRoute::_('index.php?option=com_firm_order&task=deals.edit&id=0'); ?>"><?php echo JText::_("COM_FIRM_ORDER_ADD_ITEM"); ?></a>
	<?php endif; ?>
	<script language="javascript" type="text/javascript">
	function tableOrdering( order, dir, task )
	{
	        var form = document.adminForm;
	 
	        form.filter_order.value = order;
	        form.filter_order_Dir.value = dir;
	        document.adminForm.submit( task );
	}
	</script>