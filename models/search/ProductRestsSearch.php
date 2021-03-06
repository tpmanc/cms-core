<?php

namespace tpmanc\cmscore\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use tpmanc\cmscore\models\ProductRests;

/**
 * ProductRestsSearch represents the model behind the search form about `tpmanc\cmscore\models\ProductRests`.
 */
class ProductRestsSearch extends ProductRests
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productId', 'amount'], 'integer'],
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
        $query = ProductRests::find();

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
            'productId' => $this->productId,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
