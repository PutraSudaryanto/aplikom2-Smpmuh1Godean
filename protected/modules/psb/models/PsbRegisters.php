<?php
/**
 * PsbRegisters
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 27 April 2016, 12:05 WIB
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
 * This is the model class for table "ommu_psb_registers".
 *
 * The followings are the available columns in table 'ommu_psb_registers':
 * @property string $register_id
 * @property string $author_id
 * @property integer $status
 * @property string $register_number
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
 * @property string $school_un_detail
 * @property string $bundle_date
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
	public $batch_field;
	public $birthcity_field;
	public $school_id_old;
	public $school_name_old;
	public $school_un_average;
	public $back_field;
	
	// Variable Search
	public $year_search;
	public $batch_search;
	public $birth_city_search;
	public $school_search;
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
			array('register_number, nisn, batch_id, register_name, birth_date, gender, address, parent_name, parent_work, parent_address, parent_phone, bundle_date,
				birthcity_field', 'required'),
			array('status, religion, parent_religion, wali_religion,
				batch_field, back_field', 'numerical', 'integerOnly'=>true),
			array('author_id, batch_id, birth_city, school_id, creation_id', 'length', 'max'=>11),
			array('nisn', 'length', 'max'=>12),
			array('register_number, register_name, parent_name, parent_work, wali_name, wali_work', 'length', 'max'=>32),
			array('gender', 'length', 'max'=>6),
			array('address_phone, address_yogya_phone, parent_phone, wali_phone', 'length', 'max'=>15),
			array('author_id, birth_city, religion, address_phone, address_yogya, address_yogya_phone, parent_religion, wali_name, wali_work, wali_religion, wali_address, wali_phone, school_id, school_un_rank, school_un_detail,
				batch_field, school_id_old, school_name_old', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('register_id, author_id, status, register_number, nisn, batch_id, register_name, birth_city, birth_date, gender, religion, address, address_phone, address_yogya, address_yogya_phone, parent_name, parent_work, parent_religion, parent_address, parent_phone, wali_name, wali_work, wali_religion, wali_address, wali_phone, school_id, school_un_rank, school_un_detail, bundle_date, creation_date, creation_id,
				year_search, batch_search, birth_city_search, school_search, school_un_average, creation_search', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'OmmuAuthors', 'author_id'),
			'batch_relation' => array(self::BELONGS_TO, 'PsbYearBatch', 'batch_id'),
			'city_relation' => array(self::BELONGS_TO, 'OmmuZoneCity', 'birth_city'),
			'religion_relation' => array(self::BELONGS_TO, 'PsbReligions', 'religion'),
			'parent_religion_relation' => array(self::BELONGS_TO, 'PsbReligions', 'parent_religion'),
			'wali_religion_relation' => array(self::BELONGS_TO, 'PsbReligions', 'wali_religion'),
			'school' => array(self::BELONGS_TO, 'PsbSchools', 'school_id'),
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
			'register_number' => Yii::t('attribute', 'Register Number'),
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
			'school_un_detail' => Yii::t('attribute', 'School Un Detail'),
			'bundle_date' => Yii::t('attribute', 'Bundle Date'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'creation_search' => Yii::t('attribute', 'Creation'),
			'birth_city_search' => Yii::t('attribute', 'Birth City'),
			'school_search' => Yii::t('attribute', 'School'),
			'batch_field' => Yii::t('attribute', 'Batch Detected'),
			'birthcity_field' => Yii::t('attribute', 'Birth City'),
			'year_search' => Yii::t('attribute', 'Year'),
			'batch_search' => Yii::t('attribute', 'Batch'),
			'back_field' => Yii::t('attribute', 'Back to Manage'),
			'school_un_average' => Yii::t('attribute', 'School Un Average'),
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
			'Back to Manage' => 'Back to Manage',
		
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
		$criteria->compare('t.register_number',$this->status);
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
		$criteria->compare('t.school_un_detail',strtolower($this->school_un_detail),true);
		if($this->bundle_date != null && !in_array($this->bundle_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.bundle_date)',date('Y-m-d', strtotime($this->bundle_date)));
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		if(isset($_GET['creation']))
			$criteria->compare('t.creation_id',$_GET['creation']);
		else
			$criteria->compare('t.creation_id',$this->creation_id);
		$criteria->compare('t.school_un_average',$this->school_un_average,true);
		
		// Custom Search
		$criteria->with = array(
			'batch_relation' => array(
				'alias'=>'batch_relation',
				'select'=>'year_id, batch_name'
			),
			'city_relation' => array(
				'alias'=>'city_relation',
				'select'=>'city'
			),
			'school' => array(
				'alias'=>'school',
				'select'=>'school_name'
			),
			'creation' => array(
				'alias'=>'creation',
				'select'=>'displayname'
			),
		);
		if(isset($_GET['year']))
			$criteria->compare('batch_relation.year_id',$_GET['year']);
		else
			$criteria->compare('batch_relation.year_id',$this->year_search);
		$criteria->compare('batch_relation.batch_name',strtolower($this->batch_search), true);
		$criteria->compare('city_relation.city',strtolower($this->birth_city_search), true);
		$criteria->compare('school.school_name',strtolower($this->school_search), true);
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
			$this->defaultColumns[] = 'register_number';
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
			$this->defaultColumns[] = 'school_un_detail';
			$this->defaultColumns[] = 'bundle_date';
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
			if(!isset($_GET['year'])) {
				$this->defaultColumns[] = array(
					'name' => 'year_search',
					'value' => '$data->batch_relation->year->years',
					'filter'=> PsbYears::getYear(),
					'type' => 'raw',
				);				
			}
			$this->defaultColumns[] = array(
				'name' => 'batch_search',
				'value' => '$data->batch_relation->batch_name',
			);
			$this->defaultColumns[] = 'register_name';
			//$this->defaultColumns[] = 'nisn';
			$this->defaultColumns[] = array(
				'name' => 'birth_city_search',
				'value' => '$data->city_relation->city',
			);
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
			$this->defaultColumns[] = array(
				'name' => 'gender',
				'value' => '$data->gender == "male" ? Yii::t("phrase", "Laki-laki") : Yii::t("phrase", "Perempuan")',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					'male'=>Yii::t('phrase', 'Laki-laki'),
					'female'=>Yii::t('phrase', 'Perempuan'),
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = 'parent_name';
			$this->defaultColumns[] = array(
				'name' => 'school_search',
				'value' => '$data->school->school_name',
			);
			$this->defaultColumns[] = array(
				'header' => 'school_un_average',
				'value' => '$data->school_un_average',
				'htmlOptions' => array(
					'class' => 'center',
				),
			);
			/*
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
			*/
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
	 * get Detail
	 */
	public static function getDetailCourse($data)
	{
		$countData = count($data);
		$i = 0;
		foreach($data as $key => $val) {
			$i++;
			if($i != $countData)
				$return .= PsbCourses::getValue($key, $val).'<br/>';
			else
				$return .= PsbCourses::getValue($key, $val);					
		}
		
		return $return;
	}

	/**
	 * get Detail
	 */
	public static function getUNDetail($data, $valuation=1)
	{
		$data = unserialize($data);
		$countData = count($data);
			
		if($valuation == 1 || $countData == 1)
			$return = self::getDetailCourse($data[0]);
		
		else {
			$i = 0;
			foreach($data as $key => $val) {
				$i++;
				if($i != $countData)
					$return .= self::getDetailCourse($data[$key]).'<hr/>';
				else
					$return .= self::getDetailCourse($data[$key]);
			}
		}
		
		return $return;
	}

	/**
	 * User get information
	 */
	public static function getUNRank($data)
	{
		$return = '';
		$count = count($data);
		for($i = 0; $i<$count; $i++) {
			foreach($data[$i] as $key => $val)
				$return[$key] = $return[$key] + $val;
		}
		
		foreach($return as $key => $val)
			$return[$key] = number_format($val/$count, 2);
		
		return $return;
	}

	/**
	 * User get information
	 */
	public static function getUNAverage($data)
	{
		$data = unserialize($data);
		$count = count($data);
		$total = 0;
		foreach($data as $key => $val)
			$total = $total + $val;
		$return = $total/$count;
		
		return $return;
	}
	
	protected function afterFind() {
		$this->school_un_average = $this->school_un_rank != '' ? number_format(self::getUNAverage($this->school_un_rank), 2) : 0;
		parent::afterFind();		
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
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {	
			$this->birth_date = date('Y-m-d', strtotime($this->birth_date));
			$this->school_un_rank = serialize(self::getUNRank($this->school_un_detail));
			$this->school_un_detail = serialize($this->school_un_detail);
			$this->bundle_date = date('Y-m-d', strtotime($this->bundle_date));
		}
		return true;
	}

}