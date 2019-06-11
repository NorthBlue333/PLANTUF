<?php require_once('models/add_model.php'); ?>
<form action="controllers/add_comment.php" method="post">
  <h1 class="text-center text-green font-weight-bold mb-3">Post your comment</h1>
  <input class="form-control" type="text" name="commenttitle" placeholder="Comment title">
  <select class="form-control mt-3" name="commentplant">
    <option value="none">-- Choose the plant --</option>
    <?php
    foreach ($subcategories as $key => $subcategory) {
      if($key == 0 || $subcategory['category_id'] != $subcategories[$key-1]['category_id']) {
        if($key != 0) { ?>
        </optgroup>
        <?php } ?>
        <optgroup label="<?= $subcategory['cname'] ?>">
      <?php } ?>
      <option value="<?= $subcategory['subcategory_id'] ?>"><?= $subcategory['name'] ?></option>
      <?php if($subcategory == end($subcategories)) { ?>
      </optgroup>
      <?php } ?>
    <?php }
    ?>
  </select>
  <textarea class="form-control my-3" name="commenttext" placeholder="Your comment"></textarea>
  <button class="btn bg-green text-white mt-3 d-block mx-auto" type="submit" name="commentsubmit">Add</button>
</form>
