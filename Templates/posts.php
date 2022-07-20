<?php
$posts = $this->data['post']->getAllPosts();

if(isset($_POST['message'])) {
  $author = $this->data['user']->name;
  $id = $this->data['user']->id;
  $this->data['post']->createPost($_POST['message'], $author, $id);
  header('Location: /');
}
?>
<?php
foreach($posts as $post) {?>
<article>
  <h2>User: <?php echo $post['author'] ?></h2>
  <p>Message: <?php echo $post['content'] ?></p>
</article>
<?php
}
?>

<form action="" method="post">
  <textarea name="message" cols="30" rows="10"></textarea>
  <button type='submit'>Send</button>
</form>