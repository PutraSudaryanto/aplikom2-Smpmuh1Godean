<?php
/**
 * PsbSchools
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link https://github.com/Ommu/Ommu-PSB
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
 * This is the model class for table "ommu_psb_schools".
 *
 * The followings are the available columns in table 'ommu_psb_schools':
 * @property string $school_id
 * @property integer $publish
 * @property string $school_name
 * @property string $school_address
 * @property string $school_phone
 * @property string $school_status
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property OmmuPsbRegisters[] $ommuPsbRegisters
 */
class PsbSchools extends CActiveRecord
{
	public $defaultColumns = array();
	
	// Variable Search
	public $creation_search;
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PsbSchools the static model class
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
		return 'ommu_psb_schools';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('school_name', 'required'),
			array('school_address, school_phone, school_status', 'required', 'on'=>'masterEdit'),
			array('publish, school_status', 'numerical', 'integerOnly'=>true),
			array('school_name', 'length', 'max'=>64),
			array('school_phone', 'length', 'max'=>15),
			array('school_address, school_phone, school_status', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('school_id, publish, school_name, school_address, school_phone, school_status, creation_date, creation_id, modified_date, modified_id,
				creation_search, modified_search', 'safe', 'on'=>'search'),
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
			'registers' => array(self::HAS_MANY, 'PsbRegisters', 'school_id'),
			'creation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
			'view' => array(self::BELONGS_TO, 'ViewPsbSchools', 'school_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'school_id' => Yii::t('attribute', 'School'),
            'publish' => Yii::t('attribute', 'Publish'),
            'school_name' => Yii::t('attribute', 'School Name'),
            'school_address' => Yii::t('attribute', 'School Address'),
            'school_phone' => Yii::t('attribute', 'School Phone'),
            'school_status' => Yii::t('attribute', 'School Status'),
            'creation_date' => Yii::t('attribute', 'Creation Date'),
            'creation_id' => Yii::t('attribute', 'Creation'),
            'modified_date' => Yii::t('attribute', 'Modified Date'),
            'modified_id' => Yii::t('attribute', 'Modified'),
            'creation_search' => Yii::t('attribute', 'Creation'),
            'modified_search' => Yii::t('attribute', 'Modified'),
		);
        /* 
            'School' => 'School',
            'Publish' => 'Publish',
            'School Name' => 'School Name',
            'School Address' => 'School Address',
            'School Phone' => 'School Phone',
            'School Status' => 'School Status',
            'Creation Date' => 'Creation Date',
            'Creation' => 'Creation',
            'Modified Date' => 'Modified Date',
            'Modified' => 'Modified',         
        */ 		
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.school_id',$this->school_id,true);
		if(isset($_GET['type']) && $_GET['type'] == 'publish')
			$criteria->compare('t.publish',1);
		elseif(isset($_GET['type']) && $_GET['type'] == 'unpublish')
			$criteria->compare('t.publish',0);
		elseif(isset($_GET['type']) && $_GET['type'] == 'trash')
			$criteria->compare('t.publish',2);
		else {
			$criteria->addInCondition('t.publish',array(0,1));
			$criteria->compare('t.publish',$this->publish);
		}
		$criteria->compare('t.school_name',$this->school_name,true);
		$criteria->compare('t.school_address',$this->school_address,true);
		$criteria->compare('t.school_phone',$this->school_phone,true);
		$criteria->compare('t.school_status',$this->school_status);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		$criteria->compare('t.creation_id',$this->creation_id,true);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		$criteria->compare('t.modified_id',$this->modified_id,true);
		
		// Custom Search
		$criteria->with = array(
			'creation' => array(
				'alias'=>'creation',
				'select'=>'displayname'
			),
			'modified' => array(
				'alias'=>'modified',
				'select'=>'displayname'
			),
		);
		$criteria->compare('creation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified.displayname',strtolower($this->modified_search), true);

		if(!isset($_GET['PsbSchools_sort']))
			$criteria->order = 'school_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>30,
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
		} else {
			//$this->defaultColumns[] = 'school_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'school_name';
			$this->defaultColumns[] = 'school_address';
			$this->defaultColumns[] = 'school_phone';
			$this->defaultColumns[] = 'school_status';
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
				'name' => 'school_name',
				'value' => '$data->school_name',
			);
			$this->defaultColumns[] = 'school_address';
			$this->defaultColumns[] = 'school_phone';
			$this->defaultColumns[] = array(
				'name' => 'school_status',
				'value' => '$data->school_status == 1 ? "Negeri" : "Swasta"',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Negeri'),
					0=>Yii::t('phrase', 'Swasta'),
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'header' => 'registers',
				'value' => 'CHtml::link($data->view->registers, Yii::app()->controller->createUrl("o/admin/manage",array("school"=>$data->school_id)))',
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_search',
				'value' => '$data->creation->displayname',
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
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->school_id)), $data->publish, 1)',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'filter'=>array(
						1=>Yii::t('phrase', 'Yes'),
						0=>Yii::t('phrase', 'No'),
					),
					'type' => 'raw',
				);
			}
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
	public static function getSchool() {
		
		$criteria=new CDbCriteria;		
		$model = self::model()->findAll($criteria);

		$items = array();
		if($model != null) {
			foreach($model as $key => $val) {
				$items[$val->school_id] = $val->school_name;
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
		}
		return true;
	}

}