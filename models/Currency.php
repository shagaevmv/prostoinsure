<?php

namespace app\models;
use app\dto\CurrencyDTO;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%article}}".
 * @property integer $id
 * @property string $name
 * @property float $rate
 * @property integer $created_at
 * @property integer $updated_at
 */
class Currency extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%currency}}';
    }

    /**
     * @return array[][]
     */
    public function rules(): array
    {
        return [
            [['name', 'rate'], 'required'],
            ['name', 'string'],
            ['rate', 'number'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @return array[][]
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'timestamp' => [
                    'class' => TimestampBehavior::class,
                    'value' => new Expression('NOW()'),
                ],
            ]
        );
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'rate' => Yii::t('app', 'Rate'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
