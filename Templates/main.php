<?php
session_start();
?>
<?php
  $token = $_COOKIE['jwt'] ?? '';
  if($token) {
    $res = $this->data['auth']->verifyToken($token);
    if(isset($res['payload'])) {
      $this->data['user']->setUser($res['payload']['name'], $res['payload']['id']);
      $this->data['auth']->setAuth(true);
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
  <script src='../scripts/logout.js' defer></script>
  <script src='../scripts/timer.js' defer></script>
  <title>Auth</title>
</head>

<body>
  <div class='page'>
    <header class='header'>
      <?php 
        if($this->data['auth']->isAuth) {
          ?>
      <button class='auth__logout'>Logout</button>
      <p>Привет <?php echo $this->data['user']->name ?>!</p>
    </header>
    <main class='main'>
      <section class="chat">
        <?php include __DIR__ . '/posts.php' ?>
      </section>
      <section class='auth'>
        <?php
      } else {
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