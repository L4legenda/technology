<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 24.03.2019
 * Time: 11:17
 */
?>

<h1>Добавление статиь</h1>
<?php $form = \yii\widgets\ActiveForm::begin() ?>
<?= $form->field($model,"title")->input("text")->label("Заголовок") ?>
<?= $form->field($model,"anons")->textarea()->label("Анонс") ?>
<?= $form->field($model,"text")->textarea()->label("Текст") ?>
<?= $form->field($model,"status")->dropDownList(["Опубликовано", "Черновик"])->label("Статус") ?>
<?= \yii\helpers\Html::submitButton("Опубликовать",["class" => "btn btn-success"]) ?>
<?php \yii\widgets\ActiveForm::end() ?>
