<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 22.03.2019
 * Time: 21:04
 */
$this->title = $state->title;
?>
<h1><?= $state->title ?></h1>
<p><?= $state->text ?></p>
<h3>Добавить коментарий</h3>

<?php $form = \yii\widgets\ActiveForm::begin() ?>
    <?= $form->field($model, "name")->label("Имя") ?>
    <?= $form->field($model, "text")->textarea()->label("Текст") ?>
    <?= \yii\helpers\Html::submitButton("Добавить",["class" => "btn btn-success"]) ?>
<?php \yii\widgets\ActiveForm::end() ?>

<h3>Коментарии</h3>
<?php foreach ($comments as $com): ?>
<div class="panel panel-default">
    <div class="panel-heading"><?= $com->name ?></div>
    <div class="panel-body">
        <?= $com->text ?>
    </div>
</div>
<?php endforeach; ?>