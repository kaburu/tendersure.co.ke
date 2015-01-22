<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface {

    public $id;
    public $uuid;
    public $roleid;
    public $email;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    private static $users = [
//        '100' => [
//            'id' => '100',
//            'username' => 'admin',
////            'password' => 'admin',
//            'authKey' => 'test100key',
//            'accessToken' => '100-token',
//        ],
//        '101' => [
//            'id' => '101',
//            'username' => 'demo',
//            'password' => 'demo',
//            'authKey' => 'test101key',
//            'accessToken' => '101-token',
//        ],
    ];

    /**
     * @inheritdoc
     */
//    public static function findIdentity($id)
//    {
//        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
//    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        $dbUser = Account::find()
                ->where([
                    "uuid" => $id
                ])
                ->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = Account::find()
                ->where([
                    "username" => $username
                ])
                ->one();

//        $this->id = $user->uuid;

        if (!count($user)) {
            return null;
        }
        return new static($user);

//        if ($user === null) {
//            $this->errorCode = self::ERROR_USERNAME_INVALID;
//        } else if ($user->password !== $this->password) {
//            $this->errorCode = self::ERROR_PASSWORD_INVALID;
//        } else {
////            $this->id = $user->uuid;
//            $this->username = $user->username;
//            $this->errorCode = self::ERROR_NONE;
//        }
//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }

//        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->uuid;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

    public function isAdmin() {
        $user = Account::find()
                ->where([
                    "uuid" => \Yii::$app->user->getId()
                ])
                ->one();


        $res = false;
        if ($user !== null && $user->roleid == 5) {
            $res = true;
        }
        //d2l($res,"rWebUser.isAdmin");
        return $res;
    }

    public function isBidder() {
        $user = Account::find()
                ->where([
                    "uuid" => $this->getId()
                ])
                ->one();
        $res = false;
        if ($user !== null && $user->roleid == 1) {
            $res = true;
        }
        //d2l($res,"rWebUser.isAdmin");
        return $res;
    }

}
