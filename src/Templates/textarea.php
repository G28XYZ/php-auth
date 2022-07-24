<?php

$postIds = [];

foreach($this->post->allPosts as $post) {
  if($this->user->id == $post->user_post_id) {
    $postIds[] = (string)$post->id;
  }
}


if(isset($_GET['userId'])) {
    $message = $this->post->findByParameter('id', $_GET['postId'])->content ?? '';
    $this->textarea->onEditMessage = array_search($_GET['postId'], $postIds) && $_GET['userId'] == $this->user->id;
    $this->textarea->message = $this->textarea->onEditMessage ? $message : '';
    $this->textarea->onEditMessage ?? header('Location: /');
    if(isset($_GET['delete']) && $_GET['delete']) {
      $this->post->delete($_GET['postId']);
      header('Location: /');
    }
}

if(isset($_POST['message_edit'])) {
    $this->post->author = $this->user->full_name;
    $this->post->user_post_id = $this->user->id;
    $this->post->content = $_POST['message'];
    if(strlen($_POST['message'])) {
        $this->post->save($_GET['postId'] ?? '');
        header('Location: /');
    }
}

if(isset($_POST['cancel_edit'])) {
    header('Location: /');
}
?>

<form action="" method="post" class='chat__textarea'>
  <textarea class="chat__textarea-content form-control" name="message" cols="30" rows="5" minlength="1"
    required><?php echo $this->textarea->message ?></textarea>
  <div class="btn-group-vertical">
    <button name='message_edit'
      class="btn <?php echo $this->textarea->message ? 'btn-outline-warning' : 'btn-outline-success' ?>"
      type='submit'><?php echo $this->textarea->message ? 'Edit' : 'Send' ?></button>
    <?php
      if($this->textarea->message) : { ?>
    <button class="btn btn-outline-danger" name='cancel_edit'>Отмена</button>
    <?php } endif?>
  </div>


</form>