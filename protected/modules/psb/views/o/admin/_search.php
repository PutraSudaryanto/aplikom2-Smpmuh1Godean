<?php
/**
 * Psb Registers (psb-registers)
 * @var $this AdminController
 * @var $model PsbRegisters
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 27 April 2016, 12:23 WIB
 * @link https://github.com/Ommu/Ommu-PSB
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('register_id'); ?><br/>
			<?php echo $form->textField($model,'register_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('author_id'); ?><br/>
			<?php echo $form->textField($model,'author_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('status'); ?><br/>
			<?php echo $form->textField($model,'status'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('nisn'); ?><br/>
			<?php echo $form->textField($model,'nisn',array('size'=>12,'maxlength'=>12)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('batch_id'); ?><br/>
			<?php echo $form->textField($model,'batch_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('register_name'); ?><br/>
			<?php echo $form->textField($model,'register_name',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('birth_city'); ?><br/>
			<?php echo $form->textField($model,'birth_city',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('birth_date'); ?><br/>
			<?php echo $form->textField($model,'birth_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('gender'); ?><br/>
			<?php echo $form->textField($model,'gender',array('size'=>6,'maxlength'=>6)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('religion'); ?><br/>
			<?php echo $form->textField($model,'religion'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('address'); ?><br/>
			<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('address_phone'); ?><br/>
			<?php echo $form->textField($model,'address_phone',array('size'=>15,'maxlength'=>15)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('address_yogya'); ?><br/>
			<?php echo $form->textArea($model,'address_yogya',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('address_yogya_phone'); ?><br/>
			<?php echo $form->textField($model,'address_yogya_phone',array('size'=>15,'maxlength'=>15)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('parent_name'); ?><br/>
			<?php echo $form->textField($model,'parent_name',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('parent_work'); ?><br/>
			<?php echo $form->textField($model,'parent_work',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('parent_religion'); ?><br/>
			<?php echo $form->textField($model,'parent_religion'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('parent_address'); ?><br/>
			<?php echo $form->textArea($model,'parent_address',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('parent_phone'); ?><br/>
			<?php echo $form->textField($model,'parent_phone',array('size'=>15,'maxlength'=>15)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('wali_name'); ?><br/>
			<?php echo $form->textField($model,'wali_name',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('wali_work'); ?><br/>
			<?php echo $form->textField($model,'wali_work',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('wali_religion'); ?><br/>
			<?php echo $form->textField($model,'wali_religion'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('wali_address'); ?><br/>
			<?php echo $form->textArea($model,'wali_address',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('wali_phone'); ?><br/>
			<?php echo $form->textField($model,'wali_phone',array('size'=>15,'maxlength'=>15)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('school_id'); ?><br/>
			<?php echo $form->textField($model,'school_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('school_un_rank'); ?><br/>
			<?php echo $form->textArea($model,'school_un_rank',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_date'); ?><br/>
			<?php echo $form->textField($model,'creation_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_id'); ?><br/>
			<?php echo $form->textField($model,'creation_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
