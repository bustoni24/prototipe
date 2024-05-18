<?php

class ApiController extends Controller
{
	public function init() {
        ob_end_clean();
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS');
        header("Access-Control-Allow-Headers: Content-Type");

		function doPrintResult($result = [])
		{
			echo json_encode($result);
			Yii::app()->end();
		}
	}

	public function actionIndex()
	{
		$this->render('index');
	}
}