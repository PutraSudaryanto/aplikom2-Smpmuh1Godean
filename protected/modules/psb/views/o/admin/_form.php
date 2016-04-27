<?php
/**
 * Psb Registers (psb-registers)
 * @var $this Admin1Controller * @var $model PsbRegisters * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'psb-registers-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<?php //begin.Messages ?>
<div id="ajax-message">
	<?php echo $form->errorSummary($model); ?>
</div>
<?php //begin.Messages ?>

<fieldset>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'status'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'status'); ?>
			<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->error($model,'status'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'year_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'year_id',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'year_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'batch_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'batch_id',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'batch_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'register_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'register_name',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'register_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'birth_province'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'birth_province'); ?>
			<?php echo $form->error($model,'birth_province'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'birth_city'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'birth_city',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'birth_city'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'birth_date'); ?>
		<div class="desc">
			<?php
			!$model->isNewRecord ? ($model->birth_date != '0000-00-00' ? $model->birth_date = date('d-m-Y', strtotime($model->birth_date)) : '') : '';
			//echo $form->textField($model,'birth_date');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'birth_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			)); ?>
			<?php echo $form->error($model,'birth_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'address'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'address_phone'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'address_phone',array('size'=>15,'maxlength'=>15)); ?>
			<?php echo $form->error($model,'address_phone'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'address_yogya'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'address_yogya',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address_yogya'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'address_yogya_phone'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'address_yogya_phone',array('size'=>15,'maxlength'=>15)); ?>
			<?php echo $form->error($model,'address_yogya_phone'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'parent_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'parent_name',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'parent_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'parent_work'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'parent_work',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'parent_work'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'parent_address'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'parent_address',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'parent_address'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'parent_phone'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'parent_phone',array('size'=>15,'maxlength'=>15)); ?>
			<?php echo $form->error($model,'parent_phone'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'school_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'school_id',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'school_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'school_un_rank'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'school_un_rank',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'school_un_rank'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'creation_date'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'creation_date'); ?>
			<?php echo $form->error($model,'creation_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="submit clearfix">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
		</div>
	</div>

</fieldset>
<?php /*
<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
*/?>
<?php $this->endWidget(); ?>


