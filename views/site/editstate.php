<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 24.03.2019
 * Time: 12:31
 */
?>
<h1>Редактирование статьи</h1>
<?php $form = \yii\widgets\ActiveForm::begin() ?>
<?= $form->field($model,"title")->input("text",["value"=>$state->title])->label("Заголовок") ?>
<?= $form->field($model,"anons")->textarea(["value"=>$state->anons])->label("Анонс") ?>
<?= $form->field($model,"text")->textarea(["value"=>$state->text])->label("Текст") ?>
<?= $form->field($model,"status")->dropDownList(["Опубликовано", "Черновик"],["value"=>$state->status])->label("Статус") ?>
<?= \yii\helpers\Html::submitButton("Редактировать",["class" => "btn btn-success"]) ?>
<?php \yii\widgets\ActiveForm::end() ?>
