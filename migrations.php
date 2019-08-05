<?php
require_once 'config.php';

up();

function up() {
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_BASE);

    $sql = "CREATE TABLE IF NOT EXISTS posts (
            id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            author VARCHAR(30) NOT NULL DEFAULT '',
            text VARCHAR(255) NOT NULL DEFAULT ''
            )";

    $db->query($sql);
}