<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Biddercategory;

/**
 * BiddercategorySearch represents the model behind the search form about `app\models\Biddercategory`.
 */
class BiddercategorySearch extends Biddercategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid', 'categoryuuid', 'bidderuuid', 'creationtime', 'pesapalpaymentuuid', 'bankpaymentuuid'], 'safe'],
            [['paid'], 'integer'],
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
        $query = Biddercategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'creationtime' => $this->creationtime,
            'paid' => $this->paid,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'categoryuuid', $this->categoryuuid])
            ->andFilterWhere(['like', 'bidderuuid', $this->bidderuuid])
            ->andFilterWhere(['like', 'pesapalpaymentuuid', $this->pesapalpaymentuuid])
            ->andFilterWhere(['like', 'bankpaymentuuid', $this->bankpaymentuuid]);

        return $dataProvider;
    }
}
