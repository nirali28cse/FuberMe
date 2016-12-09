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
            [['id', 'chef_user_id', 'item_category_info_id', 'item_cuisine_type_info_id', 'status'], 'integer'],
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
            'chef_user_id' => $this->chef_user_id,
            'item_category_info_id' => $this->item_category_info_id,
            'item_cuisine_type_info_id' => $this->item_cuisine_type_info_id,
            'date_time' => $this->date_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['=', 'chef_user_id',Yii::$app->user->id])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'ingredients', $this->ingredients])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'delivery_method', $this->delivery_method])
            ->andFilterWhere(['like', 'head_up_time', $this->head_up_time])
            ->andFilterWhere(['like', 'availability_from_date', $this->availability_from_date])
            ->andFilterWhere(['like', 'availability_from_date', $this->availability_from_date])
            ->andFilterWhere(['like', 'availability_from_time', $this->availability_to_date])
            ->andFilterWhere(['like', 'availability_to_time', $this->availability_to_date]);

        return $dataProvider;
    }
}
