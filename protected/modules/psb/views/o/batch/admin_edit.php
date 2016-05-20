<?php
/**
 * Psb Year Batches (psb-year-batch)
 * @var $this BatchController
 * @var $model PsbYearBatch
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link https://github.com/Ommu/Ommu-PSB
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Psb Year Batches'=>array('manage'),
		$model->batch_id=>array('view','id'=>$model->batch_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>