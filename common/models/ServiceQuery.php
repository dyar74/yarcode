<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Service]].
 *
 * @see Service
 */
class ServiceQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => Service::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     * @return Service[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Service|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
