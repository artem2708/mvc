<?php
/* @var $posts array */

?>

<h1 class="header">Статьи</h1>
<?php foreach ($posts as $post):?>
    <p>Назвавние статьи : <a href="/main/article/<?= $post['id'] ?>"><?= $post['title'] ?></a></p>
    <p>Текст статьи : <?= $post['text'] ?></p>
<?php endforeach;?>
