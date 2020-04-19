<?php

use yii\db\Migration;


class m200414_161507_create_token extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string()->notNull()->unique(),
            'expired_at' => 'timestamp without time zone NOT NULL DEFAULT NOW()',
        ]);

        $this->createIndex('IDX_token_user_id', '{{%token}}', 'user_id');
        $this->createIndex('IDX_token_token', '{{%token}}', 'token');
    }

    public function safeDown()
    {
        $this->dropIndex('IDX_token_user_id', '{{%token}}');
        $this->dropIndex('IDX_token_token', '{{%token}}');
        $this->dropTable('{{%token}}');
    }
}
