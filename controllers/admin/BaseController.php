<?php

namespace app\controllers\admin;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * Universal BaseController implements the CRUD actions for all models.
 */
class BaseController extends Controller
{
    /**
     * Название класса для дальнейшей работы
     * @var string
     */
    public $recordClass;

    public function behaviors()
    {
        return [

            'access'=>[
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'roles' => ['@'], // Зарегистрированные
                        'allow' => true,
                    ],
                    [
                        'roles' => ['?'], // Гости
                        'allow' => false,
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => call_user_func([$this->recordClass, 'find']),
        ]);

        return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Displays a single Tags model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new  model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var ActiveRecord $model */
        $model = new $this->recordClass;

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['view', 'id' => $model->id]);

        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Updates an existing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['view', 'id' => $model->id]);

        return $this->render('update', ['model' => $model,]);

    }

    /**
     * Deletes an existing Tags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = call_user_func([$this->recordClass, 'findOne'], $id);

        if (!$model)
            throw new NotFoundHttpException('The requested page does not exist.');

        return $model;
    }
}
