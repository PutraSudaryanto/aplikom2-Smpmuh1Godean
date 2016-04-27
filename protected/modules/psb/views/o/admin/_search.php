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
			<?php echo $model->getAttributeLabel('status'); ?><br/>
			<?php echo $form->textField($model,'status'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('year_id'); ?><br/>
			<?php echo $form->textField($model,'year_id',array('size'=>11,'maxlength'=>11)); ?>
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
			<?php echo $model->getAttributeLabel('birth_province'); ?><br/>
			<?php echo $form->textField($model,'birth_province'); ?>
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
			<?php echo $model->getAttributeLabel('parent_address'); ?><br/>
			<?php echo $form->textArea($model,'parent_address',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('parent_phone'); ?><br/>
			<?php echo $form->textField($model,'parent_phone',array('size'=>15,'maxlength'=>15)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('school_id'); ?><br/>
			<?php echo $form->textField($model,'school_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('school_un_rank'); ?><br/>
			<?php echo $form->textField($model,'school_un_rank',array('size'=>32,'maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_date'); ?><br/>
			<?php echo $form->textField($model,'creation_date'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
