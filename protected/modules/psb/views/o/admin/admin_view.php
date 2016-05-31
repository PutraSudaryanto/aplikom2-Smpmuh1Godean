<?php
/**
 * Psb Registers (psb-registers)
 * @var $this AdminController
 * @var $model PsbRegisters
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 27 April 2016, 12:23 WIB
 * @link https://github.com/Ommu/Ommu-PSB
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
		array(
			'name'=>'register_id',
			'value'=>$model->register_id,
		),
		array(
			'name'=>'author_id',
			'value'=>$model->author_id != 0 ? $model->author->name : '-',
		),
		/*
		array(
			'name'=>'status',
			'value'=>$model->status == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			//'value'=>$model->status,
		),
		*/
		array(
			'name'=>'nisn',
			'value'=>$model->nisn != '' ? $model->nisn : '-',
		),
		array(
			'name'=>Yii::t('phrase', 'Year'),
			'value'=>$model->batch_id != 0 ? $model->batch_relation->year->years : '-',
		),
		array(
			'name'=>'batch_id',
			'value'=>$model->batch_id != 0 ? $model->batch_relation->batch_name : '-',
		),
		array(
			'name'=>'register_name',
			'value'=>$model->register_name != '' ? $model->register_name : '-',
		),
		array(
			'name'=>'birth_city',
			'value'=>$model->birth_city != 0 ? $model->city_relation->city : '-',
		),
		array(
			'name'=>'birth_date',
			'value'=>!in_array($model->birth_date, array('0000-00-00','1970-01-01')) ? Utility::dateFormat($model->birth_date) : '-',
		),
		array(
			'name'=>'gender',
			'value'=>$model->gender == 'male' ? Yii::t('phrase', 'Laki-laki') : Yii::t('phrase', 'Perempuan'),
		),
		array(
			'name'=>'religion',
			'value'=>$model->religion != 0 ? Phrase::trans($model->religion_relation->religion_name, 2) : '-',
		),
		array(
			'name'=>'address',
			'value'=>$model->address != '' ? $model->address : '-',
		),
		array(
			'name'=>'address_phone',
			'value'=>$model->address_phone != '' ? $model->address_phone : '-',
		),
		array(
			'name'=>'address_yogya',
			'value'=>$model->address_yogya != '' ? $model->address_yogya : '-',
		),
		array(
			'name'=>'address_yogya_phone',
			'value'=>$model->address_yogya_phone != '' ? $model->address_yogya_phone : '-',
		),
		array(
			'name'=>'parent_name',
			'value'=>$model->parent_name != '' ? $model->parent_name : '-',
		),
		array(
			'name'=>'parent_work',
			'value'=>$model->parent_work != '' ? $model->parent_work : '-',
		),
		array(
			'name'=>'parent_religion',
			'value'=>$model->parent_religion != 0 ? Phrase::trans($model->parent_religion_relation->religion_name, 2) : '-',
		),
		array(
			'name'=>'parent_address',
			'value'=>$model->parent_address != '' ? $model->parent_address : '-',
		),
		array(
			'name'=>'parent_phone',
			'value'=>$model->parent_phone != '' ? $model->parent_phone : '-',
		),
		array(
			'name'=>'wali_name',
			'value'=>$model->wali_name != '' ? $model->wali_name : '-',
		),
		array(
			'name'=>'wali_work',
			'value'=>$model->wali_work != '' ? $model->wali_work : '-',
		),
		array(
			'name'=>'wali_religion',
			'value'=>$model->wali_religion,
			'value'=>$model->wali_religion != 0 ? Phrase::trans($model->wali_religion_relation->religion_name, 2) : '-',
		),
		array(
			'name'=>'wali_address',
			'value'=>$model->wali_address != '' ? $model->wali_address : '-',
		),
		array(
			'name'=>'wali_phone',
			'value'=>$model->wali_phone != '' ? $model->wali_phone : '-',
		),
		array(
			'name'=>'school_id',
			'value'=>$model->school_id != 0 ? 'Name: '.($model->school->school_name ? $model->school->school_name : '-').'<br/>Address: '.($model->school->school_address ? $model->school->school_address : '-').'<br/>Phone: '.($model->school->school_phone ? $model->school->school_phone : '-').'<br/> Status: '.($model->school->school_status == 1 ? Yii::t('phrase', 'Negeri') : Yii::t('phrase', 'Swasta')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'school_un_rank',
			'value'=>$model->school_un_rank != '' ? $model->school_un_rank : '-',
		),
		array(
			'name'=>'school_un_detail',
			'value'=>$model->school_un_detail != '' ? $model->school_un_detail : '-',
		),
		array(
			'name'=>'creation_date',
			'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->creation_date, true) : '-',
		),
		array(
			'name'=>'creation_id',
			'value'=>$model->creation_id != 0 ? $model->creation->displayname : '-',
		),
	),
)); ?>