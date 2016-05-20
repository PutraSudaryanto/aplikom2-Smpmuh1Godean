<?php
/**
 * Psb Year Batches (psb-year-batch)
 * @var $this BatchController
 * @var $model PsbYearBatch
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link https://github.com/Ommu/Ommu-PSB
 * @contect (+62)856-299-4114
 *
 */
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'psb-year-batch-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>
<div class="dialog-content">
	<fieldset>

		<?php //begin.Messages ?>
		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>
		<?php //begin.Messages ?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'year_id'); ?>
			<div class="desc">
				<?php
				if($model->isNewRecord && isset($_GET['id']))
					$model->year_id = $_GET['id'];
				$year = PsbYears::getYear();
				if($year != null)
					echo $form->dropDownList($model,'year_id', $year);					
				else
					echo $form->dropDownList($model,'year_id', array('prompt'=>'No Years')); ?>
				<?php echo $form->error($model,'year_id'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'batch_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'batch_name',array('class'=>'span-6','maxlength'=>32)); ?>
				<?php echo $form->error($model,'batch_name'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'batch_start'); ?>
			<div class="desc">
				<?php
				!$model->isNewRecord ? ($model->batch_start != '0000-00-00' ? $model->batch_start = date('d-m-Y', strtotime($model->batch_start)) : '') : '';
				//echo $form->textField($model,'batch_start');
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'model'=>$model,
					'attribute'=>'batch_start',
					//'mode'=>'datetime',
					'options'=>array(
						'dateFormat' => 'dd-mm-yy',
					),
					'htmlOptions'=>array(
						'class' => 'span-6',
					 ),
				)); ?>
				<?php echo $form->error($model,'batch_start'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'batch_finish'); ?>
			<div class="desc">
				<?php
				!$model->isNewRecord ? ($model->batch_finish != '0000-00-00' ? $model->batch_finish = date('d-m-Y', strtotime($model->batch_finish)) : '') : '';
				//echo $form->textField($model,'batch_finish');
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'model'=>$model,
					'attribute'=>'batch_finish',
					//'mode'=>'datetime',
					'options'=>array(
						'dateFormat' => 'dd-mm-yy',
					),
					'htmlOptions'=>array(
						'class' => 'span-6',
					 ),
				)); ?>
				<?php echo $form->error($model,'batch_finish'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'batch_valuation'); ?>
			<div class="desc">
				<?php echo $form->dropDownList($model,'batch_valuation', array(
					1=>Yii::t('phrase', 'Ujian Nasional'),
					0=>Yii::t('phrase', 'Raport'),					
				)); ?>
				<?php echo $form->error($model,'batch_valuation'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'publish'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'publish'); ?>
				<?php echo $form->labelEx($model,'publish'); ?>
				<?php echo $form->error($model,'publish'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>


