<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\District */
/* @var $region common\models\Region */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'District',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="district-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_content' => $model_content,
    ]) ?>

</div>
