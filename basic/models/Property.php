<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "property".
 *
 * @property int $propertyID
 * @property string|null $address
 * @property int|null $bedrooms
 * @property int|null $bathrooms
 * @property int|null $squareFootage
 * @property string|null $amenities
 * @property float|null $monthlyRent
 * @property float|null $deposit
 * @property string|null $availabilityStatus
 * @property string|null $propertyType
 *
 * @property Picture[] $pictures
 */
class Property extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['propertyID'], 'required'],
            [['propertyID', 'bedrooms', 'bathrooms', 'squareFootage'], 'integer'],
            [['monthlyRent', 'deposit'], 'number'],
            [['address', 'amenities'], 'string', 'max' => 255],
            [['availabilityStatus'], 'string', 'max' => 20],
            [['propertyType'], 'string', 'max' => 50],
            [['propertyID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'propertyID' => 'Property ID',
            'address' => 'Address',
            'bedrooms' => 'Bedrooms',
            'bathrooms' => 'Bathrooms',
            'squareFootage' => 'Square Footage',
            'amenities' => 'Amenities',
            'monthlyRent' => 'Monthly Rent',
            'deposit' => 'Deposit',
            'availabilityStatus' => 'Availability Status',
            'propertyType' => 'Property Type',
        ];
    }

    /**
     * Gets query for [[Pictures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(Picture::class, ['propertyID' => 'propertyID']);
    }
}
