<?php
namespace frontend\controllers;

use frontend\models\ContactForm;
use yii;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\models\Service;
use yii\widgets\ActiveForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public $layout = 'agency';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
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
        ]);
    }

    /**
     * @inheritdoc
     */
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
            'page' => [
                'class' => 'yii\web\ViewAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $services = Service::find()->where(['status'=> Service::STATUS_ACTIVE])->all();
     //   $portfolio = Portfolio::find()->active()->orderBy('display_order')->all();
        return $this->render('index', [
            'services' => !empty($services) ? $services : null,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('request-password-reset-token', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }
    public function actionValidate()
    {
        $model = new ContactForm();

        if (yii::$app->request->isPost && $model->load(yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    public function actionSendEmail() {
        $model = new ContactForm();

        if (yii::$app->request->isPost && $model->load(yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $mailer = Yii::$app->get('mailer');
            $body_text = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $model->name\n\nEmail: $model->email\n\nPhone: $model->phone\n\nMessage:\n$model->message";
            $message = $mailer->compose()
                ->setFrom($model->email)
                ->setTo(Yii::$app->params['adminEmail'] )
                ->setSubject("Website Contact Form:  $model->name")
                ->setTextBody($body_text );

            if ($message->send()) {
                Yii::info($body_text , 'sendEmail');
                Yii::$app->getSession()->setFlash('success', 'Your message has been sent.');
            } else {
                Yii::error('error to send message from your website contact form' , 'errorEmail');
            }

        }
        return  $this->redirect('/site/index');
        Yii::app()->end();
    }
}

