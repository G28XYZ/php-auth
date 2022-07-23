<?php
$posts = $this->post->findAll();
// сортировка по id по порядку
usort($posts, fn($a, $b) => strcmp($a->id, $b->id));;
$postIds = [];
$editMessage = '';
foreach($posts as $post) {
  if($this->user->id == $post->user_post_id) {
    $postIds[] = (string)$post->id;
  }
}

if(isset($_POST['message'])) {

  $this->post->author = $this->user->full_name;
  $this->post->user_post_id = $this->user->id;
  $this->post->content = $_POST['message'];

  if(strlen($_POST['message'])) {
    $this->post->save($_GET['postId'] ?? '');
    header('Location: /');
  }
}

if(isset($_GET['userId'])) {
  if(array_search($_GET['postId'], $postIds) === false && $_GET['userId'] != $this->user->id) {
    $editMessage = '';
    header('Location: /');
  } else {
    $editMessage = $this->post->findByParameter('id', $_GET['postId'])->content ?? '';
  }
  if(isset($_GET['delete']) && $_GET['delete']) {
    $this->post->delete($_GET['postId']);
    header('Location: /');
  }
}

?>
<section class='chat'>
  <p class='timer'></p>

  <div class='card chat__messages'>
    <?php
    foreach($posts as $post) : ?>

    <?php $isAuthor = $this->user->id == $post->user_post_id; ?>

    <article class="card border-success chat__post <?php echo $isAuthor ? 'chat__post-author' : '' ?>">
      <h3 class="chat__user card-header bg-transparent border-success"><?php echo $post->author ?></h3>
      <p class='chat__text-content card-body'><?php echo $post->content ?></p>

      <div class="btn-group">
        <button type="button" data-user-id='<?php echo $this->user->id ?>' data-post-id='<?php echo $post->id ?>'
          class='btn btn-light chat__button chat__edit-button <?php echo $isAuthor ? 'chat__button_active' : '' ?>'>Изменить</button>
        <button type="button" data-user-id='<?php echo $this->user->id ?>' data-post-id='<?php echo $post->id ?>'
          class='btn btn-danger chat__button chat__delete-button <?php echo $isAuthor ? 'chat__button_active' : '' ?>'>Удалить</button>
      </div>

    </article>
    <?php endforeach; ?>
  </div>

  <form action="" method="post" class='chat__textarea'>
    <textarea class="chat__textarea-content form-control" name="message" cols="30" rows="5" minlength="1"
      required><?php echo $editMessage ?></textarea>
    <button class="btn <?php echo $editMessage ? 'btn-outline-warning' : 'btn-outline-success' ?>"
      type='submit'><?php echo $editMessage ? 'Edit' : 'Send' ?></button>
  </form>
</section>