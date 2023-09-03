<?php

namespace app\controllers;

use app\models\Property;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ForbiddenHttpException;
use yii\web\UnauthorizedHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['admin-dashboard'],
                        'allow' => true,
                        'roles' => ['admin', 'manager'],
                    ],
                    [
                        'actions' => ['create-account'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        $availableProperty = Property::find()
    ->where(['availabilityStatus' => 'vacant'])
    ->joinWith('pictures') // Assuming 'pictures' is the name of the relation in your Property model
    ->all();
       
        
        return $this->render('index',[
            'availableProperty' => $availableProperty,
        ]);
    }

    /**
     * Displays contact page.
     *
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

     /**
     * Displays tenant dashboard.
     *
     */
    public function actionTenantDashboard()
    {
        return $this->render('tenant-dashboard');
    }
     /**
     * Displays admin - manager dashboard.
     *
     */

     public function actionAdminDashboard()
     {
         return $this->render('admin-dashboard');
     }

    
    public function actionCreateAccount()
    {
        return $this->render('create-account');
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = User::findByUsername($model->username);
            Yii::$app->session->set('user', $user);
            if ($user->isTenant) {
                return $this->redirect(['tenant-dashboard']);
            } else {
                return $this->redirect(['admin-dashboard']);
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->session->remove('user'); // Remove user data from session

        Yii::$app->user->logout();

        return $this->goHome();
    }

    
     
    

    //  public function beforeAction($action)
    //  {
    //      // Your existing code
    //      if ($action->id === 'create-account' && !Yii::$app->user->can('admin')) {
    //          throw new ForbiddenHttpException('You are not authorized to perform this action.');
    //      }
     
    //      // Get the user's access token from the request headers
    //      $accessToken = Yii::$app->request->headers->get('Authorization');
     
    //       // Validate access token and log in user
    //      $user = User::findOne(['accessToken' => $accessToken]);
     
    //      if ($user) {
    //          // The user is authenticated, proceed with the action
    //          Yii::$app->user->login($user);
    //      } else {
    //          throw new UnauthorizedHttpException('You are not authorized to access this resource.');
    //      }
     
    //      // Continue with the parent's beforeAction()
    //      return parent::beforeAction($action);
    //  }

}
