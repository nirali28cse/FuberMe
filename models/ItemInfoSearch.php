<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemInfo;

/**
 * ItemInfoSearch represents the model behind the search form about `app\models\ItemInfo`.
 */
class ItemInfoSearch extends ItemInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'chef_user_id', 'quantity', 'item_category_info_id', 'item_cuisine_type_info_id', 'status'], 'integer'],
            [['name', 'price', 'ingredients', 'description', 'delivery_method', 'head_up_time', 'availability_from_date', 'availability_to_date', 'availability_from_time', 'availability_to_time', 'date_time'], 'safe'],
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
        $query = ItemInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => [
/* 				'defaultOrder' => [
					'price' => SORT_DESC,
					'id' => SORT_DESC,
				],  */
				'attributes' => [
					'price' => [
						'asc' => [
							'price' => SORT_ASC, 
						],
						'desc' => [
							'price' => SORT_DESC,
						],
					],		
/* 					'item_cuisine_type_info_id' => [
						'asc' => [
							'item_cuisine_type_info_id' => SORT_ASC, 
						],
						'desc' => [
							'item_cuisine_type_info_id' => SORT_DESC,
						],
					],		 */			
				],
			],
        ]);
		
		

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		
		
		$item_category_info_id=$this->item_category_info_id;
		$item_cuisine_type_info_id=$this->item_cuisine_type_info_id;
		if(isset($_SESSION['filetrsarray'])){
			
			$min_price=0;
			$max_price=0;
			if($_SESSION['filetrsarray']['cusion']>0){
				$item_cuisine_type_info_id=$_SESSION['filetrsarray']['cusion'];
			}	
			
			if($_SESSION['filetrsarray']['price']>0){
				$price=$_SESSION['filetrsarray']['price'];
				if($price==75){ $min_price=75; $max_price=100; }
				if($price==57){ $min_price=50; $max_price=75; }
				if($price==25){ $min_price=25; $max_price=50; }
				if($price==02){ $min_price=5; $max_price=25; }
				$query->andFilterWhere(['between', 'price', $min_price, $max_price]);	
			}							
		}else{
			$query->andFilterWhere(['like', 'price', $this->price]);
		}

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'chef_user_id' => $this->chef_user_id,
            'item_category_info_id' => $item_category_info_id,
            'item_cuisine_type_info_id' => $item_cuisine_type_info_id,
            'date_time' => $this->date_time,
            'status' => $this->status,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['=', 'chef_user_id',$this->chef_user_id])
    //        ->andFilterWhere(['>', 'quantity',0])
            ->andFilterWhere(['like', 'ingredients', $this->ingredients])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'delivery_method', $this->delivery_method])
            ->andFilterWhere(['like', 'head_up_time', $this->head_up_time])
            ->andFilterWhere(['like', 'availability_from_date', $this->availability_from_date])
            ->andFilterWhere(['like', 'availability_from_date', $this->availability_from_date])
            ->andFilterWhere(['like', 'availability_from_time', $this->availability_to_date])
            ->andFilterWhere(['like', 'availability_to_time', $this->availability_to_date]);
	

		$query->orderBy(['(status)' => SORT_DESC]);
		
        return $dataProvider;
    }
}
