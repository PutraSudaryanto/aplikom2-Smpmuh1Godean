<?php
/**
 * PsbRegisters
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 27 April 2016, 12:05 WIB
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
 * @property string $nisn
 * @property string $batch_id
 * @property string $register_name
 * @property string $birth_city
 * @property string $birth_date
 * @property string $gender
 * @property integer $religion
 * @property string $address
 * @property string $address_phone
 * @property string $address_yogya
 * @property string $address_yogya_phone
 * @property string $parent_name
 * @property string $parent_work
 * @property integer $parent_religion
 * @property string $parent_address
 * @property string $parent_phone
 * @property string $wali_name
 * @property string $wali_work
 * @property integer $wali_religion
 * @property string $wali_address
 * @property string $wali_phone
 * @property string $school_id
 * @property string $school_un_rank
 * @property string $creation_date
 * @property string $creation_id
 *
 * The followings are the available model relations:
 * @property OmmuPsbYearBatch $batch
 * @property OmmuPsbSchools $school
 */
class PsbRegisters extends CActiveRecord
{
	public $defaultColumns = array();
	
	// Variable Search
	public $creation_search;

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
			array('author_id, status, nisn, batch_id, register_name, birth_city, gender, religion, address, address_phone, address_yogya, address_yogya_phone, parent_name, parent_work, parent_religion, parent_address, parent_phone, wali_name, wali_work, wali_religion, wali_address, wali_phone, school_id, school_un_rank, creation_date, creation_id', 'required'),
			array('status, religion, parent_religion, wali_religion', 'numerical', 'integerOnly'=>true),
			array('author_id, batch_id, birth_city, school_id, creation_id', 'length', 'max'=>11),
			array('nisn', 'length', 'max'=>12),
			array('register_name, parent_name, parent_work, wali_name, wali_work', 'length', 'max'=>32),
			array('gender', 'length', 'max'=>6),
			array('address_phone, address_yogya_phone, parent_phone, wali_phone', 'length', 'max'=>15),
			array('birth_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('register_id, author_id, status, nisn, batch_id, register_name, birth_city, birth_date, gender, religion, address, address_phone, address_yogya, address_yogya_phone, parent_name, parent_work, parent_religion, parent_address, parent_phone, wali_name, wali_work, wali_religion, wali_address, wali_phone, school_id, school_un_rank, creation_date, creation_id,
				creation_search', 'safe', 'on'=>'search'),
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
			'batch_relation' => array(self::BELONGS_TO, 'PsbYearBatch', 'batch_id'),
			'school_relation' => array(self::BELONGS_TO, 'PsbSchools', 'school_id'),
			'religion_relation' => array(self::BELONGS_TO, 'PsbReligions', 'religion'),
			'creation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'register_id' => Yii::t('attribute', 'Register'),
			'author_id' => Yii::t('attribute', 'Author'),
			'status' => Yii::t('attribute', 'Status'),
			'nisn' => Yii::t('attribute', 'Nisn'),
			'batch_id' => Yii::t('attribute', 'Batch'),
			'register_name' => Yii::t('attribute', 'Register Name'),
			'birth_city' => Yii::t('attribute', 'Birth City'),
			'birth_date' => Yii::t('attribute', 'Birth Date'),
			'gender' => Yii::t('attribute', 'Gender'),
			'religion' => Yii::t('attribute', 'Religion'),
			'address' => Yii::t('attribute', 'Address'),
			'address_phone' => Yii::t('attribute', 'Address Phone'),
			'address_yogya' => Yii::t('attribute', 'Address Yogya'),
			'address_yogya_phone' => Yii::t('attribute', 'Address Yogya Phone'),
			'parent_name' => Yii::t('attribute', 'Parent Name'),
			'parent_work' => Yii::t('attribute', 'Parent Work'),
			'parent_religion' => Yii::t('attribute', 'Parent Religion'),
			'parent_address' => Yii::t('attribute', 'Parent Address'),
			'parent_phone' => Yii::t('attribute', 'Parent Phone'),
			'wali_name' => Yii::t('attribute', 'Wali Name'),
			'wali_work' => Yii::t('attribute', 'Wali Work'),
			'wali_religion' => Yii::t('attribute', 'Wali Religion'),
			'wali_address' => Yii::t('attribute', 'Wali Address'),
			'wali_phone' => Yii::t('attribute', 'Wali Phone'),
			'school_id' => Yii::t('attribute', 'School'),
			'school_un_rank' => Yii::t('attribute', 'School Un Rank'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'creation_search' => Yii::t('attribute', 'Creation'),
		);
		/*
			'Register' => 'Register',
			'Author' => 'Author',
			'Status' => 'Status',
			'Nisn' => 'Nisn',
			'Batch' => 'Batch',
			'Register Name' => 'Register Name',
			'Birth City' => 'Birth City',
			'Birth Date' => 'Birth Date',
			'Gender' => 'Gender',
			'Religion' => 'Religion',
			'Address' => 'Address',
			'Address Phone' => 'Address Phone',
			'Address Yogya' => 'Address Yogya',
			'Address Yogya Phone' => 'Address Yogya Phone',
			'Parent Name' => 'Parent Name',
			'Parent Work' => 'Parent Work',
			'Parent Religion' => 'Parent Religion',
			'Parent Address' => 'Parent Address',
			'Parent Phone' => 'Parent Phone',
			'Wali Name' => 'Wali Name',
			'Wali Work' => 'Wali Work',
			'Wali Religion' => 'Wali Religion',
			'Wali Address' => 'Wali Address',
			'Wali Phone' => 'Wali Phone',
			'School' => 'School',
			'School Un Rank' => 'School Un Rank',
			'Creation Date' => 'Creation Date',
			'Creation' => 'Creation',
		
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

		$criteria->compare('t.register_id',strtolower($this->register_id),true);
		$criteria->compare('t.author_id',strtolower($this->author_id),true);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.nisn',strtolower($this->nisn),true);
		if(isset($_GET['batch']))
			$criteria->compare('t.batch_id',$_GET['batch']);
		else
			$criteria->compare('t.batch_id',$this->batch_id);
		$criteria->compare('t.register_name',strtolower($this->register_name),true);
		$criteria->compare('t.birth_city',strtolower($this->birth_city),true);
		if($this->birth_date != null && !in_array($this->birth_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.birth_date)',date('Y-m-d', strtotime($this->birth_date)));
		$criteria->compare('t.gender',strtolower($this->gender),true);
		if(isset($_GET['religion']))
			$criteria->compare('t.religion',$_GET['religion']);
		else
			$criteria->compare('t.religion',$this->religion);			
		$criteria->compare('t.address',strtolower($this->address),true);
		$criteria->compare('t.address_phone',strtolower($this->address_phone),true);
		$criteria->compare('t.address_yogya',strtolower($this->address_yogya),true);
		$criteria->compare('t.address_yogya_phone',strtolower($this->address_yogya_phone),true);
		$criteria->compare('t.parent_name',strtolower($this->parent_name),true);
		$criteria->compare('t.parent_work',strtolower($this->parent_work),true);
		if(isset($_GET['parentreligion']))
			$criteria->compare('t.parent_religion',$_GET['parentreligion']);
		else
			$criteria->compare('t.parent_religion',$this->parent_religion);
		$criteria->compare('t.parent_address',strtolower($this->parent_address),true);
		$criteria->compare('t.parent_phone',strtolower($this->parent_phone),true);
		$criteria->compare('t.wali_name',strtolower($this->wali_name),true);
		$criteria->compare('t.wali_work',strtolower($this->wali_work),true);
		if(isset($_GET['walireligion']))
			$criteria->compare('t.wali_religion',$_GET['walireligion']);
		else
			$criteria->compare('t.wali_religion',$this->wali_religion);
		$criteria->compare('t.wali_address',strtolower($this->wali_address),true);
		$criteria->compare('t.wali_phone',strtolower($this->wali_phone),true);
		if(isset($_GET['school']))
			$criteria->compare('t.school_id',$_GET['school']);
		else
			$criteria->compare('t.school_id',$this->school_id);
		$criteria->compare('t.school_un_rank',strtolower($this->school_un_rank),true);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		if(isset($_GET['creation']))
			$criteria->compare('t.creation_id',$_GET['creation']);
		else
			$criteria->compare('t.creation_id',$this->creation_id);
		
		// Custom Search
		$criteria->with = array(
			'creation' => array(
				'alias'=>'creation',
				'select'=>'displayname'
			),
		);
		$criteria->compare('creation.displayname',strtolower($this->creation_search), true);

		if(!isset($_GET['PsbRegisters_sort']))
			$criteria->order = 't.register_id DESC';

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
			$this->defaultColumns[] = 'nisn';
			$this->defaultColumns[] = 'batch_id';
			$this->defaultColumns[] = 'register_name';
			$this->defaultColumns[] = 'birth_city';
			$this->defaultColumns[] = 'birth_date';
			$this->defaultColumns[] = 'gender';
			$this->defaultColumns[] = 'religion';
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'address_phone';
			$this->defaultColumns[] = 'address_yogya';
			$this->defaultColumns[] = 'address_yogya_phone';
			$this->defaultColumns[] = 'parent_name';
			$this->defaultColumns[] = 'parent_work';
			$this->defaultColumns[] = 'parent_religion';
			$this->defaultColumns[] = 'parent_address';
			$this->defaultColumns[] = 'parent_phone';
			$this->defaultColumns[] = 'wali_name';
			$this->defaultColumns[] = 'wali_work';
			$this->defaultColumns[] = 'wali_religion';
			$this->defaultColumns[] = 'wali_address';
			$this->defaultColumns[] = 'wali_phone';
			$this->defaultColumns[] = 'school_id';
			$this->defaultColumns[] = 'school_un_rank';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'creation_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			/*
			$this->defaultColumns[] = array(
				'class' => 'CCheckBoxColumn',
				'name' => 'id',
				'selectableRows' => 2,
				'checkBoxHtmlOptions' => array('name' => 'trash_id[]')
			);
			*/
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = 'author_id';
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
			$this->defaultColumns[] = 'nisn';
			$this->defaultColumns[] = 'batch_id';
			$this->defaultColumns[] = 'register_name';
			$this->defaultColumns[] = 'birth_city';
			$this->defaultColumns[] = array(
				'name' => 'birth_date',
				'value' => 'Utility::dateFormat($data->birth_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'birth_date',
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'birth_date_filter',
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
			$this->defaultColumns[] = 'gender';
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'religion',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("religion",array("id"=>$data->register_id)), $data->religion, 1)',
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
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'address_phone';
			$this->defaultColumns[] = 'address_yogya';
			$this->defaultColumns[] = 'address_yogya_phone';
			$this->defaultColumns[] = 'parent_name';
			$this->defaultColumns[] = 'parent_work';
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'parent_religion',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("parent_religion",array("id"=>$data->register_id)), $data->parent_religion, 1)',
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
			$this->defaultColumns[] = 'parent_address';
			$this->defaultColumns[] = 'parent_phone';
			$this->defaultColumns[] = 'wali_name';
			$this->defaultColumns[] = 'wali_work';
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'wali_religion',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("wali_religion",array("id"=>$data->register_id)), $data->wali_religion, 1)',
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
			$this->defaultColumns[] = 'wali_address';
			$this->defaultColumns[] = 'wali_phone';
			$this->defaultColumns[] = 'school_id';
			$this->defaultColumns[] = 'school_un_rank';
			$this->defaultColumns[] = array(
				'name' => 'creation_search',
				'value' => '$data->creation_id != 0 ? $data->creation->displayname : "-"',
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
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {			
			$this->creation_id = Yii::app()->user->id;
		}
		return true;
	}

}