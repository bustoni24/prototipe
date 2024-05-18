<?php

class FrontController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public function init() {
		if (isset(Yii::app()->user->id))
			$this->login_user = User::model()->findByAttributes(['id' => Yii::app()->user->id]);
	}
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function actionIndex()
	{

		if (isset($this->login_user->username)){         	
				$this->redirect(Constant::baseUrl()."/home/index");
		} else{
			$this->redirect(Constant::baseLoginAdmin());
		}
		
		$this->render('index', [
			
		]);
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && ($_POST['ajax']==='register-form' || $_POST['ajax'] === 'register-checkpoint'))
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}