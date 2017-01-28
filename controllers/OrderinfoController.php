<?php

namespace app\controllers;

use Yii;
use app\models\OrderInfo;
use app\models\OrderInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ItemInfo;
use app\models\OrderItemInfo;
use app\modules\users\models\Userdetail;

use yii\helpers\Url;
/**
 * OrderinfoController implements the CRUD actions for OrderInfo model.
 */
class OrderinfoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OrderInfo models.
     * @return mixed
     */
 

	public function actionIndex()
    {
        $searchModel = new OrderInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderInfo model.
     * @param integer $id
     * @return mixed
     */
	 
	 
	 
    public function Additemtoorder($itemid)
    {
		
		$item_id=0;
		$item_qty=0;
		$item_price=0;
		$item_chef=0;
		$item_name=null;
		$item_ingredients=null;
		$item_cuisine_type=null;

		$item_image=Url::to('@web/fuberme/images/default_item_image.jpg');
		$item_info = ItemInfo::find()->where([ 'id'=>$itemid,'status'=>1 ])->one();
		if(count($item_info)>0){
			$item_id=$item_info->id;
			$item_qty=1;
			$item_price=$item_info->price;
			$item_chef=$item_info->chef_user_id;
			$item_name=$item_info->name;			
			$item_cuisine_type=$item_info->cuisineTypeInfo->name;

			if($item_info->ingredients!=null) {
				$item_ingredients=$item_info->ingredients;	
			}
			if($item_info->image!=null){
			  $item_image=Url::to('@web/fuberme/'.$item_chef.'/item_images/'.$item_info->image);
			}			
		}		
		
		$item_array=array();
		$item_array=array($itemid=>array('item_id'=>$item_id,'item_name'=>$item_name,
										'item_qty'=>$item_qty,'item_price'=>$item_price,
										'item_ingredients'=>$item_ingredients,'item_cuisine_type'=>$item_cuisine_type,
										'item_chef'=>$item_chef,'item_image'=>$item_image
									));
		return $item_array;    
	}	
	 
	 
	public function  UpdateAmount(){
		
		$order_array=$_SESSION['order_array'];
		$order_item_array=null;
		$order_item_array=$order_array['order_item'];
		$tax_in_percent=$order_array['tax_in_percent'];
		$get_price=array();
		foreach($order_item_array as $value){
			$get_price[]=$value['item_price']*$value['item_qty'];
		}
		
		$total_amount=0;
		$final_amount=0;			
		$final_amount_per=0;			
		$total_amount=array_sum($get_price);
		
		$final_amount=$total_amount;		
		if($tax_in_percent>0){			
			$final_amount_per=($total_amount*$tax_in_percent)/100;
			$final_amount=$total_amount+$final_amount_per;
		}

		$_SESSION['order_array']['total_amount']=$total_amount;
		$_SESSION['order_array']['final_amount']=$final_amount;
		
	}
	 
	 
    public function actionReview($itemid)
    {

		// Buil session here
		$order_array=array();	
		$item_info=array();	
		$customer_name=null;
		$customer_email=null;
		$customer_address=null;
		$customer_city=null;
		$customer_state=null;
		$customer_zip=null;
		$customer_mobile_no=null;
		$payment_method=null;
		$delivery_method=null;
		$tax_in_percent=0;
		$item_chef=0;
		$customer_id=0;
			
		$user_id=Yii::$app->user->id;	
		$user_info = Userdetail::find()->where([ 'id'=>$user_id,'status'=>1 ])->one();
		if(count($user_info)>0){
			$customer_id=$user_info->id;
			$customer_name=$user_info->username;
			$customer_email=$user_info->email_id;
			$customer_mobile_no=$user_info->mobile_number;
			$customer_address=$user_info->address;
			$customer_city=$user_info->city;
			$customer_state=$user_info->state;
			$customer_zip=$user_info->zipcode;
		}

		$item_info=$this->Additemtoorder($itemid);
		$item_chef=$item_info[$itemid]['item_chef'];
		if(count($item_chef)>0){
		$chef_info = Userdetail::find()->where([ 'id'=>$item_chef,'status'=>1 ])->one();
			if(count($chef_info)>0){
				$payment_method=$chef_info->payment_method;
				$delivery_method=$chef_info->delivery_method;
			}
		}
		
		
		if($payment_method!=null and $payment_method='paypal'){
			$tax_in_percent=2;	
		}

		$order_array['customer_info']=array('customer_id'=>$customer_id,'customer_name'=>$customer_name,
								'customer_email'=>$customer_email,'customer_address'=>$customer_address,
								'customer_city'=>$customer_city,'customer_state'=>$customer_state,
								'customer_zip'=>$customer_zip,'customer_mobile_no'=>$customer_mobile_no); 
		$order_array['order_item']=$item_info;
		$order_array['payment_method']=$payment_method;
		$order_array['delivery_method']=$delivery_method;
		$order_array['tax_in_percent']=$tax_in_percent;
		$order_array['total_amount']=0;			// Function for calculate total amount
		$order_array['final_amount']=0;			// Function for calculate total amount
		

		$_SESSION['order_array'] = $order_array;

		$item_info=$this->UpdateAmount();

        return $this->render('review', [
            'order_array' => $_SESSION['order_array'],
        ]);
    }  
	

 	public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    } 

    /**
     * Creates a new OrderInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		session_start();	

        $model = new OrderInfo();

        if ($model->load(Yii::$app->request->post())) {
			
			$order_array=$_SESSION['order_array'];
			$order_number=0;
			$order_status=1;   // Order Place
			$userid=$order_array['customer_info']['customer_id'];
			$order_number=substr(number_format(time() * rand(),0,'',''),0,10);
			$model->order_number=$order_number;
			$model->final_amount=$order_array['final_amount'];
			$model->total_amount=$order_array['total_amount'];
			$model->tax_in_percent=$order_array['tax_in_percent'];
			$model->user_id=$order_array['customer_info']['customer_id'];
			$model->order_status=$order_status;

			if($model->save()){
				$order_items=$order_array['order_item'];
				foreach($order_items as $order_item){
					 $model1 = new OrderItemInfo();
					 $model1->order_info_id=$model->id;
					 $model1->item_id=$order_item['item_id'];
					 $model1->item_qty=$order_item['item_qty'];
					 $model1->item_price=$order_item['item_price'];
					 $model1->item_chef_user_id=$order_item['item_chef'];
					 $model1->save();									
				}
				return $this->redirect(['view', 'id' =>$model->id]);
			}		
           
        } else {
            return $this->render('create', [
                'model' => $model,
				'order_array' => $_SESSION['order_array'],
            ]);
        }
    }

    /**
     * Updates an existing OrderInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
	 
	 
/*     public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    } */

	
	
    /**
     * Deletes an existing OrderInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
	 
	 
	 
/*     public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    } */

    /**
     * Finds the OrderInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
