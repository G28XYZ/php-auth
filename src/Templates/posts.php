<?php
$posts = $this->post->findAll();
// сортировка по id по порядку
usort($posts, fn($a, $b) =>  $a->id > $b->id ? 1 : -1);
$this->post->allPosts = $posts;
?>
<section class='chat'>
  <p class='timer'></p>
  <div class='card chat__messages'>
    <?php
    foreach($this->post->allPosts as $post) : ?>
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
  <?php include __DIR__ . '/textarea.php' ?>
</section>
