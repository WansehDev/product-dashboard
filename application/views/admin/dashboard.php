<?php
    if(($this->session->userdata('is_logged_in') != null && $this->session->userdata('is_logged_in') == true) && $this->session->userdata('is_admin') != 0) 
    {
        $is_admin = $this->session->userdata('is_admin');
    }
    else 
    {
        redirect('admin_dashboard');
    }

?>
<div class="container dashboard">
    <div class="heading-content">
        <h2 class="title-container">Manage Products</h2>
        <div>
            <a href="create">Create New Product</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Inventory Count</th>
                <th>Quantity Sold</th>
                <th>Action</th>
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
                <td>
                    <a href=<?= 'products/edit/'.$product['id']; ?>>Edit</a>
                    <a href=<?= 'products/remove/'.$product['id']; ?>>Remove</a>
                </td>
            </tr>
<?php
        }
?>
    </table>

</div>

</body>

</html>