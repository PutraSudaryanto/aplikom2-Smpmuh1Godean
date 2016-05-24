<?php
/**
 * AdminController
 * @var $this AdminController
 * @var $model PsbRegisters
 * @var $form CActiveForm
 * version: 0.0.1
 * Reference start
 *
 * TOC :
 *	Index
 *	Manage
 *	Add
 *	Edit
 *	View
 *	RunAction
 *	Delete
 *	Publish
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 27 April 2016, 12:23 WIB
 * @link https://github.com/Ommu/Ommu-PSB
 * @contect (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class AdminController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index';

	/**
	 * Initialize admin page theme
	 */
	public function init() 
	{
		if(!Yii::app()->user->isGuest) {
			if(in_array(Yii::app()->user->level, array(1,2))) {
				$arrThemes = Utility::getCurrentTemplate('admin');
				Yii::app()->theme = $arrThemes['folder'];
				$this->layout = $arrThemes['layout'];
			} else {
				$this->redirect(Yii::app()->createUrl('site/login'));
			}
		} else {
			$this->redirect(Yii::app()->createUrl('site/login'));
		}
	}

	/**
	 * @return array action filters
	 */
	public function filters() 
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() 
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level)',
				//'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level != 1)',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('manage','add','edit','view','runaction','delete','publish'),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level) && in_array(Yii::app()->user->level, array(1,2))',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() 
	{
		$this->redirect(array('manage'));
	}

	/**
	 * Manages all models.
	 */
	public function actionManage() 
	{
		$model=new PsbRegisters('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PsbRegisters'])) {
			$model->attributes=$_GET['PsbRegisters'];
		}

		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		$this->pageTitle = Yii::t('phrase', 'Psb Registers Manage');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_manage',array(
			'model'=>$model,
			'columns' => $columns,
		));
	}	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd() 
	{
		if(isset($_GET['batch']))
			$batch = PsbYearBatch::model()->findByPk($_GET['batch']);
		else {
			$criteria=new CDbCriteria;
			$criteria->condition = 'curdate() BETWEEN `batch_start` AND `batch_finish`';
			$criteria->compare('publish',1);
			$batch = PsbYearBatch::model()->find($criteria);
		}
		
		$setting = PsbSettings::model()->findByPk(1,array(
			'select' => 'form_online, field_religion, field_wali',
		));
		
		$model=new PsbRegisters;
		$school=new PsbSchools;
		if($setting->form_online == 1)
			$author=new OmmuAuthors;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$this->performAjaxValidation($school);
		if($setting->form_online == 1)
			$this->performAjaxValidation($author);

		if(isset($_POST['PsbRegisters'])) {
			$model->attributes=$_POST['PsbRegisters'];
			$school->attributes=$_POST['PsbSchools'];
			$school->validate();
			
			if($setting->form_online == 1) {
				$author->attributes=$_POST['OmmuAuthors'];
				
				$authorFind = OmmuAuthors::model()->find(array(
					'select' => 'author_id, email',
					'condition' => 'publish = :publish AND email = :email',
					'params' => array(
						':publish' => 1,
						':email' => strtolower($author->email),
					),
				));
				if($authorFind != null)
					$model->author_id = $authorFind->author_id;
				else {
					if($author->save())
						$model->author_id = $author->author_id;
				}
			} else
				$model->author_id = 0;
			
			if($model->validate() && $school->validate()) {
				//if($model->school_id != '' && $model->school_id != 0) {
					$schoolFind = PsbSchools::model()->find(array(
						'select' => 'school_id, school_name',
						'condition' => 'school_name = :school',
						'params' => array(
							':school' => $school->school_name,
						),
					));
					if($schoolFind != null)
						$model->school_id = $schoolFind->school_id;
					else {
						if($school->save())
							$model->school_id = $school->school_id;
					}
					
				/*
				} else {
					$schoolFind = PsbSchools::model()->find(array(
						'select' => 'school_id, school_name',
						'condition' => 'school_name = :school',
						'params' => array(
							':school' => $school->school_name,
						),
					));
					if($schoolFind != null)
						$model->school_id = $schoolFind->school_id;
					else {
						if($school->save())
							$model->school_id = $school->school_id;
					}
				}
				*/
				
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('phrase', 'PsbRegisters success created.'));
					//$this->redirect(array('view','id'=>$model->register_id));
					if($model->back_field == 1)
						$this->redirect(array('manage'));
					else
						$this->redirect(array('add'));
				}
			}
		}

		$this->pageTitle = Yii::t('phrase', 'Create Psb Registers');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_add',array(
			'batch'=>$batch,
			'setting'=>$setting,
			'model'=>$model,
			'school'=>$school,
			'author'=>$setting->form_online == 1 ? $author : 0,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($id) 
	{
		$setting = PsbSettings::model()->findByPk(1,array(
			'select' => 'form_online, field_religion, field_wali',
		));
		
		$model=$this->loadModel($id);
		$batch = PsbYearBatch::model()->findByPk($model->batch_id);
		$school=PsbSchools::model()->findByPk($model->school_id);		
		if($setting->form_online == 1) {
			$author=OmmuAuthors::model()->findByPk($model->author_id);
			if($author == null)
				$author=new OmmuAuthors;
		}

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$this->performAjaxValidation($school);
		if($setting->form_online == 1)
			$this->performAjaxValidation($author);

		if(isset($_POST['PsbRegisters'])) {
			$model->attributes=$_POST['PsbRegisters'];
			$school->attributes=$_POST['PsbSchools'];
			$school->validate();
			
			if($setting->form_online == 1) {
				$author->attributes=$_POST['OmmuAuthors'];
				$author->save();
			}
			
			if($model->validate() && $school->validate()) {
				if($model->school_id_old != $model->school_id) {
					//if($model->school_id != '' && $model->school_id != 0) {
						$schoolFind = PsbSchools::model()->find(array(
							'select' => 'school_id, school_name',
							'condition' => 'school_name = :school',
							'params' => array(
								':school' => $school->school_name,
							),
						));
						if($schoolFind != null)
							$model->school_id = $schoolFind->school_id;
						else {
							$school=new PsbSchools;
							if($school->save())
								$model->school_id = $school->school_id;
						}
						
					/*
					} else {
						$schoolFind = PsbSchools::model()->find(array(
							'select' => 'school_id, school_name',
							'condition' => 'school_name = :school',
							'params' => array(
								':school' => $school->school_name,
							),
						));
						if($schoolFind != null)
							$model->school_id = $schoolFind->school_id;
						else {
							$school=new PsbSchools;
							if($school->save())
								$model->school_id = $school->school_id;
						}
					}
					*/
				}// else
				//	$school->save();
				
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('phrase', 'PsbRegisters success updated.'));
					//$this->redirect(array('view','id'=>$model->register_id));
					$this->redirect(array('manage'));
				}
			}
		}

		$this->pageTitle = Yii::t('phrase', 'Update Psb Registers');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_edit',array(
			'setting'=>$setting,
			'model'=>$model,
			'batch'=>$batch,
			'school'=>$school,
			'author'=>$setting->form_online == 1 ? $author : 0,
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) 
	{
		$model=$this->loadModel($id);

		$this->pageTitle = Yii::t('phrase', 'View Psb Registers');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_view',array(
			'model'=>$model,
		));
	}	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionRunAction() {
		$id       = $_POST['trash_id'];
		$criteria = null;
		$actions  = $_GET['action'];

		if(count($id) > 0) {
			$criteria = new CDbCriteria;
			$criteria->addInCondition('id', $id);

			if($actions == 'publish') {
				PsbRegisters::model()->updateAll(array(
					'publish' => 1,
				),$criteria);
			} elseif($actions == 'unpublish') {
				PsbRegisters::model()->updateAll(array(
					'publish' => 0,
				),$criteria);
			} elseif($actions == 'trash') {
				PsbRegisters::model()->updateAll(array(
					'publish' => 2,
				),$criteria);
			} elseif($actions == 'delete') {
				PsbRegisters::model()->deleteAll($criteria);
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manage'));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) 
	{
		$model=$this->loadModel($id);
		
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				if($model->delete()) {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-psb-registers',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'PsbRegisters success deleted.').'</strong></div>',
					));
				}
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = Yii::t('phrase', 'PsbRegisters Delete.');
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_delete');
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPublish($id) 
	{
		$model=$this->loadModel($id);
		
		if($model->publish == 1) {
		//if($model->actived == 1) {
		//if($model->enabled == 1) {
		//if($model->status == 1) {
			$title = Yii::t('phrase', 'Unpublish');
			//$title = Yii::t('phrase', 'Deactived');
			//$title = Yii::t('phrase', 'Disabled');
			//$title = Yii::t('phrase', 'Unresolved');
			$replace = 0;
		} else {
			$title = Yii::t('phrase', 'Publish');
			//$title = Yii::t('phrase', 'Actived');
			//$title = Yii::t('phrase', 'Enabled');
			//$title = Yii::t('phrase', 'Resolved');
			$replace = 1;
		}

		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				//change value active or publish
				$model->publish = $replace;
				//$model->actived = $replace;
				//$model->enabled = $replace;
				//$model->status = $replace;

				if($model->update()) {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-psb-registers',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'PsbRegisters success updated.').'</strong></div>',
					));
				}
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = $title;
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_publish',array(
				'title'=>$title,
				'model'=>$model,
			));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) 
	{
		$model = PsbRegisters::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) 
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='psb-registers-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
