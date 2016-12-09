<?php


namespace app\modules\users\controllers;

use Yii;
use app\modules\users\models\Userdetail;
use app\modules\users\models\UserdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ForgetpasswordController implements the CRUD actions for Userdetail model.
 */
class ForgotpasswordController extends Controller
{



    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Userdetail models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = new Userdetail();
		$username_errormesg=null;
		$password_errormesg=null;
			
		if((isset($_POST['username']) and ($_POST['username']!=null))) {		
			$username=$_POST['username'];
			$model1 = Userdetail::findOne(['username'=>$username]);
			if(count($model1)>0){
				$new_password=$_POST['new_password'];
				$reenter_password=$_POST['reenter_password'];
				if(($new_password==$reenter_password) and ($new_password!=null) and ($reenter_password!=null)){	
					$model1->password=MD5($new_password);	
					if($model1->save()){
						 Yii::$app->user->switchIdentity($model1); // log in
						return $this->goHome();
					}
				}else{
					$password_errormesg='Verify Password Again.';
					return $this->render('index', [
						'model' => $model,
						'username_errormesg' =>$username_errormesg,
						'password_errormesg' =>$password_errormesg,
					]);
				}		
			}else{
				$username_errormesg='Username does not exist.';
				return $this->render('index', [
					'model' => $model,
					'username_errormesg' =>$username_errormesg,
					'password_errormesg' =>$password_errormesg,
				]);
			}
        } 		
            return $this->render('index', [
                'model' => $model,
				'username_errormesg' =>$username_errormesg,
				'password_errormesg' =>$password_errormesg,
            ]);

    } 
	
}
