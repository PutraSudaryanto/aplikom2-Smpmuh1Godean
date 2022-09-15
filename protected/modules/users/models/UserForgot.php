<?php
/**
 * UserForgot
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Users
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
 * This is the model class for table "ommu_user_forgot".
 *
 * The followings are the available columns in table 'ommu_user_forgot':
 * @property string $forgot_id
 * @property string $user_id
 * @property string $code
 * @property string $forgot_date
 * @property string $forgot_ip
 *
 * The followings are the available model relations:
 * @property OmmuUsers $user
 */
class UserForgot extends CActiveRecord
{
	public $defaultColumns = array();
	public $email;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserForgot the static model class
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
		return 'ommu_user_forgot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code', 'required'),
			array('email', 'required', 'on'=>'get'),
			array('user_id', 'length', 'max'=>11),
			array('
				email', 'length', 'max'=>32),
			array('code', 'length', 'max'=>64),
			array('forgot_ip', 'length', 'max'=>20),
			array('email', 'email'),
			array('user_id, forgot_date, forgot_ip,
				email', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('forgot_id, user_id, code, forgot_date, forgot_ip', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'forgot_id' => Yii::t('attribute', 'Forgot'),
			'user_id' => Yii::t('attribute', 'User'),
			'code' => Yii::t('attribute', 'Forgot Code'),
			'forgot_date' => Yii::t('attribute', 'Forgot Date'),
			'forgot_ip' => Yii::t('attribute', 'Forgot Ip'),
			'email' => Yii::t('attribute', 'Email'),
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

		$criteria->compare('t.forgot_id',$this->forgot_id);
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->compare('t.code',$this->code,true);
		if($this->forgot_date != null && !in_array($this->forgot_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.forgot_date)',date('Y-m-d', strtotime($this->forgot_date)));
		$criteria->compare('t.forgot_ip',$this->forgot_ip,true);

		if(!isset($_GET['UserForgot_sort']))
			$criteria->order = 't.forgot_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
			//$this->defaultColumns[] = 'forgot_id';
			$this->defaultColumns[] = 'user_id';
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = 'forgot_date';
			$this->defaultColumns[] = 'forgot_ip';
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
			$this->defaultColumns[] = 'user_id';
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = array(
				'name' => 'forgot_date',
				'value' => 'Utility::dateFormat($data->forgot_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this, 
					'attribute'=>'forgot_date', 
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'forgot_date_filter',
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
			$this->defaultColumns[] = 'forgot_ip';
		}
		parent::afterConstruct();
	}

	/**
	 * User forgot password codes
	 */
	public static function getUniqueCode() {
		$chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		$i = 0;
		$code = '' ;

		while ($i <= 31) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 2);
			$code = $code . $tmp; 
			$i++;
		}

		return $code;
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
		if(parent::beforeValidate()) {		
			if($this->isNewRecord) {
				if($currentAction == 'password/forgot' && $this->email != '') {
					$user = Users::model()->findByAttributes(array('email' => $this->email), array(
						'select' => 'user_id, email',
					));
					if($user == null) {
						$this->addError('email', 'Incorrect email address');
					} else {
						$this->user_id = $user->user_id;
					}
				}
				$this->code = self::getUniqueCode();
				$this->forgot_ip = $_SERVER['REMOTE_ADDR'];
			}
		}
		return true;
	}
	
	/**
	 * After save attributes
	 */
	protected function afterSave() {			
		parent::afterSave();
		
		$setting = OmmuSettings::model()->findByPk(1, array(
			'select' => 'site_title',
		));
		
		if($this->isNewRecord) {
			// Send Email to Member
			$forgot_search = array(
				'{$baseURL}', '{$displayname}', '{$site_support_email}',
				'{$forgot_link}',
			);
			$forgot_replace = array(
				Utility::getProtocol().'://'.Yii::app()->request->serverName.Yii::app()->request->baseUrl, $this->user->displayname, SupportMailSetting::getInfo(1, 'mail_contact'),
				Utility::getProtocol().'://'.Yii::app()->request->serverName.Yii::app()->createUrl('users/password/verify',array('key'=>$this->code, 'secret'=>$this->user->salt)),
			);
			$forgot_template = 'user_forgot_password';
			$forgot_title = $setting->site_title.' Password Assistance';
			$forgot_message = file_get_contents(YiiBase::getPathOfAlias('webroot.externals.users.template').'/'.$forgot_template.'.php');
			$forgot_ireplace = str_ireplace($forgot_search, $forgot_replace, $forgot_message);
			SupportMailSetting::sendEmail($this->user->email, $this->user->displayname, $forgot_title, $forgot_ireplace);
		}
	}

	/**
	 * After delete attributes
	 */
	protected function afterDelete() {
		parent::afterDelete();

		// Delete all history
		self::model()->deleteAll(array(
			'condition'=> 'user_id = :id',
			'params'=>array(
				':id'=>$this->user_id,
			),
		));
	}

}