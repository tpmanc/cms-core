<?php

namespace tpmanc\cmscore\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use tpmanc\cmscore\models\Product;

/**
 * ProductSearch represents the model behind the search form about `tpmanc\cmscore\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'netCost', 'price', 'discountPrice', 'fakeInStock', 'isDisabled', 'isNew', 'isBest'], 'integer'],
            [['title', 'description', 'shortDescription', 'nomenclature', 'seoTitle', 'seoDescription', 'seoKeywords', 'chpu'], 'safe'],
            [['length', 'width', 'height', 'weight'], 'number'],
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
        $query = Product::find();

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
            'netCost' => $this->netCost,
            'price' => $this->price,
            'discountPrice' => $this->discountPrice,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'weight' => $this->weight,
            'fakeInStock' => $this->fakeInStock,
            'isDisabled' => $this->isDisabled,
            'isNew' => $this->isNew,
            'isBest' => $this->isBest,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'shortDescription', $this->shortDescription])
            ->andFilterWhere(['like', 'nomenclature', $this->nomenclature])
            ->andFilterWhere(['like', 'seoTitle', $this->seoTitle])
            ->andFilterWhere(['like', 'seoDescription', $this->seoDescription])
            ->andFilterWhere(['like', 'seoKeywords', $this->seoKeywords])
            ->andFilterWhere(['like', 'chpu', $this->chpu]);

        return $dataProvider;
    }
}
