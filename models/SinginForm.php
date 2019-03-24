<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 23.03.2019
 * Time: 21:03
 */


namespace app\models;

use yii\base\Model;

class SinginForm extends Model
{
    public $login;
    public $password;
    public $repassword;

    public function rules()
    {
        return [
            // username and password are both required
            [['login'], 'required', 'message' => 'Введите логин'],
            [['password'], 'required', 'message' => 'Введите пароль'],
            [['repassword'], 'required', 'message' => 'Введите повторнй пароль'],
            [['login'], 'validateUsername'],
            [['repassword'], 'validatePassword'],
        ];
    }

    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = Users::find()->where([ "login" => $this->login ])->one();

            if ($user) {
                $this->addError($attribute, 'Такой пользователь есть.');
            }
        }
    }
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password != $this->repassword) {
                $this->addError($attribute, 'Пароли не соответствуют.');
            }
        }
    }
}