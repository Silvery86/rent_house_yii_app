<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property int $pictureID
 * @property int|null $propertyID
 * @property string|null $imageURL
 * @property string|null $caption
 *
 * @property Property $property
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageURL', 'caption'], 'required'],
            [['pictureID', 'propertyID'], 'integer'],
            [['imageURL', 'caption'], 'string', 'max' => 255],
            [['pictureID'], 'unique'],
            [['propertyID'], 'exist', 'skipOnError' => true, 'targetClass' => Property::class, 'targetAttribute' => ['propertyID' => 'propertyID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pictureID' => 'Picture ID',
            'propertyID' => 'Property ID',
            'imageURL' => 'Image Url',
            'caption' => 'Caption',
        ];
    }

    /**
     * Gets query for [[Property]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::class, ['propertyID' => 'propertyID']);
    }

    public static function getImagePathsByPropertyID($propertyID)
    {
        $pictures = self::findAll(['propertyID' => $propertyID]);
        $imagePaths = [];

        foreach ($pictures as $picture) {
            $basePath = Yii::getAlias('@app/web/uploads/');
            $imageFileName = $picture->imageURL; 
            $imagePaths[] = $basePath . $imageFileName;
        }

        return $imagePaths;
    }
}
