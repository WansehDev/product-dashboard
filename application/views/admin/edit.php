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
        <h2 class="title-container">Edit A Product #<?= $product['id']; ?></h2>
        <div>
            <a href="/admin_dashboard">Return to dashboard</a>
        </div>
    </div>
    <form class="form-info" action=<?= "/products/save/".$product['id']; ?> method="post">
        <label for="product_name">Name:</label>
        <input type="text" name="product_name" value=<?= $product['product_name']; ?>>

        <label for="product_description">Description: </label>
        <textarea name="product_description" id="" cols="30" rows="10"><?= $product['product_description']; ?></textarea>

        <label for="prodcut_price">Price: </label>
        <input type="text" name="product_price" value=<?= $product['product_price']; ?>>

        <label for="product_inventory">Inventory Count: </label>
        <div class="qty-area">
            <input class="quantity-selector" name="product_inventory" type="text"  value=<?= $product['product_inventory']; ?> readonly>
            <div class="quantity-option">
                <button class="up" type="button">▲</button>
                <button class="down" type="button">▼</button>
            </div>
        </div>
<?php
    if( $this->session->flashdata('success') ) 
    {
        echo $this->session->flashdata('success');
    }
?>
        <input type="hidden" name="id" value=<?= $product['id']; ?>>
        <input type="submit" value="Save">
    </form>
</div>

</body>

</html>