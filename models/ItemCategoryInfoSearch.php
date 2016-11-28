<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemCategoryInfo;

/**
 * ItemCategoryInfoSearch represents the model behind the search form about `app\models\ItemCategoryInfo`.
 */
class ItemCategoryInfoSearch extends ItemCategoryInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'chef_user_id', 'parent_id', 'status'], 'integer'],
            [['name', 'date_time'], 'safe'],
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
        $query = ItemCategoryInfo::find();

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
            'chef_user_id' => Yii::$app->user->id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'date_time' => $this->date_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
