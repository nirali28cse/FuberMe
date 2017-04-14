<?php

namespace app\controllers;

use Yii;
use app\models\OrderInfo;
use app\models\OrderInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ItemInfo;
use app\models\ItemInfoLiveSearch;
use app\models\ItemInfoOfflineSearch;
use app\models\OrderItemInfo;
use app\modules\users\models\Userdetail;
use yii\data\Pagination;
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
	
	
	public function beforeAction($action) {
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
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

	public function actionIndex2()
    {
        $searchModel = new OrderInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	
	
    /**
     * Displays a single OrderInfo model.
     * @param integer $id
     * @return mixed
     */
	 
	 
    public function actionCheckchef()
    {
		session_start();
		$itemid=0;
		$itemid=$_POST['item_id'];
		$item_info = ItemInfo::find()->where([ 'id'=>$itemid,'status'=>1])->one();
		if(count($item_info)>0){
			$item_chef=$item_info->chef_user_id;
			$item_quantity=$item_info->quantity;
			if($item_quantity>0){
				if(isset($_SESSION['master_chef']) and ($_SESSION['master_chef']>0)){
					if($_SESSION['master_chef']!=$item_chef){
						return false;
					}
				}
				if(Yii::$app->user->id==$item_chef){
					return 4;
				}
				
				return true;
			}else{
				return 3;	
			}
			
		}
	}	
	 
	
		 
		 
    public function Deleteitem($itemid)
    {			
		if(isset($_SESSION['order_array'])){
			$old_session_items=$_SESSION['order_array']['order_item'];	
			unset($old_session_items[$itemid]);
			$_SESSION['order_array']['order_item']=$old_session_items;  

			return $old_session_items;    
		}	
	}		
	
    public function Additemtoorder($itemid)
    {
		
		$item_id=0;
		$item_qty=0;
		$item_price=0;
		$item_chef=0;
		$item_quantity=0;
		$item_name=null;
		$item_ingredients=null;
		$item_chef_name=null;
		$item_cuisine_type=null;
		
		$item_array=array();
		$old_session_items=array();
		if(isset($_SESSION['order_array'])){
			$old_session_items=$_SESSION['order_array']['order_item'];	
		}		
		$item_image=Url::to('@web/fuberme/images/default_item_image.jpg');
		$item_info = ItemInfo::find()->where([ 'id'=>$itemid,'status'=>1])->one();
		if(count($item_info)>0){
			$item_id=$item_info->id;
			$item_qty=1;
			$item_price=$item_info->price;
			$item_chef=$item_info->chef_user_id;
			$item_chef_name=$item_info->chefUser->username;
			$item_name=$item_info->name;			
			$item_chef_quantity=$item_info->quantity;			
			$item_cuisine_type=$item_info->cuisineTypeInfo->name;

			if($item_info->ingredients!=null) {
				$item_ingredients=$item_info->ingredients;	
			}
			if($item_info->image!=null){
			  $item_image=Url::to('@web/fuberme/'.$item_chef.'/item_images/'.$item_info->image);
			}	

			$item_array=array($itemid=>array('item_id'=>$item_id,'item_name'=>$item_name,
											'item_qty'=>$item_qty,'item_price'=>$item_price,
											'item_ingredients'=>$item_ingredients,'item_cuisine_type'=>$item_cuisine_type,
											'item_chef_name'=>$item_chef_name,'item_chef'=>$item_chef,'item_image'=>$item_image
											,'item_chef_quantity'=>$item_chef_quantity
										));			
		}

		if(count($old_session_items)>0){
			$item_array=$old_session_items+$item_array;
		}else{
			if(count($item_array)>0){
				unset($_SESSION['master_chef']);
				unset($_SESSION['master_chef_name']);
				$_SESSION['master_chef']=$item_array[$itemid]['item_chef'];
				$_SESSION['master_chef_name']=$item_array[$itemid]['item_chef_name'];
			}
		}		
	
		return $item_array;    
	}	
	 
	 
	public function  UpdateAmount(){
		
		$order_array=$_SESSION['order_array'];

		$order_item_array=null;
		$order_item_array=$order_array['order_item'];
		$tax_in_percent=$order_array['tax_in_percent'];
		$get_price=array();
		if(count($order_item_array)>0){
			foreach($order_item_array as $value){
				$get_price[]=$value['item_price']*$value['item_qty'];
			}
			
			$total_amount=0;
			$final_amount=0;			
			$final_amount_per=0;			
			$tax_in_percent_amount=0;			
			$total_amount=array_sum($get_price);
			$total_amount=number_format((float)$total_amount, 2, '.', '');
			
			$final_amount=$total_amount;		
			if($tax_in_percent>0){			
				$final_amount_per=($total_amount*$tax_in_percent)/100;
				$final_amount_per=$final_amount_per+0.30;
				$final_amount=$total_amount+$final_amount_per;
				$final_amount=number_format((float)$final_amount, 2, '.', '');
				$tax_in_percent_amount=$final_amount_per;
			}

			$_SESSION['order_array']['total_amount']=$total_amount;
			$_SESSION['order_array']['final_amount']=$final_amount;
			$_SESSION['order_array']['tax_in_percent_amount']=$tax_in_percent_amount;
		}

		
	}
	 
	 
    public function actionChangeqty()
    {
		session_start();
		$item_id=$_POST['item_id'];
		$new_qty=$_POST['new_qty'];
		if(isset($_SESSION['order_array'])){
			$_SESSION['order_array']['order_item'][$item_id]['item_qty']=$new_qty;
			$this->UpdateAmount();
			$norder_array=array('total_amount'=>$_SESSION['order_array']['total_amount'],'final_amount'=>$_SESSION['order_array']['final_amount']);
			echo $json = json_encode($norder_array);
		}

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
		$tax_in_percent_amount=0;
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
		
		
		if($payment_method!=null and $payment_method=='paypal'){
			$tax_in_percent=2.9;	
		}
		
		
	//	if(isset($_GET['directorder']) and $_GET['directorder']>0){
		if(isset($_SESSION['order_array']['order_item'])){
			$order_items=$_SESSION['order_array']['order_item'];
			if(count($order_items)>0){
				foreach($order_items as $order_item){					
					$chef_id=$order_item['item_chef'];
					if(Yii::$app->user->id==$chef_id){
						$ditem=$order_item['item_id'];
						$item_info=$this->Deleteitem($ditem);
					}
				}
			}
		}

		// delete item		
		if(isset($_GET['ditem']) and $_GET['ditem']>0){
			$ditem=$_GET['ditem'];
			$item_info=$this->Deleteitem($ditem);
		}
		
		
		
		$order_array['customer_info']=array('customer_id'=>$customer_id,'customer_name'=>$customer_name,
								'customer_email'=>$customer_email,'customer_address'=>$customer_address,
								'customer_city'=>$customer_city,'customer_state'=>$customer_state,
								'customer_zip'=>$customer_zip,'customer_mobile_no'=>$customer_mobile_no); 
		$order_array['order_item']=$item_info;
		$order_array['payment_method']=$payment_method;
		$order_array['delivery_method']=$delivery_method;
		$order_array['tax_in_percent']=$tax_in_percent;
		$order_array['tax_in_percent_amount']=$tax_in_percent_amount;
		$order_array['total_amount']=0;			// Function for calculate total amount
		$order_array['final_amount']=0;			// Function for calculate total amount
		

		$_SESSION['order_array'] = $order_array;


		$item_info=$this->UpdateAmount();
		

		//update offline live items
		// Call functtion for to update item 
		Yii::$app->mediacomponent->Updateitemstatus();	
		//update offline live items
		
		
		
		if(isset($_SESSION['master_chef']) and $_SESSION['master_chef']>0){
			$chef_array[]=$_SESSION['master_chef'];
			if($chef_array!=null){
				$_SESSION['filetrsarray']=array(
											'min_location'=>1,
											'max_location'=>1,
											'chef_array'=>$chef_array,
											'search_by_item'=>null,
											'min_price'=>0,
											'max_price'=>0,
											'cusion_array'=>array(),
											'dieta_array'=>array(),
											'categ_array'=>array(),
											);
			}
		}

		
        $livesearchModel = new ItemInfoLiveSearch(); 
        $livedataProvider = $livesearchModel->search(Yii::$app->request->queryParams); 
				
        $offlinesearchModel = new ItemInfoOfflineSearch(); 
        $offlinedataProvider = $offlinesearchModel->search(Yii::$app->request->queryParams); 


        return $this->render('review', [
            'order_array' => $_SESSION['order_array'],
            'master_chef' => $_SESSION['master_chef'],
            'livedataProvider' => $livedataProvider,
            'offlinedataProvider' => $offlinedataProvider,
        ]);
    }  
	

 	public function actionView($id)
    {	
		$orderitems = OrderItemInfo::find()->where(['order_info_id'=>$id])->all(); 
        return $this->render('view', [
            'model' => $this->findModel($id),
            'orderitems' => $orderitems,
        ]);
    } 

	
	

	 public function Afterinvoiceupdateitemqty($item_id,$item_chef_id,$update_qty,$customer_user_id,$order_query,$order_item_query){
		// update qty in item_info table		
		$item_info = ItemInfo::find()->where([ 'id'=>$item_id,'status'=>1])->one();
		if(count($item_info)>0) {
			
			$old_qty=$item_info->quantity;
			$new_qty=0;
			$new_qty=$old_qty-$update_qty;
			$item_info->quantity=$new_qty;
			
			if($new_qty<3){
				// email to chef
				$send_email=Yii::$app->emailcomponent->Chefinformlessqty($item_chef_id);
			}
			if($new_qty==0){
				// take offline item 
				$newhours = date("H");
				$newminiute = date("i");		
				if($newminiute>=0 and $newminiute<=30) $newminiute = '00';
				if($newminiute>=30 and $newminiute<=60) $newminiute = 30;
				$newTime = $newhours.':'.$newminiute;
				$item_info->availability_to_date=date('Y-m-d');
				$item_info->availability_to_time=$newTime;
			}
			
		
			$item_info->save();
			
			
		}
	}
	
	
	 public function Emailsend($item_chef_id,$customer_user_id,$order_query,$order_item_query){
	
/* 		$order_query
		$order_item_query
		$item_chef_id
		$customer_user_id */
		//For new Order place
		$send_email_chef=Yii::$app->emailcomponent->Neworderinformchef($item_chef_id,$order_query,$order_item_query);
		$send_email_customer=Yii::$app->emailcomponent->Neworderinformcustomer($item_chef_id,$customer_user_id,$order_query,$order_item_query);
		$send_email_fuberadmin=Yii::$app->emailcomponent->Neworderinformfuberadmin($item_chef_id,$order_query);
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
			$order_seq_number=0;
			
			$payment_method=$_POST['OrderInfo']['payment_method'];
			if($payment_method=='cod'){
				$order_status=1;   // Order Place	
			}	
			
			if($payment_method=='paypal'){
				$order_status=2;   // Order Place	
			}
			
			$userid=$order_array['customer_info']['customer_id'];
			// $order_number=substr(number_format(time() * rand(),0,'',''),0,10);
			
			// generate seq order number
			$last_entry=OrderInfo::find()->orderBy(['id' => SORT_DESC])->one();
			$last_seq_number=0;
			if(count($last_entry)>0){
				$last_seq_number=$last_entry->order_seq_number;
			}
			if(count($last_seq_number)>0){
				$order_seq_number=$last_seq_number+1;
			}else{
				$order_seq_number=1;
			}
			
			$count_number=strlen((string)$order_seq_number);
			if($count_number==1) $order_seq_zeronumber='00000'; 
			if($count_number==2) $order_seq_zeronumber='0000'; 
			if($count_number==3) $order_seq_zeronumber='000'; 
			if($count_number==4) $order_seq_zeronumber='00'; 
			if($count_number==5) $order_seq_zeronumber='0'; 
			// generate seq order number
			
			$order_number=date('Y').$order_seq_zeronumber.$order_seq_number;			
			$model->order_number=$order_number;
			$model->order_seq_number=$order_seq_zeronumber.$order_seq_number;			
			$model->final_amount=$order_array['final_amount'];
			$model->total_amount=$order_array['total_amount'];
			$model->tax_in_percent=$order_array['tax_in_percent'];
			$model->user_id=$order_array['customer_info']['customer_id'];
			$model->order_status=$order_status;
			$model->order_date_time=date('Y-m-d H:i:s');

			if($model->save()){
				$order_items=$order_array['order_item'];
				foreach($order_items as $order_item){
					 $model1 = new OrderItemInfo();
					 $model1->order_info_id=$model->id;
					 $model1->item_id=$order_item['item_id'];
					 $model1->item_qty=$order_item['item_qty'];
					 $model1->item_price=$order_item['item_price'];
					 $model1->item_chef_user_id=$order_item['item_chef'];
					 if($model1->save()){
						if($model->payment_method=='cod'){
							$item_id=$model1->item_id;
							$item_chef_id=$model1->item_chef_user_id;
							$update_qty=$model1->item_qty;
							$customer_user_id=$model->user_id;
							$order_query=$model;
							$order_item_query=$model1;
							$this->Afterinvoiceupdateitemqty($item_id,$item_chef_id,$update_qty,$customer_user_id,$order_query,$order_item_query); 	
						}				
					 }						
				}
				if($model->payment_method=='cod'){	
					$order_item_query1 = OrderItemInfo::find()->where(['order_info_id'=>$model->id])->all(); 
					$this->Emailsend($item_chef_id,$customer_user_id,$order_query,$order_item_query1);
					unset($_SESSION['order_array']);
					unset($_SESSION['master_chef']);
					return $this->redirect(['view', 'id' =>$model->id]);
				}
				if($model->payment_method=='paypal' and isset($_SESSION['order_array'])){
					return $this->redirect(['paypalinvoice','orderid' =>$model->id]);
				}	
			}		
           
        } else {
			if(isset($_SESSION['order_array'])){
				return $this->render('create', [
					'model' => $model,
					'order_array' => $_SESSION['order_array'],
				]);
			}else{
			 return $this->redirect(['site/index']);
			}
        }
    }

	
	public function actionPaypalinvoice($orderid)
    {
		session_start();	
		return $this->render('paypalinvoice', [
			'order_array' => $_SESSION['order_array'],
			'master_chef' => $_SESSION['master_chef'],
			'orderid' => $orderid,
		]);
	}
	
	
	
	public function actionPaypalordersuccess()
    {
		
		if(isset($_GET['order_id'])){
			session_start();
			$model = $this->findModel($_GET['order_id']);
			$order_status=3;  // order status change
			$model->order_status=$order_status;
			if($model->save()){
				unset($_SESSION['master_chef']);
				unset($_SESSION['master_chef_name']);
				unset($_SESSION['order_array']);
				$order_items = OrderItemInfo::find()->where(['order_info_id'=>$model->id])->all(); 
				if(count($order_items)){
					foreach($order_items as $order_item){				
						if($model->payment_method=='paypal'){
							$item_id=$order_item->item_id;
							$item_chef_id=$order_item->item_chef_user_id;
							$update_qty=$order_item->item_qty;
							$customer_user_id=$model->user_id;
							$order_query=$model;
							$order_item_query=$order_item;
							$this->Afterinvoiceupdateitemqty($item_id,$item_chef_id,$update_qty,$customer_user_id,$order_query,$order_item_query); 	
						}						
					}
					$this->Emailsend($item_chef_id,$customer_user_id,$order_query,$order_items);
				}
				
				return $this->redirect(['view', 'id' =>$model->id,'paysucess'=>1]);
			}
		}

	}
	
	
	public function actionPaypalorderfailer()
    {
		return $this->render('paypalorderFailer', [
			// 'order_array' => $_SESSION['order_array'],
		]);
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
