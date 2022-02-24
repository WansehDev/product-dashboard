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
            <tr>
                <td>1</td>
                <td><a href="item">Product 1</a></td>
                <td>10</td>
                <td>5</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Product 2</td>
                <td>10</td>
                <td>5</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Product 3</td>
                <td>10</td>
                <td>5</td>
            </tr>
    </table>

</div>

</body>

</html>