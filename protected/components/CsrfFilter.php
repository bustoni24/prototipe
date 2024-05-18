<?php

class CsrfFilter extends CFilter
{
    protected function preFilter($filterChain)
    {
        // Lakukan validasi token di sini untuk POST atau GET
        // $request = Yii::app()->getRequest();
        /* $isPostRequest = $request->getIsPostRequest();
        $isGetRequest = $request->getRequestType(); */

        $headers = self::getHeaders();
        if (SERVER_TYPE == 'STG') {
            $tokenExists = "";
        } else {
            $keyRedis = 'token_partner_' . (isset($headers['AUTHORIZATION']) ? str_replace('Bearer ', '', $headers['AUTHORIZATION']) : (isset($headers['AUTH']) ? str_replace('Bearer ', '', $headers['AUTH']) : '???'));
            $accessToken = RedisHelper::getInstance()->get($keyRedis);
            if (isset($accessToken['access_token'])) {
                $accessToken['access_token'];
            }
    
            $tokenExists = isset($accessToken['access_token']) ? 'Bearer ' . $accessToken['access_token'] : Yii::app()->request->csrfTokenName;
        }

        $token = isset($headers['AUTHORIZATION']) ? $headers['AUTHORIZATION'] : (isset($headers['AUTH']) ? $headers['AUTH'] : '???');
        if ($token === null || $token !== $tokenExists) {
            throw new CHttpException(403, 'Unauthorized');
        }

        return true;
    }

    protected function postFilter($filterChain)
    {
        // Kosongkan, karena ini adalah preFilter
    }

    private function getHeaders()
	{
		$headers = array();
		foreach ($_SERVER as $key => $value) {
			if (strpos($key, 'HTTP_') === 0) {
				$headers[str_replace(' ', '', str_replace('_', '-', substr($key, 5)))] = $value;
			}
		}

		return $headers;
	}
}
