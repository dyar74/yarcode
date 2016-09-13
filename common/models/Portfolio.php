<?php

namespace common\models;

use Yii;
use common\components\ActiveRecord;
use yarcode\base\behaviors\TimestampBehavior;
use yarcode\base\traits\StatusTrait;
use yarcode\base\traits\CarbonModelTrait;

/**
 * This is the model class for table "{{%portfolio}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string $client
 * @property string $category
 * @property integer $display_order
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Portfolio extends \yii\db\ActiveRecord
{

    use StatusTrait;
    use CarbonModelTrait;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%portfolio}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title',  'name', 'category', 'display_order'], 'required'],
            [['description'], 'string'],
            [['image'] , 'required', 'on'=>'create'],
            ['image', 'file','skipOnEmpty' => true, 'on'=>'update',  'extensions' => 'jpeg, gif, png'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['display_order', 'status'], 'integer'],
            [['title', 'name', 'client', 'category'], 'string', 'max' => 255],
            ['date', 'date', 'format'=>'yyyy/mm/dd']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'date' => Yii::t('app', 'Date'),
            'client' => Yii::t('app', 'Client'),
            'category' => Yii::t('app', 'Category'),
            'display_order' => Yii::t('app', 'Display Order'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
           // 'status' => Yii::t('app', 'Status'),
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [

            'class' => 'yarcode\base\behaviors\TimestampBehavior',
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => 'updated_at',
        ];
        $behaviors[] = [
            'class' => '\yiidreamteam\upload\ImageUploadBehavior',
            'attribute' => 'image',
            'thumbs' => [
                'thumb' => ['width' => 400, 'height' => 300],
            ],
            'filePath' => Yii::getAlias('@frontend') .'/web/img/portfolio/[[pk]].[[extension]]',
            'fileUrl' =>  Yii::$app->params['frontend_base_url'] . '/img/portfolio/[[pk]].[[extension]]',
            'thumbPath' => Yii::getAlias('@frontend') .'/web/img/portfolio/[[profile]]_[[pk]].[[extension]]',
            'thumbUrl' =>  Yii::$app->params['frontend_base_url'] . '/img/portfolio/[[profile]]_[[pk]].[[extension]]',
        ];
        return $behaviors;
    }
    public static function getStatusLabels()
    {
        return [
            static::STATUS_ACTIVE => 'Active',
            static::STATUS_NEW => 'Inactive',
        ];
    }
    /**
     * @inheritdoc
     * @return PortfolioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PortfolioQuery(get_called_class());
    }
    public static function getPortfolios(){
        return  self::find()->active()->orderBy('display_order')->all();
    }

}
