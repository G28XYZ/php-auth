<?php
session_start();
?>
<?php
  $token = $_COOKIE['jwt'] ?? '';
  if($token) {
    $res = $this->auth->verifyToken($token);
    if(isset($res['payload'])) {
      $this->user->setUser($res['payload']);
      $this->auth->isAuth = true;
    }
  }

  if(isset($_GET['logout'])) {
    setcookie('jwt', '');
    header("Location: /?login=1");
  }

  ?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/style.css">
  <script src='../scripts/logout.js' defer></script>
  <script src='../scripts/timer.js' defer></script>
  <script src='../scripts/editMessage.js' defer></script>
  <title>Auth</title>
</head>

<body>
  <div class='page'>
    <header class='header'>
      <h1 class='header__title'>Messenger</h1>
      <?php 
        if($this->auth->isAuth) {
          ?>
      <div class='header__logout'>
        <button class='header__button header__button_logout'>🚪⇤</button>
        <p>Привет <?php echo $this->user->full_name ?>!</p>
      </div>
      <?php 
        }
        ?>
    </header>
    <main class='main'>
      <?php $this->auth->isAuth && include __DIR__ . '/posts.php' ?>
      <section class='auth'>
        <?php
      if($this->auth->isAuth === false) {
        ?>
        <?php !($_GET['login'] ?? '') && include __DIR__ . '/registerForm.php' ?>
        <?php ($_GET['login'] ?? '') && include __DIR__ . '/loginForm.php' ?>
        <?php
      }
      ?>
      </section>
    </main>
  </div>
</body>

</html>