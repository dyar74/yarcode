<?php

use yii\db\Migration;

/**
 * Handles the creation for table `portfolio_detail`.
 * Has foreign keys to the tables:
 *
 * - `portfolio`
 */
class m160908_132241_create_portfolio_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('portfolio_detail', [
            'id' => $this->primaryKey(),
            'portfolio_id' => $this->integer(11)->notNull(),
            'name' => $this->string(100)->notNull(),
            'description' => $this->text(),
            'date' => $this->date(),
            'client' => $this->string(100),
            'category' => $this->string(100),
        ]);

        // creates index for column `portfolio_id`
        $this->createIndex(
            'idx-portfolio_detail-portfolio_id',
            'portfolio_detail',
            'portfolio_id'
        );

        // add foreign key for table `portfolio`
        $this->addForeignKey(
            'fk-portfolio_detail-portfolio_id',
            'portfolio_detail',
            'portfolio_id',
            'portfolio',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `portfolio`
        $this->dropForeignKey(
            'fk-portfolio_detail-portfolio_id',
            'portfolio_detail'
        );

        // drops index for column `portfolio_id`
        $this->dropIndex(
            'idx-portfolio_detail-portfolio_id',
            'portfolio_detail'
        );

        $this->dropTable('portfolio_detail');
    }
}
