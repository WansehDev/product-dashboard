<?php
    if(($this->session->userdata('is_logged_in') != null && $this->session->userdata('is_logged_in') == true) && $this->session->userdata('is_admin') != 0) 
    {
        $is_admin = $this->session->userdata('is_admin');
    }
    else 
    {
        redirect('/');
    }
?>

<div class="container admin-dashboard">
    <div class="heading-content">
        <h2 class="title-container">Add a new Product</h2>
        <div>
            <a href="admin_dashboard">Return to dashboard</a>
        </div>
    </div>
    <form class="form-info" action="product/validate" method="post">
        <label for="product_name">Name:</label>
        <input type="text" name="product_name">

        <label for="product_description">Description: </label>
        <textarea name="product_description" id="" cols="120" rows="10"></textarea>

        <label for="prodcut_price">Price: </label>
        <input type="text" name="product_price">

        <label for="product_inventory">Inventory Count: </label>
        <div class="qty-area">
            <input class="quantity-selector" name="product_inventory" type="text"  value="0" readonly>
            <div class="quantity-option">
                <button class="up" type="button">▲</button>
                <button class="down" type="button">▼</button>
            </div>
        </div>
        <p><?= $this->session->flashdata('input_errors'); ?></p>
        <p><?= $this->session->flashdata('success'); ?></p>
        <input type="submit" value="Create">
    </form>
</div>

</body>

</html>