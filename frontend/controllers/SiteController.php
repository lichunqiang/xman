<?php
namespace frontend\controllers;

use common\models\LoginForm;
use frontend\components\BookingInterface;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = false;
    protected $bookingService;

    public function __construct($id, $module, BookingInterface $bookingService, $config = [])
    {
        $this->bookingService = $bookingService;
        parent::__construct($id, $module, $config);
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            //ACF: access control filter
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'], //指明哪些action被使用
                'rules' => [
                    [
                        'actions' => ['signup'], //规则对应的action
                        'allow' => true,
                        'roles' => ['?'], // ? -> guest 指定规则对应的用户角色
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'], // @ -> authenticated users
                    ]
                ],
            ],
            //指定action的request method
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'index' => ['post', 'put', 'get']
                ],
            ],
            /**
             * 这里缓存了？？？
             *
             * @see https://github.com/ECDarwin/yii2/blob/master/docs/guide-zh-CN/caching-page.md
             */
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 60,
                'variations' => [
                    \Yii::$app->language
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction', //[$this, 'error']
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 2,
                'maxLength' => 3
            ],
        ];
    }
    public function error()
    {
        echo 'aa';
    }
    public function actionIndex()
    {
        //****request
        $request = Yii::$app->request;
        if ($request->isGet) {}
        if ($request->isAjax) {}
        if ($request->isPost) {}
        if ($request->isPut) {}

        // var_dump($request->url);

        //获取header
        $headers = $request->headers;
        // var_dump($headers->get('User-Agent'));
        // var_dump($request->getPreferredLanguage());
        // var_dump($request->acceptableLanguages);
        // var_dump($request->userIP);
        // Yii::beginProfile('benchmark');

        //****session
        $session = Yii::$app->session;
        // $session->set('captcha.number', 5);
        // $session->set('captcha.lifetime', 3600);
        // var_dump($session->get('captcha.lifetime', 'tests'));
        // Request #1
        // set a flash message named as "postDeleted"
        //$session->setFlash('postDeleted', 'You have successfully deleted your post.');

        // Request #2
        // display the flash message named "postDeleted"
        // echo $session->getFlash('postDeleted');
        // Request #3
        // $result will be false since the flash message was automatically deleted
        // $result = $session->hasFlash('postDeleted');

        //*****cookies
        $cookies = Yii::$app->request->cookies;

        //$language = $cookies->getValue('language', 'en');
        if (!$cookies->has('language')) {
            // var_dump($cookies);
            //sending...
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'language',
                'value' => 'zh-CN',
            ]));
        } else {}

        // \Yii::warning('start calculating average revenue', __METHOD__);
        $this->bookingService->hello();
        // var_dump($this);
        //Yii::createObject
        $denpendency = [
            'class' => 'frontend\components\Test',
            'fuck' => 'fuck'
        ];

        $obj = Yii::createObject($denpendency);

        $obj->on(\frontend\components\Test::EVENT_HELLO, function ($event) {
            // var_dump($event);
        });
        $obj->bar();
        // var_dump($obj->getBehaviors());

        $name = Yii::$app->fcache->get('name');
        // var_dump($name);
        if (false === $name) {
            Yii::$app->cache->set('name', 'ligt');
            $name = Yii::$app->cache->get('name');
        }
        // var_dump($name);
        // \Yii::$app->view->on(yii\web\View::EVENT_END_BODY, function () {
        //     echo date('Y-m-d');
        // });
        Yii::$app->getView()->title = '标题';
        // echo \Yii::t('app', 'title');
        // echo \Yii::t('common', 'title');
        echo Yii::t('app', 'Hello {name}', ['name' => 'light']);
        // var_dump(Yii::getAlias('@app'));

        // Yii::endProfile('benchmark');
        return $this->render('index', ['users' => ['light', 'li', 'chunqiang']]);
    }

    public function actionJson()
    {
        $query = \frontend\models\UserInfo::find();

        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'message' => 'hello wolrd',
            'data' => $query->all(),
            'code' => 100
        ];
    }

    public function actionAddUser()
    {
        // var_dump(Yii::$app->request->get());
        $user = new \frontend\models\UserInfo();
        $user->name = 123;
        $user->save();
    }

    public function actionRead()
    {
        var_dump(Yii::$app->request->get());
    }

    public function actionProfile()
    {
        var_dump(Yii::$app->request->get());
    }
    /**
     * This action is simple code of use mail
     *
     */
    public function actionMail()
    {
        $mailer = \Yii::$app->mailer;
        //single messsage
        $message = $mailer->compose('greeting.html', [
            'name' => 'thiis is name'
        ]);
        $message->setFrom([\Yii::$app->params['testEmail']=> 'light']);
        $res = $message->setTo('lightlee@ecdarwin.com')
                       ->setSubject('Message Subject')
        // ->setTextBody('this is message body')
        ->send();
        if ($res) {
            echo ('send message successfully.');
        } else {
            echo 'send error';
        }

        //mulitipule message
        // $messages = [];
        // foreach ($users as $user) {
        //     $messages[] = $mailer->compose()
        //     //...
        //     ->sendTo($user->email);
        // }
        // $mailer->sendMultiple($mssages);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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
        var_dump(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            var_dump($model->validate());
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $user = Yii::$app->getUser();
        var_dump($user);
        var_dump(Yii::$app->user);
        echo 'aa';
    }

    public function actionTray()
    {
        // $fcache = Yii::$app->fcache;
        // var_dump($fcache);
    }
}
