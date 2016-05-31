<?php
/**
 * Support Contact Category (support-contact-category)
 * @var $this ContactcategoryController
 * @var $model SupportContactCategory
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Support
 * @contact (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'support-contact-category-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
		'on_post' => 'on_post',
	),
)); ?>
<div class="dialog-content">

	<fieldset>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'title'); ?>
			<div class="desc">
				<?php 
				$model->title = Phrase::trans($model->name, 2);
				echo $form->textField($model,'title',array('maxlength'=>32,'class'=>'span-7')); ?>
				<?php echo $form->error($model,'title'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<?php if(!$model->isNewRecord) {
			$model->old_icon = $model->icons;
			echo $form->hiddenField($model,'old_icon');
			if($model->icons != '') {
				$file = Yii::app()->request->baseUrl.'/public/support/'.$model->icons;
				$media = '<img src="'.Utility::getTimThumb($file, 100, 200, 3).'" alt="'.$model->title.'">';
				echo '<div class="clearfix">';
				echo $form->labelEx($model,'old_icon');
				echo '<div class="desc">'.$media.'</div>';
				echo '</div>';
			}
		} ?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'icons'); ?>
			<div class="desc">
				<?php echo $form->fileField($model,'icons'); ?>
				<?php echo $form->error($model,'icons'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<?php if($model->publish != 2) {?>
		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'publish'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'publish'); ?>
				<?php echo $form->labelEx($model,'publish'); ?>
				<?php echo $form->error($model,'publish'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
		<?php }?>
	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>

<?php $this->endWidget(); ?>
