<?php
    if($this->session->userdata('is_logged_in') != null && $this->session->userdata('is_logged_in') == true)
    {
        $is_admin = $this->session->userdata('is_admin');
    }
    else 
    {
        redirect('/');
    }
?>
<div class="container item-dashboard">
    <h2 class="title-container"><?= $products['product_name']; ?></h2>
    <p>Added since: <span><?= date('F jS Y', strtotime($products['created_at'])); ?></span></p>
    <p>Product ID: <span>#<?= $products['id']; ?></span></p>
    <p>Description: <span><?= $products['product_description']; ?></span></p>
    <p>Total sold: <span><?= $products['product_qty_sold']; ?></span></p>
    <p>Number of available stocks: <span><?= $products['product_inventory']; ?></span></p>
    
    <!-- USER REVIEW -->
    <div class="review-container">
        <form action=<?= "/products/add/".$products['id']; ?> method="post">
            <h3>Leave a Review</h3>
            <textarea class="post-area" name="review" cols="97" rows="7" placeholder="Write a Review..."></textarea>
            <div class="btn-container">
                <input class="btn blue-btn" type="submit" value="post a view">
            </div>
        </form>
    </div>

<?php
if($posts != null)
{
    foreach($posts as $post)
    {        
?>
    <!-- POSTED REVIEWS -->
    <div class="posted-section">
        <h4 class="owner-post"><?= $post['message_sender_name'] ?> wrote:</h4>
        <div class="time-ago">
            <p><?= $post['post_date']; ?></p>
        </div>
        <p><?= $post['post_content']; ?></p>
<?php
        foreach($comments as $user_comments)
        {
            foreach($user_comments as $comment)
            {
                if($comment != null && $comment['message_id'] == $post['post_id'])
                {
?>
        <div class="comments-section">
            <h5 class="owner-post"><?= $comment['comment_sender_name']; ?> wrote:</h5>
            <div class="time-ago">
                <p><?= $comment['comment_date']; ?></p>
            </div>
            <p><?= $comment['comment_content']; ?></p>
        </div>
<?php       
                }
            }
        }
?>
        <!-- USER COMMENT REVIEWS -->
        <div class="comment-container">
            <form action=<?= "/products/comments/".$products['id']; ?>  method="post">
                <textarea class="comment-post" name="reply" cols="90" rows="5" placeholder="Post a Comment..."></textarea>
                <input type="hidden" name="message_id" value="<?= $post['post_id'] ?>">
                <div class="btn-container">
                    <input class="btn green-btn" type="submit" value="reply">
                </div>
            </form>
        </div>
    </div>
<?php
    }
}
?>

</div>

</body>

</html>