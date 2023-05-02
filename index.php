<?php
include('./actionsystem/loginsystem.php');
include('partials/header.php');
?>


<div class="from_container">
    <div class="overlay">
        <!-- his will have no content -->
    </div>
    <div class="titleDiv">
        <h1 class="title">Login</h1>
        <span class="subTitle">Welcome back!</span>
    </div>

    

    <!-- fromSection -->
    <form method="POST">
        <div class="rows grid">
            <!-- user Name  -->
            <div class="row">
                <label for="username">User Name</label>
                <input type="text" id="username" name="username" placeholder="Enter User Name" required>
            </div>
            <!-- password -->
            <div class="row">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter User Name" required>
            </div>
            <!-- submit Button -->
            <div class="row">
                <input type="submit" id="submitBtn" name="submit" value="Login" required>
                <span class="registerLink">D'ont have an account? <a href="register.php">Register</a></span>
            </div>
        </div>
    </form>
</div>

<?php
include('partials/footer.php')
?>



<!-- $userName = $_POST['userName'];
    $password = $_POST['password']; 

    //sql to select if there's the details in the database 
    $sql = "SELECT * FROM admin WHERE username = '$userName' AND passwords = '$password'";

    //Execute the query
    $result = mysqli_query($conn, $sql);

    //Count the number of account with same username and password 
    $count = mysqli_num_rows($result);

    //put the count results into one associate array
    $row = mysqli_fetch_assoc($result);
    
    //check if there's at least one account in the database 
    if($count ==1){
        //message to welcome admin to the dashboard
        $_SESSION['loginMessage'] = '<span class="success">Wecome '.$userName.' </span>';
        header('location:' .SITEURL. 'dashboard.php');
        exit();
    }
    else{
        //message if the admin/accountis not in the database 
        $_SESSION['noAdmin'] = '<span class="fail">'.$userName.' is not registered! </span>';
        header('location:' .SITEURL. 'index.php');
        exit();
    } -->