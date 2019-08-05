<?php
require_once 'config.php';
require_once 'templates/header.php';
require_once 'templates/form.php';


if (!empty($_POST)) {
    newPost($_POST);
}


function dbConnect() {
//    error_reporting(0);
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_BASE);
    if ($db) return $db;

    echo 'DATABASE CONNECTION ERROR';
    die();
}


function getPosts() {
    $db = dbConnect();
    $sql = "SELECT author, text FROM posts ORDER BY id DESC";
    $posts = $db->query($sql)->fetch_all(1);
    return $posts;
}


function newPost($request) {
    $db = dbConnect();
    $post = [];
    $post['author'] = $db->real_escape_string($request['author']);
    $post['text'] = $db->real_escape_string($request['text']);

    $sql = "INSERT INTO posts(author, text) VALUES('{$post['author']}', '{$post['text']}')";
    $db->query($sql);
}


$posts = getPosts();
array_reverse($posts);
echo '<h3>Предыдущие записи:</h3>';
foreach ($posts as $post): ?>

    <div class="card mb-4">
        <div class="card-header">
            <?= $post['author'] ?>
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p><?= $post['text'] ?></p>
            </blockquote>
        </div>
    </div>

<?php
endforeach;

require_once 'templates/footer.php';