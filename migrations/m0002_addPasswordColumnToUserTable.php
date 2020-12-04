<?php

class m0002_addPasswordColumnToUserTable {
    public function up()
    {
        $db = \Okami\Core\App::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;");
    }

    public function down()
    {
        $db = \Okami\Core\App::$app->db;
        $db->pdo->exec("ALTER TABLE users DROP COLUMN password;");
    }
}