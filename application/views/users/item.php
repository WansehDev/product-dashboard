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
    <h2 class="title-container">V88 T-shirt</h2>
    <p>Added since: December 20th 2021</p>
    <p>Product ID: #2</p>
    <p>Description: Legit</p>
    <p>Total sold: 100</p>
    <p>Number of available stocks: 120</p>
    
    <!-- USER REVIEW -->
    <div class="review-container">
        <form action="" method="post">
            <h3>Leave a Review</h3>
            <textarea class="post-area" name="review" cols="97" rows="7" placeholder="Write a Review..."></textarea>
            <input type="hidden" name="action" value="postreview">
            <div class="btn-container">
                <input class="btn blue-btn" type="submit" value="post a view">
            </div>
        </form>
    </div>

    <!-- POSTED REVIEWS -->
    <div class="posted-section">
        <h4>Lance Parantar wrote:</h4>
        <p>Hello world</p>
        <div class="comments-section">
            <h5>Mike Buttowzki wrote:</h5>
            <p>Hello</p>
        </div>

        <!-- USER COMMENT REVIEWS -->
        <div class="comment-container">
            <form action="" method="post">
                <textarea class="comment-post" name="reply" cols="90" rows="5" placeholder="Post a Comment..."></textarea>
                <input type="hidden" name="action" value="replies">
                <input type="hidden" name="id" value="id">
                <div class="btn-container">
                    <input class="btn green-btn" type="submit" value="reply">
                </div>
            </form>
        </div>
    </div>

</div>

</body>

</html>