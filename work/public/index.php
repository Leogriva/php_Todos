<?php

require_once(__DIR__ . '/../app/config.php');

use MyApp\Database;
use MyApp\Todo;
use MyApp\Utils;
//getPdoInstance();の returnした値を代入している。 $pdoである必要はなく$aaaとかでも良い
$pdo = Database::getInstance();

$todo = new Todo($pdo);
$todo->processPost();
$todos = $todo->getAll();


?>

<!--------------------------------- html ------------------------------->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

  <main>
    <header>
    <h1>Todos</h1>

      <form action="?action=delete" method="post" class="delete-form">
        <span class="delete">x</span>
        <input type="hidden" name="id" value="<?= Utils::h($todo->id); ?>">
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
      </form>
    </header>

    <form action="?action=add" method="post">
    <input type="text" name="title" placeholder="Type new todo.">
    <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">

    <!-- <button>Add</button> formの中に text型１つのときは enterだけで送信できる -->

    </form>

    <ul>
    <?php foreach ($todos as $todo): ?>
      <li>

      <form action="?action=toggle" method="post">
        <input type="checkbox" <?= $todo->is_done ? 'checked' : ''; ?>>
        <input type="hidden" name="id" value="<?= Utils::h($todo->id); ?>">
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
      </form>

        <span class="<?= $todo->is_done ? 'done' : ''; ?> " >
        <?= Utils::h($todo->title); ?>
        </span>

        <form action="?action=delete" method="post" class="delete-form">
        <span class="delete">x</span>
        <input type="hidden" name="id" value="<?= Utils::h($todo->id); ?>">
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
      </form>

      </li>
      <?php endforeach ;?>
    </ul>
  </main>

  <script src="js/main.js"></script>
</body>
</html>