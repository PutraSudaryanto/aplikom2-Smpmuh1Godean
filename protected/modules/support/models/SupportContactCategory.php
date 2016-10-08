<?php
/**
 * SupportContactCategory
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Support
 * @contact (+62)856-299-4114
 *
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * --------------------------------------------------------------------------------------
 *
 * This is the model class for table "ommu_support_contact_category".
 *
 * The followings are the available columns in table 'ommu_support_contact_category':
 * @property integer $cat_id
 * @property integer $publish
 * @property integer $orders
 * @property string $icons
 * @property integer $name
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property OmmuSupportContacts[] $ommuSupportContacts
 */
class SupportContactCategory extends CActiveRecord
{
	public $defaultColumns = array();
	public $title;
	public $old_icon;
	
	// Variable Search
	public $creation_search;
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SupportContactCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ommu_support_contact_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('publish, orders, name, creation_id, modified_id', 'numerical', 'integerOnly'=>true),
			array('title, icons', 'length', 'max'=>32),
			array('icons,
				old_icon', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cat_id, publish, orders, icons, name, creation_date, creation_id, modified_date, modified_id,
				title, creation_search, modified_search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'view_cat' => array(self::BELONGS_TO, 'ViewSupportContactCategory', 'cat_id'),
			'creation_relation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified_relation' => array(self::BELONGS_TO, 'Users', 'modified_id'),
			'contact' => array(self::HAS_MANY, 'SupportContacts', 'cat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cat_id' => Yii::t('attribute', 'Category'),
			'publish' => Yii::t('attribute', 'Publish'),
			'orders' => Yii::t('attribute', 'Orders'),
			'icons' => Yii::t('attribute', 'Icons'),
			'name' => Yii::t('attribute', 'Category'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'title' => Yii::t('attribute', 'Category'),
			'old_icon' => Yii::t('attribute', 'Old Icon'),
			'creation_search' => Yii::t('attribute', 'Creation'),
			'modified_search' => Yii::t('attribute', 'Modified'),
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.cat_id',$this->cat_id);
		if(isset($_GET['type']) && $_GET['type'] == 'publish') {
			$criteria->compare('t.publish',1);
		} elseif(isset($_GET['type']) && $_GET['type'] == 'unpublish') {
			$criteria->compare('t.publish',0);
		} elseif(isset($_GET['type']) && $_GET['type'] == 'nopublish') {
			$criteria->compare('t.publish',2);
		} else {
			$criteria->addInCondition('t.publish',array(0,1,2));
			$criteria->compare('t.publish',$this->publish);
		}
		$criteria->compare('t.orders',$this->orders);
		$criteria->compare('t.icons',$this->icons,true);
		$criteria->compare('t.name',$this->name);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		$criteria->compare('t.creation_id',$this->creation_id);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		$criteria->compare('t.modified_id',$this->modified_id);
		
		// Custom Search
		$criteria->with = array(
			'view_cat' => array(
				'alias'=>'view_cat',
				'select'=>'category_name'
			),
			'creation_relation' => array(
				'alias'=>'creation_relation',
				'select'=>'displayname',
			),
			'modified_relation' => array(
				'alias'=>'modified_relation',
				'select'=>'displayname',
			),
		);
		$criteria->compare('view_cat.category_name',strtolower($this->title), true);
		$criteria->compare('creation_relation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified_relation.displayname',strtolower($this->modified_search), true);
		
		if(!isset($_GET['SupportContactCategory_sort']))
			$criteria->order = 't.cat_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		}else {
			//$this->defaultColumns[] = 'cat_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'orders';
			$this->defaultColumns[] = 'icons';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'creation_id';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'name' => 'title',
				'value' => 'Phrase::trans($data->name, 2)',
			);
			$this->defaultColumns[] = array(
				'name' => 'icons',
				'value' => '$data->icons != "" ? CHtml::link($data->icons, Yii::app()->request->baseUrl.\'/public/support/\'.$data->icons, array(\'target\' => \'_blank\')) : "-"',
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_search',
				'value' => '$data->creation_relation->displayname',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_date',
				'value' => 'Utility::dateFormat($data->creation_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'creation_date',
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'creation_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			$this->defaultColumns[] = array(
				'name' => 'publish',
				'value' => '$data->publish == 2 ? "-" : Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->cat_id)), $data->publish, 1) ',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);

		}
		parent::afterConstruct();
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::model()->findByPk($id,array(
				'select' => $column
			));
			return $model->$column;
			
		} else {
			$model = self::model()->findByPk($id);
			return $model;			
		}
	}

	/**
	 * Get category
	 * 0 = unpublish
	 * 1 = publish
	 */
	public static function getCategory($publish=null) {
		if($publish == null) {
			$model = self::model()->findAll();
		} else {
			$model = self::model()->findAll(array(
				//'select' => 'publish, name',
				'condition' => 'publish = :publish',
				'params' => array(
					':publish' => $publish,
				),
				//'order' => 'cat_id ASC'
			));
		}

		$items = array();
		if($model != null) {
			foreach($model as $key => $val) {
				$items[$val->cat_id] = Phrase::trans($val->name, 2);
			}
			return $items;
		} else {
			return false;
		}
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			if($this->isNewRecord)
				$this->creation_id = Yii::app()->user->id;
			else
				$this->modified_id = Yii::app()->user->id;
			
			$media = CUploadedFile::getInstance($this, 'icons');
			if($media->name != '') {
				$extension = pathinfo($media->name, PATHINFO_EXTENSION);
				if(!in_array(strtolower($extension), array('bmp','gif','jpg','png')))
					$this->addError('icons', 'The file "'.$media->name.'" cannot be uploaded. Only files with these extensions are allowed: bmp, gif, jpg, png.');
			}
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$action = strtolower(Yii::app()->controller->action->id);
			
			if($this->isNewRecord) {
				$location = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
				$title=new OmmuSystemPhrase;
				$title->location = $location.'_title';
				$title->en_us = $this->title;
				if($title->save())
					$this->name = $title->phrase_id;
			
			} else {
				$title = OmmuSystemPhrase::model()->findByPk($this->name);
				$title->en_us = $this->title;
				$title->save();
			}
				
			//upload proposal
			if(in_array($action, array('add','edit'))) {
				$support_path = "public/support";
				$this->icons = CUploadedFile::getInstance($this, 'icons');
				if($this->icons instanceOf CUploadedFile) {
					$fileName = Utility::getUrlTitle($this->title).'_'.time().'.'.strtolower($this->icons->extensionName);
					if($this->icons->saveAs($support_path.'/'.$fileName)) {						
						if(!$this->isNewRecord && $this->old_icon != '' && file_exists($support_path.'/'.$this->old_icon))
							rename($support_path.'/'.$this->old_icon, 'public/support/verwijderen/'.$this->cat_id.'_'.$this->old_icon);
						$this->icons = $fileName;
					}
				}
				
				if(!$this->isNewRecord && $this->icons == '') {
					$this->icons = $this->old_icon;
				}
			}
		}
		return true;
	}

	/**
	 * After delete attributes
	 */
	protected function afterDelete() {
		parent::afterDelete();
		//delete support image
		$support_path = "public/support";
		if($this->icons != '' && file_exists($support_path.'/'.$this->icons)) {
			rename($support_path.'/'.$this->icons, 'public/support/verwijderen/'.$this->cat_id.'_'.$this->icons);
		}
	}
}