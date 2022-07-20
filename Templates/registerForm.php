<?php

if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email'])) {
  $this->auth->isRegister = $this->user->findByParameter('email', $_POST['email']);
  if($this->auth->isRegister === false) {
    $this->user->createUser($_POST);
    header("Location: ./?login=1");
  }
}

?>

<h2 class='auth'>Register user</h2>
<form action="" method="post" class='auth__form'>
  <p><?php echo $this->auth->isRegister ? 'Пользователь уже зарегистрирован' : '' ?></p>
  <input type="text" name="name" placeholder="name" value="<?php echo $_POST['name'] ?? '' ?>">
  <input type="text" name="email" placeholder="email" value="<?php echo $_POST['email'] ?? '' ?>">
  <input type="password" name="password" placeholder="password" value="<?php echo $_POST['password'] ?? '' ?>">
  <button type="submit">Register</button>
</form>
<p>
  Register?
  <a href="./?login=1">Login</a>
</p>