<?php
if($get_user) {
  $get_userlike = '%'.$get_user.'%';
  $comments = $db->prepare("SELECT com.*, u.username, c.name AS category,
                                    c.image, c.category_id, sc.name AS subcategory,
                                    COUNT(upv.vote_id) AS upvotes, COUNT(downv.vote_id) AS downvotes
                            FROM comments AS com
                              JOIN users AS u USING(user_id)
                              JOIN subcategories AS sc USING(subcategory_id)
                              JOIN categories AS c USING(category_id)
                              LEFT JOIN votes AS upv ON com.comment_id = upv.comment_id AND upv.type = 1
                              LEFT JOIN votes AS downv ON com.comment_id = downv.comment_id AND downv.type = 0
                            WHERE com.answer_id IS NULL AND u.username LIKE :username
                            GROUP BY com.comment_id
                            ORDER BY com.post_date DESC");
  $comments->bindParam(':username', $get_userlike, PDO::PARAM_STR);
} else {
  $comments = $db->prepare("SELECT com.*, u.username, c.name AS category,
                                    c.image, c.category_id, sc.name AS subcategory,
                                    COUNT(upv.vote_id) AS upvotes, COUNT(downv.vote_id) AS downvotes
                            FROM comments AS com
                              JOIN users AS u USING(user_id)
                              JOIN subcategories AS sc USING(subcategory_id)
                              JOIN categories AS c USING(category_id)
                              LEFT JOIN votes AS upv ON com.comment_id = upv.comment_id AND upv.type = 1
                              LEFT JOIN votes AS downv ON com.comment_id = downv.comment_id AND downv.type = 0
                            WHERE com.answer_id IS NULL
                            GROUP BY com.comment_id
                            ORDER BY com.post_date DESC");
}
$comments->execute();
$comments = fetchAllSecure($comments);
?>
