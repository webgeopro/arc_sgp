<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\InlineForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect('/admin');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Страница администрирования со списком редактируемых рубрик
     *
     * @return mixed
     */
    public function actionAdmin()
    {
        if (\Yii::$app->user->isGuest) #todo Ограничить доступ
            return $this->goHome();

        return $this->render('admin');
    }

    /**
     * Страница "Спасибо"
     * На страницу попадают после отправки любой из форм
     *
     * @return string
     */
    public function actionSpasibo()
    {
        if (Yii::$app->request->isPost) { // Обработка отправленной формы
            $model = new InlineForm();
            $model->attributes = Yii::$app->request->post();
            if ($model->contact()) { // Валидация. Отправка email. Запись в БД.
                //todo $this->refresh();
                //flash ->item для послед. получения _getItemAdditional()
                return $this->render('spasibo', [
                    //'contactFormSubmitted' => true, // Не используется
                    'item' => $this->_getItemAdditional(), // Получить связанную информацию
                ]);
            }
        }
        /*if (flash) {

        }*/
        // Повторный / прямой / случайный заход пользователя
        // Передаваемый в адресной строке идентификатор страницы-донора

        /*return $this->render('spasibo-direct', [
            'item' => $this->_getItemAdditional(), // Получить связанную информацию
        ]);*/

        return $this->goHome();
    }

    /**
     * Получение фонового изображения
     * Хелпер. Позже будет перенесен
     *
     * @return mixed
     */
    protected function _getItemAdditional()
    {
        //$pageID = Yii::$app->request->get('pageID');
        $pageID = Yii::$app->request->post('page');

        switch ($pageID) {
            case InlineForm::PAGE_LANDING : // Страница "Лендинги"
                $item['bgImage'] = Yii::$app->params['indexBg']; //Yii::$app->params['landingBg'];
                $item['header'] = 'ВАША ЗАЯВКА ПОЛУЧЕНА';
                $item['mapHeader'] = 'Разработка и продвижение Landing Page';
                $item['email'] = Yii::$app->params[InlineForm::PAGE_LANDING];
                $item['margin'] = 70;
                $tpl = InlineForm::PAGE_LANDING;
                break;

            case InlineForm::PAGE_EXCLUSIVE :  // Страница "Эксклюзив"
                $item['bgImage'] = Yii::$app->params['indexBg']; //Yii::$app->params['exclusiveBg'];
                $item['header'] = 'ВАША ЗАЯВКА ПОЛУЧЕНА';
                $item['mapHeader'] = 'Разработка сложных нетиповых интернет-решений';
                $item['email'] = Yii::$app->params[InlineForm::PAGE_EXCLUSIVE];
                $item['margin'] = 40;
                $tpl = InlineForm::PAGE_EXCLUSIVE;
                break;

            case InlineForm::PAGE_IM :  // Страница "Интернет-маркетинг"
                $item['bgImage'] = Yii::$app->params['imBg'];
                $item['header'] = 'Страница "Интернет-маркетинг"';
                $item['mapHeader'] = 'Весь спектр услуг интернет-маркетинга';
                $item['email'] = Yii::$app->params[InlineForm::PAGE_IM];
                $item['margin'] = 70;
                $tpl = InlineForm::PAGE_IM;
                break;

            default: // Всё остальное === Страница "Главная"
                $item['bgImage'] = Yii::$app->params['indexBg'];
                $item['header'] = 'ВАША ЗАЯВКА ПОЛУЧЕНА';
                $item['mapHeader'] = 'Разработка и продвижение продающих сайтов';
                $item['email'] = Yii::$app->params[InlineForm::PAGE_INDEX];
                $item['margin'] = 40;
                $tpl = InlineForm::PAGE_INDEX;
        }

        $item['htmlQuestions']  = $this->renderPartial('questions/' . $tpl);
        $item['htmlActivities'] = $this->renderPartial('activities/' . $tpl);

        return $item;
    }
}
