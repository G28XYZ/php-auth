<?php

$message = '';

if(isset($_POST['email']) && isset($_POST['password'])) {
    $res = $this->data['auth']->login($_POST['email'], $_POST['password']);
    if(isset($res['token'])) {
      var_dump($token);
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

<h2>Login user</h2>
<form action='' method='post' name='login' class='auth__form'>
  <p><?php echo $message ?? '' ?></p>
  <input type="text" name="email" placeholder="email" value="<?php echo $_POST['email'] ?? '' ?>">
  <input type="password" name="password" placeholder="password" value="<?php echo $_POST['password'] ?? '' ?>">
  <button type="submit">Login</button>
</form>
<p>
  Not register?
  <a href="./">Register</a>
</p>