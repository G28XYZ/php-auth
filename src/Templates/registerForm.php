<?php


if(isset($_POST['name']) && $_POST['password'] && $_POST['email']) {

  if($this->validation->checkValidation($_POST)) {

    $this->auth->isRegister = $this->user->findByParameter('email', $_POST['email']);

    if($this->auth->isRegister === false) {
      $this->user->createUser($_POST);
      header("Location: /?login=1");
    }
  }
}
?>

<h2 class='auth__title'>Регистрация</h2>
<form action="" method="post" class='auth__form mb-3'>

  <p><?php echo $this->auth->isRegister ? 'Пользователь уже зарегистрирован' : '' ?></p>

  <div class="col">
    <label for="validationServer03" class="form-label">Имя</label>
    <input type="text" class="form-control <?php echo $this->validation->isName ? 'is-invalid' : '' ?>"
      aria-describedby="validationServer03Feedback" name='name' type='text' required
      value="<?php echo $_POST['name'] ?? '' ?>">
    <div id="validationServerUsernameFeedback"
      class="<?php echo $this->validation->isName ? 'invalid-feedback' : 'valid-feedback' ?>">
      <?php echo $this->validation->isName ?>
    </div>
  </div>

  <div class="col">
    <label for="validationServer03" class="form-label">Email</label>
    <input type="text" class="form-control <?php echo $this->validation->isEmail ? 'is-invalid' : '' ?>"
      aria-describedby="validationServer03Feedback" name='email' type='text' required
      value="<?php echo $_POST['email'] ?? '' ?>">
    <div id="validationServerUsernameFeedback"
      class="<?php echo $this->validation->isEmail ? 'invalid-feedback' : 'valid-feedback' ?>">
      <?php echo $this->validation->isEmail ?>
    </div>
  </div>

  <div class="col">
    <label class="form-label">Пароль</label>
    <input id="inputPassword" class="form-control <?php echo $this->validation->isPassword ? 'is-invalid' : '' ?>"
      name='password' type='password' required value="<?php echo $_POST['password'] ?? '' ?>">
    <div class="<?php echo $this->validation->isPassword ? 'invalid-feedback' : 'valid-feedback' ?>">
      <?php echo $this->validation->isPassword ?>
    </div>
  </div>

  <button class="btn btn-primary" type="submit">Зарегистрироваться</button>
</form>
<p>
  Зарегистрированы?
  <a class="breadcrumb" href="/?login=1">Войти</a>
</p>