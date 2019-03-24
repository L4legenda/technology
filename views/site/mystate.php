<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 24.03.2019
 * Time: 11:46
 */
?>
<div class="site-mypost">
    <div class="page-container">
    </div>
    <?php foreach ($state as $s): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= \yii\helpers\BaseHtml::a($s->title, "site/state/".$s->id) ?>
                <span class="badge"><?= \app\models\Users::findOne($s->author)->login ?></span>
                <span class="badge"><?= $s->date ?></span>

                <?php if($s->status == 1): ?>
                <span class="badge">Черновик</span>
                <?php elseif($s->status == 2): ?>
                    <span class="badge">Удалено</span>
                <?php endif; ?>
                <?= \yii\helpers\Html::a("Редактировать", "/site/editstate/".$s->id, ["class" => "btn btn-warning pos-r3"]) ?>
                <?php \yii\widgets\ActiveForm::begin() ?>
                <?php if($s->status == 1): ?>
                    <?= \yii\helpers\Html::submitButton("Опубликовать", ["class" => "btn btn-primary pos-r2", "name" => "publicState", "value" => $s->id]) ?>
                <?php elseif($s->status == 0): ?>
                    <?= \yii\helpers\Html::submitButton("Черновик", ["class" => "btn btn-primary pos-r2", "name" => "draftState", "value" => $s->id]) ?>
                <?php endif; ?>
                <?php if($s->status != 2): ?>
                    <?= \yii\helpers\Html::submitButton("Удалить", ["class" => "btn btn-danger pos-r", "name" => "deleteState", "value" => $s->id]) ?>
                <?php else : ?>
                    <?= \yii\helpers\Html::submitButton("Востановить", ["class" => "btn btn-success pos-r", "name" => "restoreState", "value" => $s->id]) ?>
                <?php endif; ?>
                <?php \yii\widgets\ActiveForm::end() ?>

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
