<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\mssql\PDO;

/**
 * InlineForm is the model behind the contact form.
 */
class InlineForm extends Model
{
    public $name;     // Имя пользователя (опционально)
    public $contact;  // Контактные данные (e-mail / phone)
    public $action;   // CTA с формы
    public $page;     // С какой страницы форма
    public $date;     // Время обращения (Y-m-d H:i)
    public $question; // Пользовательский вопрос

    const PAGE_INDEX = 'index';
    const PAGE_EXCLUSIVE = 'exclusive';
    const PAGE_LANDING = 'landing';
    const PAGE_IM = 'im';

    public $pages = [self::PAGE_INDEX, self::PAGE_EXCLUSIVE, self::PAGE_LANDING, self::PAGE_IM];

    /*public function init()
    {
        $this->pages = [
            'index', 'exclusive', 'landing', 'im',
        ];
    }*/

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['contact'], 'required'],
            ['page', 'string', 'length'=>[2, 10]],
            ['name', 'string', 'length'=>[4, 30]],
            ['question', 'string', 'length'=>[5, 400]],
            [['contact', 'action'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            //'verifyCode' => 'Verification Code',
        ];
    }

    public function beforeValidate()
    {
        $this->clearContact(); // Очистка контактных данных от мусора

        return true;
    }

    public function afterValidate()
    {
        // Установка даты отправки зяавки + корректировка времени МСК
        $this->date = date('Y-m-d H:i:s', strtotime('+4 hours'));

        return true;
    }

    public function contact()
    {
        if ($this->validate()) {
            $this->_email($this->_getEmail());
            $this->_db();
            //$this->_sms();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Отправка (только) email
     * Используем swift, отправка на странице "Спасибо"
     */
    public function mail()
    {
        $address = $this->_getEmail();
        //json success
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param $email
     * @return boolean whether the model passes validation
     */
    protected function _email($email)
    {
        $body = "
            Время отправки заявки: {$this->date},\n
            Имя отправителя: {$this->name},\n
            Контакт отправителя: {$this->contact},\n
            Страница: {$this->page},\n
            Форма: {$this->action},\n\n
            Обработано: " . date("Y-m-d H:i:s");
        if ('' != $this->question)
            $body .= "Вопрос отправителя: {$this->question},\n";
        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['noReplyEmail'] => Yii::$app->params['siteName']])
            ->setSubject(Yii::$app->params['messNewOrder'])
            ->setTextBody($body)
            ->send();

        return true;
    }

    /**
     * Сохраняем в БД
     * @return bool
     */
    protected function _db()
    {
        $question = ('' == $this->question)
            ? $this->action    // Если задан вопрос
            : $this->question; // Записываем его вместо action

        Yii::$app->db
            ->createCommand('
                INSERT INTO {{orders}} ([[name]], [[date]], [[action]], [[page]], [[contact]])
                VALUES (:name, :date, :action, :page, :contact)
            ')
            ->bindParam(':page', $this->page, PDO::PARAM_STR)
            ->bindParam(':date', $this->date, PDO::PARAM_STR)
            ->bindParam(':action', $question, PDO::PARAM_STR)
            ->bindParam(':name', $this->name, PDO::PARAM_STR)
            ->bindParam(':contact', $this->contact, PDO::PARAM_STR)
            ->execute();

        return true;
    }

    /**
     * Отправка СМС о новой заявке на номер 29-655-59 с помощью сервиса sms.ru
     * @return bool
     */
    protected function _sms()
    {
        if ('' == $this->question) { // Передается action латинскими буквами
            $question = $this->action;
            $smsLength = 159; // до 160 латинских символов в СМС
        } else { // Задан вопрос в нижней форме, возможно по-русски
            $question = $this->question;
            $smsLength = 68; // до 70 русских символов в СМС
        }
        $date = $this->date
            ? '[' . $this->date . ']'
            : '(' . date("Y-m-d H:i:s") . ')';

        $body = substr("$date {$this->page}::$question", 0, $smsLength);

        \Yii::$app->sms->sms_send( Yii::$app->params['adminSMSNumber'], $body );

        return true;
    }

    protected function _getEmail()
    {
        //if (in_array($this->page, $this->pages))
            switch ($this->page) {
                case self::PAGE_LANDING : return Yii::$app->params['landing'];
                case self::PAGE_EXCLUSIVE : return Yii::$app->params['exclusive'];
                case self::PAGE_IM : return Yii::$app->params['im'];

                default: return Yii::$app->params['index'];
            }
        //return Yii::$app->params['index'];
    }


    /**
     * Очистка введенных пользователем данных (title),
     * на основе которых генерится title, componentUrl
     */
    protected function clearContact($contact=null)
    {
        if (empty($this->contact)) return false;

        $str = strip_tags(trim($this->contact)); // Обрезка пробелов в начале и конце строки
        $normalizeChars = array( // Массив подстановок
            'Á'=>'A', 'À'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Å'=>'A', 'Ä'=>'A', 'Æ'=>'AE', 'Ç'=>'C',
            'É'=>'E', 'È'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Í'=>'I', 'Ì'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ð'=>'Eth',
            'Ñ'=>'N', 'Ó'=>'O', 'Ò'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O',
            'Ú'=>'U', 'Ù'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y',

            'á'=>'a', 'à'=>'a', 'â'=>'a', 'ã'=>'a', 'å'=>'a', 'ä'=>'a', 'æ'=>'ae', 'ç'=>'c',
            'é'=>'e', 'è'=>'e', 'ê'=>'e', 'ë'=>'e', 'í'=>'i', 'ì'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'eth',
            'ñ'=>'n', 'ó'=>'o', 'ò'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o',
            'ú'=>'u', 'ù'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y',

            'ß'=>'sz', 'þ'=>'thorn', 'ÿ'=>'y',
            '&'=>' and '
        );
        $str = strtr($str, $normalizeChars); // Замена некорректных символов из массива подстановок
        $str = preg_replace("/([\s]+)|([\^\-\+\_]+)/", '-', $str); // Все пробелы (один и более) на дефис '-'
        $str = preg_replace('/[^\w\d\-\.\@]+/i', '', $str); // Убираем все, кроме букв, цифр, знаков подчеркивания '_' и дефиса '-'
        $str = preg_replace('/[\-]+/', '-', $str); // Заменяем множество подряд идущих дефисов '-' на только один
        $str = preg_replace('/\-$/', '', $str); // Убираем дефис в конце предложения

        $this->contact = htmlentities(trim($str));//mysql_real_escape_string()

        return true;
    }
}
