<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemInfo;

/**
 * ItemInfoSearch represents the model behind the search form about `app\models\ItemInfo`.
 */
class ItemInfoLiveSearch extends ItemInfo
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
		

		$page_number=0;
		if(isset($_GET['page'])) $page_number=$_GET['page'];

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
		//	'pagination' => array('pageSize' =>Yii::$app->params['pagination_item_count']),
			'pagination' => array('pageSize' =>Yii::$app->params['pagination_item_count'],'page' =>$page_number),
		//	'pagination' => false,
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
		$search_by_item=$this->name;
		
		if(isset($_SESSION['filetrsarray'])){
			
			$min_price=0;
			$max_price=0;
			
			
			if($_SESSION['filetrsarray']['search_by_item']!=null){
				$search_by_item=$_SESSION['filetrsarray']['search_by_item'];
			}
			
			if($_SESSION['filetrsarray']['cusion_array']!=null){
				$categ_array=$_SESSION['filetrsarray']['categ_array'];
				$query->andFilterWhere(['in','item_category_info_id',$categ_array]);	
			}else{
				$query->andFilterWhere(['=', 'item_category_info_id',$this->item_category_info_id]);
			}	
					
					
			if($_SESSION['filetrsarray']['cusion_array']!=null){
				$cusion_array=$_SESSION['filetrsarray']['cusion_array'];
				$query->andFilterWhere(['in','item_cuisine_type_info_id',$cusion_array]);	
			}else{
				$query->andFilterWhere(['=', 'item_cuisine_type_info_id',$this->item_cuisine_type_info_id]);
			}	
						
			if($_SESSION['filetrsarray']['dieta_array']!=null){
				$dieta_array=$_SESSION['filetrsarray']['dieta_array'];
				$query->andFilterWhere(['in','item_dietary_preference',$dieta_array]);	
			}else{
				$query->andFilterWhere(['=', 'item_dietary_preference',$this->item_dietary_preference]);
			}	
			
			
			if($_SESSION['filetrsarray']['min_price']>0 and $_SESSION['filetrsarray']['max_price']>0){
				$min_price=$_SESSION['filetrsarray']['min_price'];
				$max_price=$_SESSION['filetrsarray']['max_price'];
 				$query->andFilterWhere(['AND',
								['>=', 'price', $min_price],
							 	['<=', 'price', $max_price]
								]);		
			//	$query->andFilterWhere(['between','price',$min_price,$max_price]);									
			}	
			
			if($_SESSION['filetrsarray']['min_location']>0 and $_SESSION['filetrsarray']['max_location']>0){
				$min_location=$_SESSION['filetrsarray']['min_location'];
				$max_location=$_SESSION['filetrsarray']['max_location'];
				$chef_array=$_SESSION['filetrsarray']['chef_array'];
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
		


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        //    'chef_user_id' => $this->chef_user_id,
/*             'item_category_info_id' => $item_category_info_id,
            'item_cuisine_type_info_id' => $item_cuisine_type_info_id,
            'item_dietary_preference' => $item_dietary_preference, */
            'date_time' => $this->date_time,
            'status' => $this->status,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'name',$search_by_item])
            ->andFilterWhere(['like', 'ingredients', $this->ingredients])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'head_up_time', $this->head_up_time])
            ->andFilterWhere(['like', 'availability_from_time', $this->availability_from_time])
            ->andFilterWhere(['like', 'availability_to_time', $this->availability_to_time]);
		
			$query->andFilterWhere(['=','status',1]);	
 			$query->andFilterWhere(['AND',
								['<=', 'availability_from_date',Yii::$app->params['today_date']],
							 	['>=', 'availability_to_date',Yii::$app->params['today_date']]
								]); 

/*  echo '<pre>';
print_r($query);
exit;    */
 
		$query->orderBy(['(status)' => SORT_DESC]);

        return $dataProvider;
    }
}
