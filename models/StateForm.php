<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 24.03.2019
 * Time: 11:18
 */

namespace app\models;


use yii\base\Model;

class StateForm extends Model
{
    public $title;
    public $anons;
    public $text;
    public $status;

    public function rules()
    {
        return [
            ['title', 'required', "message" => 'Введите заголовок'],
            [['anons'], 'required', "message" => "Введите анонс"],
            ['text', 'required', "message" => "Введите текст"],
            ['status', 'required'],
        ];
    }
}