<?php

namespace backend\controllers;

use common\models\FacilitiesLang;
use common\models\Lang;
use Yii;
use common\models\Facilities;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FacilitiesController implements the CRUD actions for Facilities model.
 */
class FacilitiesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Facilities models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Facilities::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Facilities model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Facilities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Facilities();
        for ($i = 1; $i <= Lang::find()->count(); $i++) {
            $model_content[$i] = new FacilitiesLang();
            $model_content[$i]['lang_id'] = $i;
            $model_content[$i]['id'] = 0;
        }

        if (Model::loadMultiple($model_content, Yii::$app->request->post()) &&
            Model::validateMultiple($model_content) &&
            $model->save())
        {
            foreach ($model_content as $key => $content) {
                $content->id = $model->id;
                $content->lang_id = $key;
                $content->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model_content' => $model_content,
            ]);
        }
    }

    /**
     * Updates an existing Facilities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        for ($i = 1; $i <= Lang::find()->count(); $i++) {
            $model_content[$i] = FacilitiesLang::find()->where(['id' => $id, 'lang_id' => $i])->one();
        }
        if (Model::loadMultiple($model_content, Yii::$app->request->post()) &&
            Model::validateMultiple($model_content))
        {
            foreach ($model_content as $key => $content) {
                $content->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_content' => $model_content,
            ]);
        }
    }

    /**
     * Deletes an existing Facilities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Facilities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Facilities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Facilities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
