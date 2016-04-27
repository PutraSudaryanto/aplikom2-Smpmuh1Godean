<?php
/**
 * Psb Settings (psb-settings)
 * @var $this SettingController
 * @var $model PsbSettings
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 27 April 2016, 12:11 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Psb Settings'=>array('manage'),
		$model->id,
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
		array(
			'name'=>'id',
			'value'=>$model->id,
			//'value'=>$model->id != '' ? $model->id : '-',
		),
		array(
			'name'=>'license',
			'value'=>$model->license,
			//'value'=>$model->license != '' ? $model->license : '-',
		),
		array(
			'name'=>'permission',
			'value'=>$model->permission,
			//'value'=>$model->permission != '' ? $model->permission : '-',
		),
		array(
			'name'=>'meta_keyword',
			'value'=>$model->meta_keyword != '' ? $model->meta_keyword : '-',
			//'value'=>$model->meta_keyword != '' ? CHtml::link($model->meta_keyword, Yii::app()->request->baseUrl.'/public/visit/'.$model->meta_keyword, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'meta_description',
			'value'=>$model->meta_description != '' ? $model->meta_description : '-',
			//'value'=>$model->meta_description != '' ? CHtml::link($model->meta_description, Yii::app()->request->baseUrl.'/public/visit/'.$model->meta_description, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'field_religion',
			'value'=>$model->field_religion,
			//'value'=>$model->field_religion != '' ? $model->field_religion : '-',
		),
		array(
			'name'=>'field_wali',
			'value'=>$model->field_wali,
			//'value'=>$model->field_wali != '' ? $model->field_wali : '-',
		),
		array(
			'name'=>'modified_date',
			'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
		),
		array(
			'name'=>'modified_id',
			'value'=>$model->modified_id,
			//'value'=>$model->modified_id != 0 ? $model->modified_id : '-',
		),
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
