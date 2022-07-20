<?php
$posts = $this->post->getAllPosts();

if(isset($_POST['message'])) {
  $author = $this->user->name;
  $id = $this->user->id;
  $this->post->createPost($_POST['message'], $author, $id);
  header('Location: /');
}
?>
<section class='chat'>
  <p class='timer'></p>

  <div class='chat__messages'>
    <?php
  foreach($posts as $post) {
    ?>
    <article class="chat__post">
      <h3 class="chat__user">User: <?= $post['author'] ?></h3>
      <p class='chat__text-content'>Message: <?php echo $post['content'] ?></p>
    </article>
    <?php
  }
  ?>
  </div>

  <form action="" method="post" class='chat__textarea'>
    <textarea name="message" cols="30" rows="5"></textarea>
    <button type='submit'>Send</button>
  </form>
</section>