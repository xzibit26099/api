<?php

use yii\db\Migration;

class m200414_160839_create_address extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%address}}', [
            'id' => $this->primaryKey(),
            'street' => $this->string(128),
            'zip' => $this->string(64),
            'user_id' => $this->integer()->notNull(),
            'created_at' => 'timestamp without time zone NOT NULL DEFAULT NOW()',
            'updated_at' => 'timestamp without time zone NOT NULL DEFAULT NOW()',
        ]);

        $this->createIndex('IDX_address_user_id', '{{%address}}', 'user_id');
    }

    public function safeDown()
    {
        $this->dropIndex('IDX_address_user_id', '{{%address}}');
        $this->dropTable('{{%address}}');
    }
}
