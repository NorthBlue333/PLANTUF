<?php
$answers = $db->prepare("SELECT com.*, u.username,
                                COUNT(upv.vote_id) AS upvotes, COUNT(downv.vote_id) AS downvotes, COUNT(upv.vote_id)-COUNT(downv.vote_id) AS scores
                          FROM comments AS com
                            JOIN users AS u USING(user_id)
                            LEFT JOIN votes AS upv ON com.comment_id = upv.comment_id AND upv.type = 1
                            LEFT JOIN votes AS downv ON com.comment_id = downv.comment_id AND downv.type = 0
                          WHERE com.answer_id = :id
                          GROUP BY com.comment_id
                          ORDER BY scores DESC, com.post_date DESC");
$answers->bindParam(':id', $answer_id, PDO::PARAM_INT);
$answers->execute();
$answers = fetchAllSecure($answers);
?>
