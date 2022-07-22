<?php
$posts = $this->post->findAll();
$postIds = [];
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
    $this->post->save();
    header('Location: /');
  }
}

if(isset($_GET['userId'])) {
  if(array_search($_GET['postId'], $postIds) === false) {
    header('Location: /');
  } 
  if($_GET['userId'] != $this->user->id) {
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

    <article class="card chat__post <?php echo $isAuthor ? 'chat__post-author' : '' ?>">
      <h3 class="chat__user">User: <?php echo $post->author ?></h3>
      <p class='chat__text-content'>Message: <?php echo $post->content ?></p>

      <button data-user-id='<?php echo $this->user->id ?>' data-post-id='<?php echo $post->id ?>'
        class='btn btn-light chat__edit-button <?php echo $isAuthor ? 'chat__edit-button_active' : '' ?>'>Edit</button>

    </article>
    <?php endforeach; ?>
  </div>

  <form action="" method="post" class='chat__textarea'>
    <textarea class="form-control" name="message" cols="30" rows="5"></textarea>
    <button class="btn btn-outline-success" type='submit'>Send</button>
  </form>
</section>