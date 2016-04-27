<?php
/**
 * Psb Years (psb-years)
 * @var $this YearController
 * @var $model PsbYears
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Psb Years'=>array('manage'),
		$model->year_id=>array('view','id'=>$model->year_id),
		'Update',
	);
?>

<div class="form" name="post-on">
<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'psb-years-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>
	<fieldset>
		<?php //begin.Messages ?>
		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>
		<?php //begin.Messages ?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'years'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'years',array('maxlength'=>9,'class'=>'span-5')); ?>
				<?php echo $form->error($model,'years'); ?>
				<div class="small-px silent">Contoh: 2015/2016</div>
			</div>
		</div>
		
		<?php if(!$model->isNewRecord) {?>			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'course_input'); ?>
				<div class="desc">
					<?php 
					//echo $form->textField($model,'course_input',array('maxlength'=>32,'class'=>'span-7'));					
					$url = Yii::app()->controller->createUrl('o/yearcourse/add', array('type'=>'year'));
					$year = $model->year_id;
					$courseId = 'PsbYears_course_input';
					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'model' => $model,
						'attribute' => 'course_input',
						'source' => Yii::app()->controller->createUrl('course/suggest'),
						'options' => array(
							//'delay '=> 50,
							'minLength' => 1,
							'showAnim' => 'fold',
							'select' => "js:function(event, ui) {
								$.ajax({
									type: 'post',
									url: '$url',
									data: { year_id: '$year', course_id: ui.item.id, body: ui.item.value },
									dataType: 'json',
									success: function(response) {
										$('form #$courseId').val('');
										$('form #course-suggest').append(response.data);
									}
								});
							}"
						),
						'htmlOptions' => array(
							'class'	=> 'span-6',
						),
					));
					echo $form->error($model,'course_input');
					?>
					<div id="course-suggest" class="suggest clearfix">
						<?php if($course != null) {
							foreach($course as $key => $val) {?>
								<div><?php echo ucwords($val->course_relation->course_name);?><a href="<?php echo Yii::app()->controller->createUrl('o/yearcourse/delete',array('id'=>$val->id,'type'=>'year'));?>" title="<?php echo Yii::t('phrase', 'Delete');?>"><?php echo Yii::t('phrase', 'Delete');?></a></div>
						<?php }
						} ?>
					</div>
				</div>
			</div>
		<?php }?>

		<div class="submit clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
			</div>
		</div>

	</fieldset>
<?php $this->endWidget(); ?>
</div>

<div class="contentmenu clearfix">
<ul class="left clearfix">
	<li><a href="<?php echo Yii::app()->controller->createUrl('o/batch/add',array('id'=>$model->year_id,'type'=>'year'));?>" title="Tambah Gelombang"><span class="icons">C</span>Tambah Gelombang</a></li>
</ul>
</div>

<div id="partial-psb-year-batch">
	<?php //begin.Messages ?>
	<div id="ajax-message">
	<?php
	if(Yii::app()->user->hasFlash('error'))
		echo Utility::flashError(Yii::app()->user->getFlash('error'));
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
	?>
	</div>
	<?php //begin.Messages ?>

	<div class="boxed">
		<?php //begin.Grid Item ?>
		<?php 
			$columnData   = $columns;
			array_push($columnData, array(
				'header' => Yii::t('phrase', 'Options'),
				'class'=>'CButtonColumn',
				'buttons' => array(
					'view' => array(
						'label' => 'view',
						'options' => array(							
							'class' => 'view',
						),
						'url' => 'Yii::app()->controller->createUrl("o/batch/view",array("id"=>$data->primaryKey, "type"=>"year"))'),
					'update' => array(
						'label' => 'update',
						'options' => array(
							'class' => 'update'
						),
						'url' => 'Yii::app()->controller->createUrl("o/batch/edit",array("id"=>$data->primaryKey, "type"=>"year"))'),
					'delete' => array(
						'label' => 'delete',
						'options' => array(
							'class' => 'delete'
						),
						'url' => 'Yii::app()->controller->createUrl("o/batch/delete",array("id"=>$data->primaryKey, "type"=>"year"))')
				),
				'template' => '{update}|{delete}',
			));

			$this->widget('application.components.system.OGridView', array(
				'id'=>'psb-year-batch-grid',
				'dataProvider'=>$batch->search(),
				'filter'=>$batch,
				'columns' => $columnData,
				'pager' => array('header' => ''),
			));
		?>
		<?php //end.Grid Item ?>
	</div>
</div>