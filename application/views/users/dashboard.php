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
<div class="container dashboard">
    <h2 class="title-container">All Products</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Inventory Count</th>
                <th>Quantity Sold</th>
            </tr>
        </thead>
        <tbody>
<?php
        foreach($products as $product)
        {
?>
            <tr>
                <td><?= $product['id']; ?></td>
                <td><a href=<?= "products/show/".$product['id']; ?>><?= $product['product_name']; ?></a></td>
                <td><?= $product['product_inventory']; ?></td>
                <td><?= $product['product_qty_sold']; ?></td>
            </tr>
<?php
        }
?>
    </table>

</div>

</body>

</html>