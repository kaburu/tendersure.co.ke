<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bankpayment;

/**
 * BankpaymentSearch represents the model behind the search form about `app\models\Bankpayment`.
 */
class BankpaymentSearch extends Bankpayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid', 'bankuuid', 'receiptno', 'datepaid', 'creationdate', 'filename', 'bidderuuid'], 'safe'],
            [['amount'], 'integer'],
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
        $query = Bankpayment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'amount' => $this->amount,
            'datepaid' => $this->datepaid,
            'creationdate' => $this->creationdate,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'bankuuid', $this->bankuuid])
            ->andFilterWhere(['like', 'receiptno', $this->receiptno])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'bidderuuid', Yii::$app->user->id]);

        return $dataProvider;
    }
}
