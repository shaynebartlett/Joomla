<?php
/**
 * @version     1.3.0
 * @package     com_floorplan
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Jose Cuenca <jose@aviationmedia.aero> - http://www.aviationmedia.aero
 */
// no direct access
defined('_JEXEC') or die;
?>
<style>
.LeftFloorplan{
  float: left;
  margin: 3px;
}
.RightFloorplan{
  float: right;
}
    .flip-container {
      -webkit-perspective: 1000;
      -moz-perspective: 1000;
      perspective: 1000;

      border: 2px solid <?php echo $this->params->get('BoothBColour'); ?>;
    }

      
      .flip-container:hover .flipper, .flip-container.hover .flipper {
        -webkit-transform: rotateY(180deg);
        -moz-transform: rotateY(180deg);
        transform: rotateY(180deg);
      }

    .flip-container, .front, .flip-back {
      width:<?php echo $this->params->get('WidthB'); ?>px;
      height: <?php echo $this->params->get('HeightB'); ?>px;
    }

    .flipper {
      -webkit-transition: 0.6s;
      -webkit-transform-style: preserve-3d;

      -moz-transition: 0.6s;
      -moz-transform-style: preserve-3d;

      transition: 0.6s;
      transform-style: preserve-3d;

      position: relative;
    }

    .front, .flip-back {
      -webkit-backface-visibility: hidden;
      -moz-backface-visibility: hidden;
      backface-visibility: hidden;

      position: absolute;
      top: 0;
      left: 0;
    }

    .front {
		padding: 0px;
		color: <?php echo $this->params->get('FontColour'); ?>;
		z-index: 2;
    }

    .flip-back {
	      background-color: <?php echo $this->params->get('BoothBColour'); ?>;
	      color: white;
	      font-size: 12px;
	      line-height: 1;
	      -webkit-transform: rotateY(180deg);
	      -moz-transform: rotateY(180deg);
	      transform: rotateY(180deg);
    }
    
.booth{
	width: 20px;
	height: 20px;
	margin: 7.5px 5px 1px 4px;
	float: left;
	text-align: center;
	border: 1px solid <?php echo $this->params->get('BoothBColour');?>;
}
.booth > a, .flip-back > h5 > a{
	text-decoration: none;
	color: <?php echo $this->params->get('FontColour'); ?>;
}
.Rectangle , .Square, .LShape, .Leadershipshape{
background: #f5f5f5 url('<?php echo JURI::root().$this->params->get('FloorplanBackground'); ?>') no-repeat;
width: 548px;
height: 341px;
background-size: 100% 100%;
	
}

.Rectangle > div{
position: relative;
top: 110px;
left: 15px;

}
.Leadership2015 > div{
position: relative;
top: 112px;
left: 14px;
}
.exhibitors{
	margin: 20px auto;
	width: 100%;
	text-align: center;
}
.FlipperImg{
	
}
</style>

<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_FLOORPLAN_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-booth-delete-' + item_id).submit();
        }
    }
</script>
<div style="background-color: white;margin-top: -15px;">
<h1 style="padding: 20px;"><?php echo $this->title; ?></h1>
<?php if ($this->params->get('Exhibition_Rate')!="") :?>
	<div style="padding:0px 20px;">
		<?php echo $this->params->get('Exhibition_Rate'); ?>
	</div>
<?php endif; ?>
<?php echo $this->floorplan; ?>
<div class="exhibitors">
<?php $show = false; ?>
        <?php foreach ($this->items as $item) : ?>
            
				<?php
					if($item->state == 1 || ($item->state == 0 && JFactory::getUser()->authorise('core.edit.own',' com_floorplan.booth.'.$item->id))):
						$show = true;
						?>
							<?php if ($item->type!="Refreshment") : ?>
							
							<div class="flip-container LeftFloorplan" style="margin-right: 20px; margin-bottom: 20px;">
							<div class="flipper">
							<div class="front">
								<p style="padding-bottom: 3px;font-size: <?php echo $this->params->get('Fontsizenumber'); ?>px;"><?php echo $item->boothnumber; ?>
								</p>
							<img class="FlipperImg" src="<?php echo JURI::root().$item->logo; ?>" alt="<?php echo $item->company; ?>" ></div>
							<div class="flip-back" align="center">
							<h4 style="padding: 10px;">
							<span style="color: <?php echo $this->params->get('FontColour'); ?>;">
								<?php echo $item->company; ?><span><br />
							
							<a title="<?php echo $item->company; ?>" href="http://<?php echo $item->website; ?>" target="_blank" style="padding-top: 10px;">Click here</a></h4>
							<?php if ($item->information !=""): ?>
							<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal<?php echo $item->id; ?>">
							  Read more
							</button>
							<?php endif; ?>
							</div>
							</div>
							</div>
							<?php endif; ?>
							
						<?php endif; ?>
						<?php if ($item->information !=""): ?>
						<div class="modal fade" id="myModal<?php echo $item->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog" style="margin-top: 70px;">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						        <h4 class="modal-title" id="myModalLabel">
						        <?php echo $item->company; ?></h4>
						      </div>
						      <div class="modal-body">
						       <?php echo $item->information; ?>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>
						<?php endif; ?>

<?php endforeach; ?>
        <?php
        if (!$show):
            echo JText::_('COM_FLOORPLAN_NO_ITEMS');
        endif;
        ?>
</div>
<?php if ($show): ?>
    <div class="pagination">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php endif; ?>
<div style="clear: both;"></div>

<?php if ($this->params->get('More_Information')!="") :?>
	<div style="padding: 20px;">
		<?php echo $this->params->get('More_Information'); ?>
	</div>
<?php endif; ?>
</div>