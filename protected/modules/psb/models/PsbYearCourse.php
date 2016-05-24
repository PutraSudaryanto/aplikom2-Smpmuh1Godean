<?php
/**
 * PsbYearCourse
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
 * This is the model class for table "ommu_psb_year_course".
 *
 * The followings are the available columns in table 'ommu_psb_year_course':
 * @property string $id
 * @property string $year_id
 * @property string $course_id
 * @property string $creation_date
 * @property string $creation_id
 *
 * The followings are the available model relations:
 * @property OmmuPsbYears $year
 * @property OmmuPsbCourses $course
 */
class PsbYearCourse extends CActiveRecord
{
	public $defaultColumns = array();
	public $body;
	
	// Variable Search
	public $year_search;
	public $course_search;
	public $creation_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PsbYearCourse the static model class
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
		return 'ommu_psb_year_course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year_id, course_id', 'required'),
			array('year_id, course_id, creation_id', 'length', 'max'=>11),
			array('
				body', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, year_id, course_id, creation_date, creation_id,
				year_search, course_search, creation_search', 'safe', 'on'=>'search'),
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
			'course' => array(self::BELONGS_TO, 'PsbCourses', 'course_id'),
			'creation_relation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'year_id' => 'Year',
			'course_id' => 'Course',
			'creation_date' => 'Creation Date',
			'creation_id' => 'Creation',
			'body' => 'Course Name',
			'year_search' => 'Year',
			'course_search' => 'Course',
			'creation_search' => 'Creation',
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

		$criteria->compare('t.id',$this->id,true);
		if(isset($_GET['year'])) {
			$criteria->compare('t.year_id',$_GET['year']);
		} else {
			$criteria->compare('t.year_id',$this->year_id);
		}
		if(isset($_GET['course'])) {
			$criteria->compare('t.course_id',$_GET['course']);
		} else {
			$criteria->compare('t.course_id',$this->course_id);
		}
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		$criteria->compare('t.creation_id',$this->creation_id,true);
		
		// Custom Search
		$criteria->with = array(
			'year_relation' => array(
				'alias'=>'year_relation',
				'select'=>'years'
			),
			'course' => array(
				'alias'=>'course',
				'select'=>'course_name'
			),
			'creation_relation' => array(
				'alias'=>'creation_relation',
				'select'=>'displayname'
			),
		);
		$criteria->compare('year_relation.years',strtolower($this->year_search), true);
		$criteria->compare('course.course_name',strtolower($this->course_search), true);
		$criteria->compare('creation_relation.displayname',strtolower($this->creation_search), true);

		if(!isset($_GET['PsbYearCourse_sort']))
			$criteria->order = 'id DESC';

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
			//$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'year_id';
			$this->defaultColumns[] = 'course_id';
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
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'name' => 'year_search',
				'value' => '$data->year_relation->years',
			);
			$this->defaultColumns[] = array(
				'name' => 'course_search',
				'value' => '$data->course->course_name',
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
			if($this->isNewRecord) {
				$this->creation_id = Yii::app()->user->id;	
			}
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				if($this->course_id == 0) {
					$course = PsbCourses::model()->find(array(
						'select' => 'course_id, course_name',
						'condition' => 'course_name = :course_name',
						'params' => array(
							':course_name' => strtolower($this->body),
						),
					));
					if($course != null) {
						$this->course_id = $course->course_id;
					} else {
						$data = new PsbCourses;
						$data->course_name = $this->body;
						if($data->save()) {
							$this->course_id = $data->course_id;
						}
					}					
				}
			}
		}
		return true;
	}

}