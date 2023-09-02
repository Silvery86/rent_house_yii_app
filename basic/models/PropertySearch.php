<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Property;

/**
 * PropertySearch represents the model behind the search form of `app\models\Property`.
 */
class PropertySearch extends Property
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['propertyID', 'bedrooms', 'bathrooms', 'squareFootage'], 'integer'],
            [['address', 'amenities', 'availabilityStatus', 'propertyType'], 'safe'],
            [['monthlyRent', 'deposit'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Property::find();

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
            'propertyID' => $this->propertyID,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'squareFootage' => $this->squareFootage,
            'monthlyRent' => $this->monthlyRent,
            'deposit' => $this->deposit,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'amenities', $this->amenities])
            ->andFilterWhere(['like', 'availabilityStatus', $this->availabilityStatus])
            ->andFilterWhere(['like', 'propertyType', $this->propertyType]);

        return $dataProvider;
    }
}
