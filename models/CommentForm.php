<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 24.03.2019
 * Time: 12:52
 */

namespace app\models;


use yii\base\Model;

class CommentForm extends Model
{
    public $name;
    public $text;

    public function rules()
    {
        return [
            ['name', 'required','message' => "Введите имя"],
            ['text', 'required', "message" => "Введите текст"],
        ];
    }
}