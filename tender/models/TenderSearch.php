<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tender;

/**
 * TenderSearch represents the model behind the search form about `app\models\Tender`.
 */
class TenderSearch extends Tender
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid', 'tenderowneruuid', 'contact', 'tendername', 'opendate', 'opentime', 'closedate', 'closetime', 'description'], 'safe'],
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
        $query = Tender::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'opendate' => $this->opendate,
            'opentime' => $this->opentime,
            'closedate' => $this->closedate,
            'closetime' => $this->closetime,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'tenderowneruuid', $this->tenderowneruuid])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'tendername', $this->tendername])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
