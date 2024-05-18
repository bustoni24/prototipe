<?php
Yii::import('ext.auth.VAuth');
Yii::import('ext.file.VUpload');
class SiteController extends Controller
{
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	/*public function init() {
		$login_user = User::model()->findByPk(Yii::app()->user->id);
		if (isset($login_user->username)){         	
			$this->redirect(array('home/index'));
		}
	}*/

	public function actionIndex()
	{
		header("Location: ".Yii::app()->request->baseUrl."/login");
		die();
		
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		Yii::app()->theme = 'adminlte';
		$this->layout = '//layouts/column_error';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest){
				echo $error['message'];
			}
			 $this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->login_user =  User::model()->findByPk(Yii::app()->user->id);
		if (!isset($this->login_user))
			$this->login_user = Sdm::model()->findByPk(Yii::app()->user->id);
		if (isset($this->login_user->username)){         	
			$this->redirect(array('home/index'));
		}
  		$model=new LoginForm;
  
  		// if it is ajax validation request
  		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
  		{
  			echo CActiveForm::validate($model);
  			Yii::app()->end();
  		}
  
  		// collect user input data
  		if(isset($_POST['LoginForm']))
  		{
			$username = $_POST['LoginForm']['username'];
  			$model->attributes=$_POST['LoginForm'];
  			if($model->validate() && $model->login()) {
				$this->redirect(Constant::baseUrl()."/");
			  }
  		}

  		// display the login form
  		$this->render('loginAccount',array(
			  'model'=>$model
			));	
	}

	public function actionLoginAdmin() {
		$this->login_user = User::model()->findByAttributes(['id' => Yii::app()->user->id]);
		if (isset($this->login_user->username)){         	
			$this->redirect(array('home/index'));
		}
		$this->layout = 'login';

		/* $text = Helper::getInstance()->hashPassword('54321');
		Helper::getInstance()->dump($text); */
		
  		$model=new LoginForm;
  		// if it is ajax validation request
  		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
  		{
  			echo CActiveForm::validate($model);
  			Yii::app()->end();
  		}
  
  		// collect user input data
  		if(isset($_POST['LoginForm']))
  		{
  			$model->attributes=$_POST['LoginForm'];
  			if($model->validate() && $model->login()) {
				$this->redirect(Constant::baseUrl()."/");
			  }
  		}

  		// display the login form
  		$this->render('loginAdmin',array('model'=>$model));	
	}

	public function actionRegister()
	{
		$this->login_user =  User::model()->findByAttributes(['id' => Yii::app()->user->id]);
		if (isset($this->login_user->username)){         	
			$this->redirect(Constant::baseUrl()."/home/index");
		}
		
		$this->layout = 'login';
		
		$post = [];
		$model=new User;
		$model->scenario = 'register';
		$this->performAjaxValidation($model);
		if(isset($_POST['User']))
		{
			$post = $_POST;
			$model->attributes=$post['User'];
			$model->level_akses = 3; //customer
			$model->created_date = date("Y-m-d H:i:s");
			$model->password_temp = $post['User']['password'];
			$model->password = md5($model->password_temp);
			$model->alamat = "-";
			$model->no_hp = "-";
			$model->active = 1;

			$error = "";
			$transaction = Yii::app()->db->beginTransaction();
            try { 
				if (!isset($post['User']['passconf']) || empty($post['User']['passconf']))
					throw new Exception("Password tidak cocok, mohon ulangi kembai");
				if (!$model->save())
                	throw new Exception(json_encode($model->getErrors()));
				if ($post['User']['passconf'] != $post['User']['password'])
					throw new Exception("Password tidak cocok, mohon ulangi kembai");

					$transaction->commit();
				} catch (Exception $e) {
					$error = $e->getMessage();
					$transaction->rollBack();
				}  

				if (!empty($error)){
					// Helper::getInstance()->dump($error);
					$post['error_message'] = $error;
				} else {
					$this->redirect(Constant::baseUrl() . '/login');
				}
			/* if (empty($error)){
				//send email
				SendEmail::getInstance()->sendRegisterPetugas(['model_user' => $model]);
				$this->redirect('./front/verifikasiEmail?id='.$this->encode($model->id.'|petugas'));
			} */
		}

		$this->render('registerAccount', [
			'model' => $model,
			'post' => $post
		]);
	}

	public function actionSuccessRegister()
	{
		$this->layout = '//layouts/column_landing';
		$name = "";
		if (isset(Yii::app()->session['userRegister'])){
			$name = Yii::app()->session['userRegister'];

			unset(Yii::app()->session['userRegister']);
		}
		$this->render('successRegister', ['name' => $name]);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{

		if (isset(Yii::app()->session)){
			Yii::app()->session->clear();
            Yii::app()->session->destroy();
		}
		Yii::app()->user->logout();
		
		$this->redirect(Constant::baseUrl().'/');
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && ($_POST['ajax']==='login-form' || $_POST['ajax']==='register'))
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
