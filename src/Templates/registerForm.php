<?php


if(isset($_POST['name']) && $_POST['name'] && $_POST['password'] && $_POST['email']) {
  $this->auth->isRegister = $this->user->findByParameter('email', $_POST['email']);
  if($this->auth->isRegister === false) {
    $this->user->createUser($_POST);
    header("Location: /?login=1");
  }
}

?>

<h2 class='auth__title'>Регистрация</h2>
<form action="" method="post" class='auth__form mb-3'>
  <p><?php echo $this->auth->isRegister ? 'Пользователь уже зарегистрирован' : '' ?></p>
  <input class="form-control" type="text" name="name" placeholder="name" value="<?php echo $_POST['name'] ?? '' ?>">
  <input class="form-control" type="text" name="email" placeholder="email" value="<?php echo $_POST['email'] ?? '' ?>">
  <input class="form-control" type="password" name="password" placeholder="password"
    value="<?php echo $_POST['password'] ?? '' ?>">
  <button class="btn btn-primary" type="submit">Зарегистрироваться</button>
</form>
<p>
  Зарегистрированы?
  <a class="breadcrumb" href="/?login=1">Войти</a>
</p>