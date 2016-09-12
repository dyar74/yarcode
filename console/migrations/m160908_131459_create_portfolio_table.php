<?php

use yii\db\Migration;

/**
 * Handles the creation for table `portfolio`.
 */
class m160908_131459_create_portfolio_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('portfolio', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'image' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'date' => $this->string(),
            'client' => $this->string(),
            'category' => $this->string()->notNull(),
            'display_order' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'status' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('portfolio');
    }
}
