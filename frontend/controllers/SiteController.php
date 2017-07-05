<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Auth;
use common\models\User;
use common\models\UsuarioDetalle;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
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
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
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
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) 
        {
            $tipo= Yii::$app->request->post('options');

            //si tipo es vacio es porque es cliente
            if(!isset($tipo))
            {
                $tipo=1;
            }

            $model->username=$model->email;
            if ($user = $model->signup()) {

                $auth = new Auth([
                'user_id' => $user->id,
                'source' => 'sistema'
                ]);
                if ($auth->save()) {
                // Yii::$app->user->login($user);
                } else {
                print_r($auth->getErrors());
                }

                if (Yii::$app->getUser()->login($user)) {
                    if($tipo==2 || $tipo==3)
                    {
                        //crear vista para perfil de cocinero
                        return $this->render('perfil_cocinero',['id_usuario'=>$user->id]);        
                    }
                    else
                    {
                        return $this->goHome();
                    }
                    
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
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
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    //registration
    public function actionRegistration() 
    {
        return $this->render('registration');
    }

    //food resultado
    public function actionFoodResultado() 
    {
        return $this->render('food_results');
    }
    //mapa resultado
    public function actionMapaResultado() 
    {
        return $this->render('map_results');
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
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    //login por facebook
    public function onAuthSuccess($client)
    {
       $attributes = $client->getUserAttributes();

        /** @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // signup
                       
                if($client->getId()=='facebook')
                {
                    if (User::find()->where(['email' => $attributes['email']])->exists()) {
                        Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
                        ]);
                    } 
                    else 
                    {
                        $password = Yii::$app->security->generateRandomString(6);
                        $user = new User([
                            'username' => $attributes['email'],
                            'email' => $attributes['email'],
                            'password' => $password,
                            'nombres' => $attributes['first_name'],
                            'apellidos'=>$attributes['last_name'],
                            'fnacimiento'=>isset($attributes['birthday']) ? $attributes['birthday'] : null,
                            'sexo'=>$attributes['gender'],
                        ]);
                        $user_detalle=
                        $user->generateAuthKey();
                        $user->generatePasswordResetToken();
                        $transaction = $user->getDb()->beginTransaction();
                        if ($user->save()) {
                            //crea datos en la tabla usuario detalle
                            $user_detalle = new UsuarioDetalle();
                            $user_detalle->id_tipo_usuario=1;
                            $user_detalle->id_usuario=$user->id;
                            if($user_detalle->save())
                            {

                            }
                            else
                            {
                                print_r($user_detalle->getErrors());
                                return false;
                            }

                            //crea datos en la tabla auth
                            $auth = new Auth([
                                'user_id' => $user->id,
                                'source' => $client->getId(),
                                'source_id' => (string)$attributes['id'],
                            ]);
                            if ($auth->save()) {
                                $transaction->commit();
                                Yii::$app->user->login($user);
                            } else {
                                print_r($auth->getErrors());
                            }
                        } else {
                            print_r($user->getErrors());
                        }
                    }
                }
                else
                {       //
                        if (User::find()->where(['email' => $attributes['emails']])->exists()) {
                            Yii::$app->getSession()->setFlash('error', [
                                Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
                            ]);
                        } 
                        else 
                        {
                            $password = Yii::$app->security->generateRandomString(6);
                            $user = new User([
                                'username' => $attributes['emails'],
                                'email' => $attributes['emails'],
                                'password' => $password,
                                'nombres' => $attributes['person']['givenName'],
                                'apellidos'=>$attributes['person']['familyName'],
                                'fnacimiento'=>isset($attributes['birthday']) ? $attributes['birthday'] : null,
                                'sexo'=>isset($attributes['gender']) ? $attributes['gender'] : null
                            ]);
                            $user->generateAuthKey();
                            $user->generatePasswordResetToken();
                            $transaction = $user->getDb()->beginTransaction();
                            if ($user->save()) {
                                //crea datos en la tabla usuario detalle
                                $user_detalle = new UsuarioDetalle();
                                $user_detalle->id_tipo_usuario=1;
                                $user_detalle->id_usuario=$user->id;
                                if($user_detalle->save())
                                {

                                }
                                else
                                {
                                    print_r($user_detalle->getErrors());
                                    return false;
                                }
                                //crea  datos en la tabla auth
                                $auth = new Auth([
                                    'user_id' => $user->id,
                                    'source' => $client->getId(),
                                    'source_id' => (string)$attributes['id'],
                                ]);

                                
                                if ($auth->save()) {
                                    $transaction->commit();
                                    Yii::$app->user->login($user);
                                } else {
                                    print_r($auth->getErrors());
                                }
                            } else {
                                print_r($user->getErrors());
                            }
                        }
                }

            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }
    }

}
