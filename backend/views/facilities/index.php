<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Facilities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facilities-index">

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [

                    'id',
                    'content.name',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
        <div class="box-footer">
            <?= Html::a(Yii::t('app', 'Create Facilities'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
