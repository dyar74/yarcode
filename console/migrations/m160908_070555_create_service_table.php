<?php

use yii\db\Migration;

/**
 * Handles the creation for table `service`.
 */
class m160908_070555_create_service_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'text' => $this->text()->notNull(),
            'icon' => $this->string(100)->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'status' => $this->status()->int(11)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('service');
    }
}
