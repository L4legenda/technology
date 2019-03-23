<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $privilege
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'privilege'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'privilege' => 'Privilege',
        ];
    }

    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){

    }
    public function getId(){
        return $this->id;
    }
    public function getAuthKey(){

    }
    public function validateAuthKey($authKey){

    }
    public static function findByUsername($username)
    {
        if($u = self::find()->where(["login"=>$username])->one()){
            return $u;
        }

        return null;
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
