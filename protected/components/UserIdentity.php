<?php

date_default_timezone_set("Asia/Jakarta");

class UserIdentity extends CUserIdentity {
    private $_id; //set id untuk unique identifier
    public $role;
    public $arPermission = array('');	

    public function authenticate() {
        $user = $this->username;
        $pass = $this->password;
        $pass = Helper::getInstance()->hashPassword($pass);
        
        $login = User::model()->find('username=:username AND password=:password AND active=1', array(':username' => $user, ':password' => $pass));

        if ($login != null) {
            $this->_id = $login->id;
            $this->setState('username', $user);
            $this->setState('role', $login->level);
            $this->setState('name', $login->name);

            $this->errorCode = self::ERROR_NONE;

            return !$this->errorCode;
        } else {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return !$this->errorCode;
        }
    }

    public function getId() {
        return $this->_id;
    }

}
