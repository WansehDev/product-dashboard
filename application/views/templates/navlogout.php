<?php
    if($this->session->userdata('is_logged_in') != null && $this->session->userdata('is_logged_in') == true)
    {
        $is_admin = $this->session->userdata('is_admin');
    }
?>
<nav>
    <h1>V88 Merchandise</h1>
    <ul>
        <li class="nav-item"><a href=<?= $is_admin ? "/admin_dashboard" : "/dashboard" ?>>Dashboard</a></li>
        <li class="nav-item"><a href="/profile">Profile</a></li>
        <li class="account-area-logout"><a href="/logout">Log Off</a></li>
    </ul>
</nav>