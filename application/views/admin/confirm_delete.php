<div class="container">
    <h2 class="title-continer">Are you sure you want to delete <?= $product['product_name']; ?>?</h2>
    <div class="confirm-delete">
        <a href="/admins/delete/<?= $product['id']; ?>">Yes</a>
        <a href="/admin_dashboard">No</a>
    <div>
</div>

</body>
</html>