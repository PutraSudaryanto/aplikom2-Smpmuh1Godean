<?php
/**
 * Psb Registers (psb-registers)
 * @var $this Admin1Controller * @var $model PsbRegisters *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Psb Registers'=>array('manage'),
		$model->register_id,
	);
?>

<?php //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
	echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //end.Messages ?>

<?php $this->widget('application.components.system.FDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'register_id',
		'status',
		'year_id',
		'batch_id',
		'register_name',
		'birth_province',
		'birth_city',
		'birth_date',
		'address',
		'address_phone',
		'address_yogya',
		'address_yogya_phone',
		'parent_name',
		'parent_work',
		'parent_address',
		'parent_phone',
		'school_id',
		'school_un_rank',
		'creation_date',
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
