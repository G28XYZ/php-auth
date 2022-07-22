<?php

$message = '';

if(isset($_POST['email']) && isset($_POST['password'])) {
    $res = $this->auth->login($_POST['email'], $_POST['password']);
    if(isset($res['token'])) {
      // установить jwt токен на 5 мин
      setcookie('jwt', $res['token'], time() + 300);
      // установить время логина
      setcookie('timer', time());
      header("Location: /");
    } else {
      $message = $res['message'];
    }
}

?>

<h2 class='auth__title'>Вход</h2>
<form action='' method='post' name='login' class='auth__form mb-3' <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
  <p><?php echo $message ?? '' ?></p>
  <input class="form-control" type="text" name="email" placeholder="email" value="<?php echo $_POST['email'] ?? '' ?>">
  <input class="form-control" type="password" name="password" placeholder="password"
    value="<?php echo $_POST['password'] ?? '' ?>">
  <button class="btn btn-primary" type="submit">Войти</button>
</form>
<p>
  Не зарегистрированы?
  <a class="breadcrumb" href="/">Зарегистрироваться</a>
</p>