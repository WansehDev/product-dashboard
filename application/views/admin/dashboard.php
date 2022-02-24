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
            <tr>
                <td>1</td>
                <td><a href="item">Product 1</a></td>
                <td>10</td>
                <td>5</td>
                <td>
                    <a href="edit">Edit</a>
                    <a href="#">Remove</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Product 2</td>
                <td>10</td>
                <td>5</td>
                <td>
                    <a href="#">Edit</a>
                    <a href="#">Remove</a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Product 3</td>
                <td>10</td>
                <td>5</td>
                <td>
                    <a href="#">Edit</a>
                    <a href="#">Remove</a>
                </td>
            </tr>
    </table>

</div>

</body>

</html>