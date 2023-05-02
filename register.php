<?php
include('./actionsystem/registersystem.php');
include('partials/header.php');
?>
<div class="register_container">
    <div class="overlay">
        <!-- his will have no content -->

    </div>
    <div class="titleDiv">
        <h1 class="title">Register</h1>
        <span class="subTitle">Thanks for choosing us!</span>
    </div>
    <!-- fromSection -->
    <form method="POST">
        <div class="rows grid">
            <!-- user Name  -->
            <div class="row">
                <label for="username">pseudo</label>
                <input type="text" id="username" name="username" placeholder="Enter User Name" required>
            </div>
            <!-- Email address  -->
            <div class="row">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter User email" required>
            </div>

            <!-- password -->
            <div class="row">
                <label for="password">password</label>
                <input type="password" id="password" name="password" placeholder="password" required>
            </div>
            <!-- <re-password -->
            <div class="row">
                <label for="password">confirm password</label>
                <input type="password" id="repassword" name="repassword" placeholder="confirm password" required>
            </div>

            <!-- submit Button -->
            <div class="row">
                <input type="submit" id="submitBtn" name="submit" value="Sign Up" >
                <span class="LoginLink">Already have an account? <a href="index.php">Login</a></span>
            </div>
        </div>
    </form>
</div>
<?php
include('partials/footer.php');
?>





<!-- 
$userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    //state out query..
    $sql = "INSERT INTO admin SET
        username= '$userName',
        email = '$email',
        passwords = '$password',
        repassword = '$repassword'

    ";

    //execute our sql query...
    $res = mysqli_query($conn, $sql);
    if($res == tru){
        $_SESSION['accountCreated'] = '<span class ="success">Account '.$userName.' created!</span>';
        header('location:' .SITEURL. 'index.php');
        exit();
    }
    else{
        $_SESSION['unSuccessful'] = '<span class ="fail">Account '.$userName.' failed!</span>';
        header('location:' .SITEURL. 'register.php');
        exit();
    }
-->