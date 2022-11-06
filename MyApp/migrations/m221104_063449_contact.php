<?php

use yii\db\Migration;

/**
 * Class m221104_063449_contact
 */
class m221104_063449_contact extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'title' => $this->string(12)->unique(),
            'content' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221104_063449_contact cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221104_063449_contact cannot be reverted.\n";

        return false;
    }
    */
}
