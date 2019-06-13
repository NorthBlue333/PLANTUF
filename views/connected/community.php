<h1 class="text-center text-green font-weight-bold mb-3">Community comments</h1>
<button class="btn bg-green d-block mx-auto"><a href="?p=addcomment" class="mt-3 text-white">Post a comment</a></button>
<?php require_once('models/community_model.php');
$get_user = false;
$get_category = false;
$get_subcategory = false;
if(isset($_GET['user']) && !empty($_GET['user'])) {
  $get_user = $_GET['user'];
}
if(isset($_GET['category']) && !empty($_GET['category'])) {
  $get_category = $_GET['category'];
}
if(isset($_GET['subcategory']) && !empty($_GET['subcategory'])) {
  $get_subcategory = $_GET['subcategory'];
  if(!$get_category) {
    foreach ($subcategories as $subcategory) {
      if($subcategory['subcategory_id'] == $get_subcategory) {
        $get_category = $subcategory['category_id'];
        break;
      }
    }
  }
}
?>
<form class="form-inline mt-3 flex-nowrap">
  <div class="form-group flex-grow-1 mb-0 pr-2">
    <select class="form-control w-100" name="community_category">
      <option value="none">-- ALL CATEGORIES --</option>
      <?php foreach ($categories as $category) { ?>
        <option value="<?= $category['category_id'] ?>" <?= $get_category == $category['category_id'] ? 'selected' : '' ?>>
          <?= $category['name'] ?>
        </option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group flex-grow-1 mb-0">
    <select class="form-control w-100" name="community_subcategory">
      <option value="none">-- ALL PLANTS --</option>
      <?php foreach ($subcategories as $subcategory) {
        if(!$get_category || $subcategory['category_id'] == $get_category) { ?>
          <option value="<?= $subcategory['subcategory_id'] ?>" <?= $get_subcategory == $subcategory['subcategory_id'] ? 'selected' : '' ?>>
            <?= $subcategory['name'] ?>
          </option>
        <?php }
      } ?>
    </select>
  </div>
</form>
<form class="form-inline p-0 mt-3 user-search flex-nowrap">
  <div class="form-group mr-2 mb-0 flex-grow-1">
    <input class="form-control w-100" type="text" name="user_search" placeholder="Search for user" <?= $get_user ? 'value="'.$get_user.'"' : '' ?>/>
  </div>
  <button class="btn bg-green text-white" type="submit"><i class="fas fa-search"></i></button>
</form>
<?php
$is_parameter = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
if($get_category) {
  if($get_subcategory) {
    require_once('models/comments_subcategory_model.php');
  } else {
    require_once('models/comments_category_model.php');
  }
} else {
  require_once('models/comments_model.php');
}

if(count($comments) > 0) {
  foreach ($comments as $comment) { ?>
  <article class="comment mt-3 border rounded" id="comment-<?= $comment['comment_id'] ?>">
    <header class="py-2 px-3 border-bottom d-flex justify-content-between align-items-center">
      <h3 class="mb-0">
        <?= file_get_contents("_assets/images/svg/".$comment['image'].".svg") ?>
        <a href="?p=community&category=<?= $comment['category_id'] ?><?= $get_user ? '&user='.$get_user : '' ?>"><?= $comment['category'] ?></a> > <a href="?p=community&subcategory=<?= $comment['subcategory_id'] ?><?= $get_user ? '&user='.$get_user : '' ?>"><?= $comment['subcategory'] ?></a>
      </h3>
      <?php if($comment['user_id'] == $_SESSION['user']['user_id']) { ?>
        <form class="m-0" action="controllers/add_comment.php" method="post"><button class="btn btn-danger p-1" type="submit" name="commentdelete" value="<?= $comment['comment_id'] ?>">Delete</button></form>
      <?php } ?>
    </header>
    <h2 class="mb-0 mx-3 mt-3"><?= $comment['title'] ?>
      <div class="float-right text-danger votes"><i class="parrow parrow-down"></i><span><?= $comment['downvotes'] ?></span></div>
      <div class="float-right text-success votes mr-4"><i class="parrow parrow-up"></i><span><?= $comment['upvotes'] ?></span></div>
    </h2>
    <p class="mx-3 mb-2">
      <time>
        <?= date('M jS, Y \a\t h:i A', strtotime($comment['post_date'])) ?>
      </time> by <a class="font-italic" href="?p=community<?= $get_subcategory ? '&subcategory='.$get_subcategory : ($get_category ? '&category='.$get_category : '') ?>&user=<?= $comment['username'] ?>"><?= $comment['username'] ?></a>
    </p>
    <p class="mx-3">
      <?= $comment['comment'] ?>
    </p>
    <?php
    $answer_id = $comment['comment_id'];
    require('models/comment_model.php'); ?>
    <aside class="mx-3 py-1 text-center border-top font-italic cursor-pointer"><?= count($answers) ?> answers (click to show/hide)</aside>
    <?php foreach ($answers as $answer) { ?>
      <article class="answers ml-5 border-top pt-1 mr-3 collapse" id="comment-<?= $answer['comment_id'] ?>">
        <h4 class="mb-0">
          <?= $answer['title'] ?>
          <div class="float-right text-danger votes"><i class="parrow parrow-down"></i><span><?= $answer['downvotes'] ?></span></div>
          <div class="float-right text-success votes mr-4"><i class="parrow parrow-up"></i><span><?= $answer['upvotes'] ?></span></div>
        </h4>
        <p class="mb-2">
          <time><?= date('M jS, Y \a\t h:i A', strtotime($answer['post_date'])) ?></time> by <a class="font-italic" href="?p=community&user=<?= $answer['username'] ?>"><?= $answer['username'] ?></a>
        </p>
        <p><?= $answer['comment'] ?></p>
      </article>
    <?php }
    if(count($answers) > 0) { ?>
      <aside class="answers mx-3 py-1 text-center border-top font-italic cursor-pointer collapse">click to hide</aside>
    <?php }
    ?>
    <form class="m-3" action="controllers/add_comment.php" method="post">
      <input class="form-control" placeholder="Title of your comment" name="answertitle">
      <textarea class="form-control mt-1" placeholder="Your comment" name="answertext"></textarea>
      <button class="btn bg-secondary d-block mx-auto mt-1 text-white" type="submit" name="answersubmit" value="<?= $comment['comment_id'].'-'.$comment['subcategory_id'] ?>">Reply</button>
    </form>
  </article>
<?php  }
} else { ?>
  No comments here.
<?php } ?>
