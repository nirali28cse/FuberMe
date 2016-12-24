<?php

namespace app\modules\users\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\users\models\Userdetail;

/**
 * UserdetailSearch represents the model behind the search form about `app\modules\users\models\Userdetail`.
 */
class UserdetailSearch extends Userdetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['mobile_number','username', 'password', 'email_id', 'auth_key', 'date_time'], 'safe'],
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
        $query = Userdetail::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,         
            'status' => $this->status,
            'user_type' => $this->user_type,
          
           
        ]);

        $query->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email_id', $this->email_id])
            ->andFilterWhere(['like', '	username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'user_type', $this->user_type]);
            // ->orFilterWhere(['like', 'user_type', 3]);

        return $dataProvider;
    }
}
