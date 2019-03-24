<?php

/* @var $this yii\web\View */

$this->title = 'Статьи';
?>
<div class="site-index">
        <div class="page-container">
            Соритровка по
            <?php $form = \yii\widgets\ActiveForm::begin() ?>
            <?= \yii\helpers\Html::buttonInput("Дата", ["class" => "btn btn-info"]) ?>
            <?= \yii\helpers\Html::buttonInput("Автор", ["class" => "btn btn-info"]) ?>
            <?php \yii\widgets\ActiveForm::end() ?>
        </div>
        <?php foreach ($state as $s): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= \yii\helpers\BaseHtml::a($s->title, "site/state/".$s->id) ?>
                    <span class="badge"><?= \app\models\Users::findOne($s->author)->login ?></span>
                </div>
                <div class="panel-body">
                    <?= $s->anons ?>
                </div>
            </div>
        <?php endforeach; ?>
        <?= \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
</div>
