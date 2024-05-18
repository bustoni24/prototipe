<?php
class HomeController extends Controller
{
	public $layout='//layouts/column2';

	public function init() {
		$this->login_user = User::model()->findByAttributes(['id' => Yii::app()->user->id]);
		if (isset($this->login_user->username) || isset($this->login_user->email)){
			
		} else {
			$this->redirect(Constant::baseUrlFront());
		}
	}

    public function filters() {
        return array(
            //'accessControl', // perform access control for CRUD operations
                //	'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function actionIndex()
	{
		$this->render('index', []);		
	}
}