<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'verification_token' => $this->string()->defaultValue(null),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => 'timestamp without time zone NOT NULL DEFAULT NOW()',
            'updated_at' => 'timestamp without time zone NOT NULL DEFAULT NOW()',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
