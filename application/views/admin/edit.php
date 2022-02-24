<div class="container admin-dashboard">
    <div class="heading-content">
        <h1>Edit A Product #[PRODUCT # HERE]</h1>
        <div>
            <a href="#">Return to dashboard</a>
        </div>
    </div>
    <form class="form-info" action="">
        <label for="product_name">Name:</label>
        <input type="text" name="product_name">

        <label for="product_description">Description: </label>
        <textarea name="product_description" id="" cols="30" rows="10"></textarea>

        <label for="prodcut_price">Price: </label>
        <input type="text" name="product_price">

        <label for="product_inventory">Inventory Count: </label>
        <input class="quantity-selector" name="product_inventory" type="text"  value="0" readonly>
        <div class="quantity-option">
            <button class="up" type="button">▲</button>
            <button class="down" type="button">▼</button>
        </div>
        <input type="submit" value="Save">
    </form>
</div>

</body>

</html>