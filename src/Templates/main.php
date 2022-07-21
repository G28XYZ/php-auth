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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src='../scripts/logout.js' defer></script>
  <script src='../scripts/timer.js' defer></script>
  <script src='../scripts/editMessage.js' defer></script>
  <title>Auth</title>
</head>

<body>
  <div class='page'>
    <header class='header'>
      <h1 class='header__title position-relative'>Messenger
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          99+
        </span>
      </h1>
      <?php 
        if($this->auth->isAuth) {
          ?>
      <div class='header__logout'>
        <button class='btn btn-outline-secondary header__button header__button_logout'>🚪⇤</button>
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