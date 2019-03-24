<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 24.03.2019
 * Time: 10:29
 */
?>
<h1>Регистрация</h1>
<?php $form = \yii\widgets\ActiveForm::begin() ?>
<?= $form->field($model, "login")->label("Логин") ?>
<?= $form->field($model, "password")->passwordInput()->label("Пароль") ?>
<?= $form->field($model, "repassword")->passwordInput()->label("Повторный пароль") ?>
<?= \yii\helpers\Html::submitButton("Регистрация", ["class" => "btn btn-success"]) ?>
<?php \yii\widgets\ActiveForm::end() ?>
