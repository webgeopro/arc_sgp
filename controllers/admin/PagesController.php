<?php

namespace app\controllers\admin;

use app\models\Authors;
use app\models\Blog;
use app\models\TagsPages;
use Yii;
use app\models\Pages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\filters\AccessControl;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
{
    public function actions()
    {
        return [
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => '/uploads/blog', // Directory URL address, where files are stored.
                'path' => '@webroot/uploads/blog', // Or absolute path to directory where files are stored.
                'type' => 0,
            ]
        ];
    }

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

    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pages::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
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
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'blogs' => Blog::getAllMenuMap(),
                'authors' => Authors::getAllAuthorsMap(),
            ]);
        }
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {#die(print_r(Yii::$app->request->post()));
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate() && (null != $model->file)) {

                $model->file->saveAs(
                    'uploads/blog/' . $model->file->baseName . '.' . $model->file->extension
                );
                $model->pic = $model->file->baseName . '.' . $model->file->extension;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'blogs' => Blog::getAllMenuMap(),
                'authors' => Authors::getAllAuthorsMap(),
            ]);
        }
    }

    /**
     * Deletes an existing tag from page.
     * If deletion is successful, the browser will be redirected to the 'update' page.
     *
     * @param $tag_id
     * @param $page_id
     * @return mixed
     */
    public function actionTagDelete($tag_id, $page_id)
    {
        TagsPages::findOne($tag_id, $page_id)->delete();

        //return $this->redirect(['index']);
        return $this->redirect(Url::to(['/admin/pages/update', 'id'=>$page_id]));
    }

    /**
     * Add an existing tag to page.
     * If adding is successful, the browser will be redirected to the 'update' page.
     *
     * @param $tag_id
     * @param $page_id
     * @return mixed
     */
    public function actionTagAdd($tag_id, $page_id)
    {#die('actionTagAdd');
        $tag = new TagsPages;
        $tag->tag_id = $tag_id;
        $tag->page_id = $page_id;
        $tag->save();

        return $this->redirect(Url::to(['/admin/pages/update', 'id'=>$page_id]));
    }

    /**
     * Deletes an existing Pages model.
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
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
