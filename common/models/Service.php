<?php

namespace common\models;

use Yii;
use common\components\ActiveRecord;
use yarcode\base\behaviors\TimestampBehavior;
use yarcode\base\traits\StatusTrait;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $icon
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
  * @mixin TimestampBehavior
 */
class Service extends ActiveRecord
{
    /**
     * @inheritdoc
     */

    use StatusTrait;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return '{{%service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'icon'], 'required'],
            [['text'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'icon'], 'string', 'max' => 100],
        ];
    }
    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'icon' => Yii::t('app', 'Icon'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
         //   'status' => Yii::t('app', 'Status'),
        ];
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['ts'] = [
            'class' => 'yarcode\base\behaviors\TimestampBehavior',
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => 'updated_at',
        ];
        return $behaviors;
    }

    public static function getStatusLabels()
    {
        return [
            static::STATUS_ACTIVE => 'Active',
            static::STATUS_INACTIVE => 'Inactive',
        ];
    }

    public static function find()
    {
        return new ServiceQuery(get_called_class());
    }

    public static function getServices(){
        return  self::find()->active()->all();
    }
}
