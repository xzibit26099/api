<?php

use yii\db\Migration;

/**
 * Class m200419_073954_insert_user
 */
class m200419_073954_insert_user extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'username' => 'test',
            'auth_key' => 'VtrqofjNANtSLVQMSjI51Jecb4b1gavF',
            'password_hash' => '$2y$13$BP36cWe/ssp3Yll86DnDxO7lJMUHbhM.qkLjFEONKeciK8kAQOFMi', // 121212
            'password_reset_token' => null,
            'email' => 'test@mail.ru',
            'verification_token' => 'aKOn_UlQzQbuuGUxoIfHlCa04R7jAxKN_1586872346',
            'status' => 10,
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'test']);
    }
}
