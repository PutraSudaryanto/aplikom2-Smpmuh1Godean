<?php
/**
 * PsbRegisters * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
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
 * This is the model class for table "ommu_psb_registers".
 *
 * The followings are the available columns in table 'ommu_psb_registers':
 * @property string $register_id
 * @property string $author_id
 * @property integer $status
 * @property string $year_id
 * @property string $batch_id
 * @property string $register_name
 * @property integer $birth_province
 * @property string $birth_city
 * @property string $birth_date
 * @property string $address
 * @property string $address_phone
 * @property string $address_yogya
 * @property string $address_yogya_phone
 * @property string $parent_name
 * @property string $parent_work
 * @property string $parent_address
 * @property string $parent_phone
 * @property string $school_id
 * @property string $school_un_rank
 * @property string $creation_date
 *
 * The followings are the available model relations:
 * @property OmmuPsbYearBatch $batch
 * @property OmmuPsbYears $year
 * @property OmmuPsbSchools $school
 */
class PsbRegisters extends CActiveRecord
{
	public $defaultColumns = array();
	public $school_input;
	
	// Variable Search
	public $year_search;
	public $batch_search;
	public $school_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PsbRegisters the static model class
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
		return 'ommu_psb_registers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_id, register_name, birth_city, birth_date, address, address_phone, address_yogya, address_yogya_phone, 
				parent_name, parent_work, parent_address, parent_phone,
				school_input', 'required'),
			array('status, birth_province', 'numerical', 'integerOnly'=>true),
			array('year_id, batch_id, birth_city, school_id', 'length', 'max'=>11),
			array('address_phone, address_yogya_phone, parent_phone', 'length', 'max'=>15),
			array('register_name, parent_name, parent_work, school_un_rank', 'length', 'max'=>32),
			array('
				school_input', 'length', 'max'=>64),
			array('author_id, status, school_id, school_un_rank', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('register_id, author_id, status, year_id, batch_id, register_name, birth_province, birth_city, birth_date, address, address_phone, address_yogya, address_yogya_phone, parent_name, parent_work, parent_address, parent_phone, school_id, school_un_rank, creation_date,
				year_search, batch_search, school_search', 'safe', 'on'=>'search'),
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
			'year_relation' => array(self::BELONGS_TO, 'PsbYears', 'year_id'),
			'batch_relation' => array(self::BELONGS_TO, 'PsbYearBatch', 'batch_id'),
			'school_relation' => array(self::BELONGS_TO, 'PsbSchools', 'school_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'register_id' => 'Register',
			'author_id' => 'Author',
			'status' => 'Status',
			'year_id' => 'Year',
			'batch_id' => 'Batch',
			'register_name' => 'Register Name',
			'birth_province' => 'Birth Province',
			'birth_city' => 'Birth City',
			'birth_date' => 'Birth Date',
			'address' => 'Address',
			'address_phone' => 'Address Phone',
			'address_yogya' => 'Address Yogya',
			'address_yogya_phone' => 'Address Yogya Phone',
			'parent_name' => 'Parent Name',
			'parent_work' => 'Parent Work',
			'parent_address' => 'Parent Address',
			'parent_phone' => 'Parent Phone',
			'school_id' => 'School',
			'school_un_rank' => 'School Un Rank',
			'creation_date' => 'Creation Date',
			'year_search' => 'Year',
			'batch_search' => 'Batch',
			'school_search' => 'School',
			'school_input' => 'School',
		);
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

		$criteria->compare('t.register_id',$this->register_id,true);
		if(isset($_GET['author'])) {
			$criteria->compare('t.author_id',$_GET['author']);
		} else {
			$criteria->compare('t.author_id',$this->author_id);
		}
		$criteria->compare('t.status',$this->status);
		if(isset($_GET['year'])) {
			$criteria->compare('t.year_id',$_GET['year']);
		} else {
			$criteria->compare('t.year_id',$this->year_id);
		}
		if(isset($_GET['batch'])) {
			$criteria->compare('t.batch_id',$_GET['batch']);
		} else {
			$criteria->compare('t.batch_id',$this->batch_id);
		}
		$criteria->compare('t.register_name',$this->register_name,true);
		$criteria->compare('t.birth_province',$this->birth_province);
		$criteria->compare('t.birth_city',$this->birth_city,true);
		if($this->birth_date != null && !in_array($this->birth_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.birth_date)',date('Y-m-d', strtotime($this->birth_date)));
		$criteria->compare('t.address',$this->address,true);
		$criteria->compare('t.address_phone',$this->address_phone,true);
		$criteria->compare('t.address_yogya',$this->address_yogya,true);
		$criteria->compare('t.address_yogya_phone',$this->address_yogya_phone,true);
		$criteria->compare('t.parent_name',$this->parent_name,true);
		$criteria->compare('t.parent_work',$this->parent_work,true);
		$criteria->compare('t.parent_address',$this->parent_address,true);
		$criteria->compare('t.parent_phone',$this->parent_phone,true);
		if(isset($_GET['school'])) {
			$criteria->compare('t.school_id',$_GET['school']);
		} else {
			$criteria->compare('t.school_id',$this->school_id);
		}
		$criteria->compare('t.school_un_rank',$this->school_un_rank,true);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		
		// Custom Search
		$criteria->with = array(
			'year_relation' => array(
				'alias'=>'year_relation',
				'select'=>'years'
			),
			'batch_relation' => array(
				'alias'=>'batch_relation',
				'select'=>'batch_name'
			),
			'school_relation' => array(
				'alias'=>'school_relation',
				'select'=>'school_name'
			),
		);
		$criteria->compare('year_relation.years',strtolower($this->year_search), true);
		$criteria->compare('batch_relation.batch_name',strtolower($this->batch_search), true);
		$criteria->compare('school_relation.school_name',strtolower($this->school_search), true);

		if(!isset($_GET['PsbRegisters_sort']))
			$criteria->order = 'register_id DESC';

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
			//$this->defaultColumns[] = 'register_id';
			$this->defaultColumns[] = 'author_id';
			$this->defaultColumns[] = 'status';
			$this->defaultColumns[] = 'year_id';
			$this->defaultColumns[] = 'batch_id';
			$this->defaultColumns[] = 'register_name';
			$this->defaultColumns[] = 'birth_province';
			$this->defaultColumns[] = 'birth_city';
			$this->defaultColumns[] = 'birth_date';
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'address_phone';
			$this->defaultColumns[] = 'address_yogya';
			$this->defaultColumns[] = 'address_yogya_phone';
			$this->defaultColumns[] = 'parent_name';
			$this->defaultColumns[] = 'parent_work';
			$this->defaultColumns[] = 'parent_address';
			$this->defaultColumns[] = 'parent_phone';
			$this->defaultColumns[] = 'school_id';
			$this->defaultColumns[] = 'school_un_rank';
			$this->defaultColumns[] = 'creation_date';
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
				'name' => 'year_search',
				'value' => '$data->year_relation->years',
			);
			$this->defaultColumns[] = array(
				'name' => 'batch_search',
				'value' => '$data->batch_relation->batch_name',
			);
			$this->defaultColumns[] = array(
				'name' => 'register_name',
				'value' => '$data->register_name."<br/><span>".$data->address."</span>"',
				'htmlOptions' => array(
					'class' => 'bold',
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'school_search',
				'value' => '$data->school_relation->school_name',
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
					'name' => 'status',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("status",array("id"=>$data->register_id)), $data->status, 1)',
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

}