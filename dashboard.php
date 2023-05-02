<?php
require('./actionsystem/security.php');
include('partials/header.php');
?>

<div class="dashboard">
    <span>
        <h1>Dashboard</h1>
        <h3 class="h3" style="color: #ffff;"><?= $_SESSION['username'];?></h3>
        <h3 class="h3" style="color: #ffff;"><?= $_SESSION['email'];?></h3>
        <br><br><br>
        <div class="logOutBtn">
            <a href="./actionsystem/logout.php"> Log Out</a>
        </div>
    </span>
</div>

<?php
include('partials/footer.php');
?>