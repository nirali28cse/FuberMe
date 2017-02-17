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
            [['name', 'price', 'ingredients', 'description','head_up_time', 'availability_from_date', 'availability_to_date', 'availability_from_time', 'availability_to_time', 'date_time'], 'safe'],
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
		$item_dietary_preference=$this->item_dietary_preference;
		if(isset($_SESSION['filetrsarray'])){
			
			$min_price=0;
			$max_price=0;
			if($_SESSION['filetrsarray']['cusion']>0){
				$item_cuisine_type_info_id=$_SESSION['filetrsarray']['cusion'];
			}	
					
			if($_SESSION['filetrsarray']['dieta']>0){
				$item_dietary_preference=$_SESSION['filetrsarray']['dieta'];
			}	
			
			if($_SESSION['filetrsarray']['price']>0){
				$price=$_SESSION['filetrsarray']['price'];
				if($price==75){ $min_price=75; $max_price=100; }
				if($price==57){ $min_price=50; $max_price=75; }
				if($price==25){ $min_price=25; $max_price=50; }
				if($price==02){ $min_price=5; $max_price=25; }
				$query->andFilterWhere(['between', 'price', $min_price, $max_price]);	
			}	
			
			if($_SESSION['filetrsarray']['min_price']>0 and $_SESSION['filetrsarray']['max_price']>0){
				$min_price=$_SESSION['filetrsarray']['min_price'];
				$max_price=$_SESSION['filetrsarray']['max_price'];
				$query->andFilterWhere(['between', 'price', $min_price, $max_price]);	
			}	
			
			if($_SESSION['filetrsarray']['min_location']>0 and $_SESSION['filetrsarray']['max_location']>0){
				$min_location=$_SESSION['filetrsarray']['min_location'];
				$max_location=$_SESSION['filetrsarray']['max_location'];
				$chef_array=$_SESSION['filetrsarray']['chef_array'];
				// $query->andFilterWhere(['in','chef_user_id',$chef_array]);	
				if($chef_array!=null){
					foreach($chef_array as $key => $value) {
							$query->orFilterWhere(['=', 'chef_user_id', $value]);
					}
				}else{
					$query->andFilterWhere(['=', 'chef_user_id',0]);
				}
			}else{
				$query->andFilterWhere(['=', 'chef_user_id',$this->chef_user_id]);
			}				
		}else{
			$query->andFilterWhere(['like', 'price', $this->price]);
			$query->andFilterWhere(['=', 'chef_user_id',$this->chef_user_id]);
		}
		



/* 		if(Yii::$app->controller->action->id=='conhome'){
			if($this->status==1){ $_GET['liveitem']=1; }
			if($this->status==0){ $_GET['offlineitem']=1; }
		} */

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        //    'chef_user_id' => $this->chef_user_id,
            'item_category_info_id' => $item_category_info_id,
            'item_cuisine_type_info_id' => $item_cuisine_type_info_id,
            'item_dietary_preference' => $item_dietary_preference,
            'date_time' => $this->date_time,
            'status' => $this->status,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
       //     ->andFilterWhere(['=', 'chef_user_id',$this->chef_user_id])
    //        ->andFilterWhere(['>', 'quantity',0])
            ->andFilterWhere(['like', 'ingredients', $this->ingredients])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'head_up_time', $this->head_up_time])
       //     ->andFilterWhere(['like', 'availability_from_date', $this->availability_from_date])
            ->andFilterWhere(['like', 'availability_from_time', $this->availability_from_time])
            ->andFilterWhere(['like', 'availability_to_time', $this->availability_to_time]);
		
	//	$query->andFilterWhere(['=','status',$this->status]);
	
/* 		if(isset($_GET['liveitem']) and $_GET['liveitem']==1){			
			$query->andFilterWhere(['<=', 'availability_from_date', date('Y-m-d')])
				  ->andFilterWhere(['>=', 'availability_to_date', date('Y-m-d')]);
		}
		
		if(isset($_GET['offlineitem']) and $_GET['offlineitem']==1){		
			$query->andFilterWhere(['>=', 'availability_from_date', date('Y-m-d')])
				  ->orFilterWhere(['<=', 'availability_to_date', date('Y-m-d')]);
		} */

/*   echo '<pre>';
print_r($query);
exit;   */
		$query->orderBy(['(status)' => SORT_DESC]);

        return $dataProvider;
    }
}
