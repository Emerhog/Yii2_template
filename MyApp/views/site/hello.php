<?php 
$this->title = 'My Yii Application';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php

$form = ActiveForm::begin(['action' => ['site/save'],'options' => ['method' => 'post']]) ?>
    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'content') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Sand', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>