<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\District */
/* @var $region array */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="district-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region_id')->dropDownList($region)->label(Yii::t('app', 'REGION')) ?>

    <?php
        foreach ($model_content as $key => $content) {
            echo $form->field($content, "[$key]name")->label($content->name);
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
