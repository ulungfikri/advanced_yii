<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use kartik\mpdf\Pdf;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function actionReport() 
    {
        // return $this->render('index');

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_reportview');
        
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
             
            'cssInline' => "
            table, th, td {
              border: 1px solid black;
              border-collapse: collapse;
          }
          th, td {
              padding: 5px;
              text-align: left;    
          }", 
            // set mPDF properties on the fly
            'options' => [
                'title' => 'Krajee Report Title',
            ],
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
        // return $this->render('index');
    }

    public function actionReportciler() 
    {
        // return $this->render('index');

        // get your HTML raw content without any layouts or scripts
        $content_value = $this->renderPartial('dks_ciler_value');
        $content_header = $this->renderPartial('dks_ciler_header');
        $content_footer = $this->renderPartial('dks_ciler_footer');
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content_value,  
            // ruler
            'marginHeader' => 0,  
            'marginTop' => 74,  
            'marginFooter' => -7,  
            'marginBottom' => 26,  
            'marginLeft' => 9,  
            'marginRight' => -8,  
            // 'disableBorderHeader' => true,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/custom.css',
            // any css to be embedded if required
            // 'cssInline' => '.kv-heading-2{font-size:50px}', 
            'cssInline' => "
                .table td 
                {
                    text-align: center; 
                    vertical-align: middle;
                    white-space: nowrap;
                }
                .table_value td
                {
                    font-size: 55%;
                    // white-space: nowrap;
                    display: inline-block;
                }
                .table_catatan, .table_analisa, .table_summary {
                    page-break-inside: avoid;
                }
                .div_table_catatan, .div_table_analisa, .div_table_summary {
                    // border: 1px solid #4CAF50;
                    padding-bottom: -10px;
                }", 
            // set mPDF properties on the fly
            'options' => [
                'title' => 'Krajee Report Title',
            ],
            // call mPDF methods on the fly
            'methods' => [ 
                // 'SetHeader'=>['CABANG / STOCK POINT  :  FBSLT||'], 
                // 'SetFooter'=>['FRM-SLS-002.A Rev 04||Last Update 24-12-2018 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Printed By E-FastOne'],
                // 'SetHTMLFooterByName'=>'<html>asdasdasdasdasd</html>',
                // 'SetHeader'=>false, 
                // 'SetFooter'=>false,
                'SetHeader'=>[$content_header],
                'SetFooter'=>[$content_footer],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
        // return $this->render('index');
    }

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
     * @return mixed
     */
    public function actionIndex()
    {
        // return $this->render('index');

        // get your HTML raw content without any layouts or scripts
        $content_value = $this->renderPartial('dks_value');
        $content_header = $this->renderPartial('dks_header');
        $content_footer = $this->renderPartial('dks_footer');
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content_value,  
            // ruler
            'marginHeader' => 0,  
            'marginTop' => 74,  
            'marginFooter' => -7,  
            'marginBottom' => 26,  
            'marginLeft' => 9,  
            'marginRight' => -8,  
            // 'disableBorderHeader' => true,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/custom.css',
            // any css to be embedded if required
            // 'cssInline' => '.kv-heading-2{font-size:50px}', 
            'cssInline' => "
                .table td 
                {
                    text-align: center; 
                    vertical-align: middle;
                    white-space: nowrap;
                }
                .table_value td
                {
                    font-size: 55%;
                    // white-space: nowrap;
                    display: inline-block;
                }
                .table_catatan, .table_analisa, .table_summary {
                    page-break-inside: avoid;
                }
                .div_table_catatan, .div_table_analisa, .div_table_summary {
                    // border: 1px solid #4CAF50;
                    padding-bottom: -10px;
                }", 
            // set mPDF properties on the fly
            'options' => [
                'title' => 'Krajee Report Title',
            ],
            // call mPDF methods on the fly
            'methods' => [ 
                // 'SetHeader'=>['CABANG / STOCK POINT  :  FBSLT||'], 
                // 'SetFooter'=>['FRM-SLS-002.A Rev 04||Last Update 24-12-2018 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Printed By E-FastOne'],
                // 'SetHTMLFooterByName'=>'<html>asdasdasdasdasd</html>',
                // 'SetHeader'=>false, 
                // 'SetFooter'=>false,
                'SetHeader'=>[$content_header],
                'SetFooter'=>[$content_footer],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
        // return $this->render('index');
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
            $model->password = '';

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
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
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
        } catch (InvalidArgumentException $e) {
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

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
