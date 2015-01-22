<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form about `app\models\Category`.
 */
class CategorySearch extends Category {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['uuid', 'categoryname', 'tenderuuid'], 'safe'],
            [['categorynumber'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params, $id) {
        $query = Category::find("tenderuuid = '$id'");
        $query->andFilterWhere(['=', 'tenderuuid', $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'categorynumber' => $this->categorynumber,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
                ->andFilterWhere(['like', 'categoryname', $this->categoryname])
                ->andFilterWhere(['=', 'tenderuuid', $id]);

        return $dataProvider;
    }

}