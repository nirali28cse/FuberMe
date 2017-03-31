<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderInfo;
use app\models\OrderItemInfo;
/**
 * OrderInfoSearch represents the model behind the search form about `app\models\OrderInfo`.
 */
class OrderInfoSearch extends OrderInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'order_status'], 'integer'],
            [['order_number', 'final_amount', 'total_amount', 'customer_name', 'customer_email', 'customer_mobile_no', 'customer_address', 'customer_city', 'customer_state', 'customer_zip', 'delivery_method', 'payment_method', 'tax_in_percent', 'order_notes', 'order_date_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

		if((Yii::$app->controller->action->id=='index' or Yii::$app->controller->action->id=='index2') and (Yii::$app->user->identity->user_type=2 or Yii::$app->user->identity->user_type=3)){
		//	$query = OrderInfo::find()->joinWith(['orderItemInfo.itemInfo'=>function ($query) {  $query->Where(['orderItemInfo.item_chef_user_id'=>Yii::$app->user->id]); } ]);		  
			
			$query = OrderInfo::find()->joinWith(['orderItemInfo.itemInfo'=>function ($query) { 
			$query->Where(['chef_user_id'=>Yii::$app->user->id]);
			},'orderItemInfo.chefInfo'=>function ($query) { 
			// $query->Where(['chef_user_id'=>Yii::$app->user->id]);
			} ]);
			
		}else{
			$query = OrderInfo::find();
		}

		
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => array('pageSize' =>10),				
			'sort' => [
				'attributes' => [
					'delivery_method' => [
						'asc' => ['delivery_method' => SORT_ASC, 'order_number' => SORT_DESC],
						'desc' => ['delivery_method' => SORT_DESC, 'order_number' => SORT_ASC],
					],	
					'invoice_item' => [
						'asc' => ['item_info.name' => SORT_ASC],
						'desc' => ['item_info.name' => SORT_DESC],
					],	
					'customer' => [
						'asc' => ['users.username' => SORT_ASC, 'users.address' => SORT_ASC],
						'desc' => ['users.username' => SORT_DESC, 'users.address' => SORT_DESC],
					],		
					'chef_name' => [
						'asc' => ['users.username' => SORT_ASC, 'users.address' => SORT_ASC],
						'desc' => ['users.username' => SORT_DESC, 'users.address' => SORT_DESC],
					],		

					'order_number',
					'final_amount',
					'payment_method',
					'order_status',
					'order_date_time',
				],
				'defaultOrder'=>'order_date_time DESC',
			],	
					
			
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'order_status' => $this->order_status,
            'order_date_time' => $this->order_date_time,
        ]);

		if(Yii::$app->controller->action->id=='index2' and (Yii::$app->user->identity->user_type=1 or Yii::$app->user->identity->user_type=3)){
			 $query->andFilterWhere(['=', 'user_id',Yii::$app->user->id]);
		}
		
        $query->andFilterWhere(['like', 'order_number', $this->order_number])
            ->andFilterWhere(['like', 'final_amount', $this->final_amount])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'customer_email', $this->customer_email])
            ->andFilterWhere(['like', 'customer_mobile_no', $this->customer_mobile_no])
            ->andFilterWhere(['like', 'customer_address', $this->customer_address])
            ->andFilterWhere(['like', 'customer_city', $this->customer_city])
            ->andFilterWhere(['like', 'customer_state', $this->customer_state])
            ->andFilterWhere(['like', 'customer_zip', $this->customer_zip])
            ->andFilterWhere(['like', 'delivery_method', $this->delivery_method])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'tax_in_percent', $this->tax_in_percent])
            ->andFilterWhere(['like', 'order_notes', $this->order_notes]);
			
/* 		if(!isset($_GET['sort'])){
			$query->orderBy(['(order_date_time)' => SORT_DESC]);
		} */	
		

        return $dataProvider;
    }

}
