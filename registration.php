<?php
 $errors = array();
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (isset($_POST["submit"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email  = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);


    if (empty($firstName) OR empty($lastName) OR empty($email) OR empty($password) OR empty($confirm_password)) {
        array_push($errors,"All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password)<8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password !==  $confirm_password) {
        array_push($errors, "Password does not match");
    }

    if (count($errors)>0) {
        foreach ($errors as $error) {
           
        }
    }else{
        require_once "connection.php";
        $sql = "INSERT INTO user (firstName, lastName, email, password) VALUES (? , ? ,? ,?)";
        $stmt = mysqli_stmt_init($conn);
       $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
       if ($prepareStmt){
        mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $passwordHash);
        mysqli_stmt_execute($stmt);
        $success_message = "You are registered successfully!";
       }else {
        die("Something went wrong");
       }
    }
}

$page_title = "register";
include 'header.php';

?>



<div class="login-container">
<h2>register</h2><br><br>

    <?php
    if (count($errors) > 0) {
        foreach ($errors as $error) {
           echo "<p style='color: red; font-size: 13px; margin: 2px 0;'>$error</p>";
        }
    }
    if (isset($success_message)) {
        echo "<p style='color: green; font-weight: bold; background: #d4edda; padding: 10px; border-radius: 5px;'>$success_message</p>";
    }
    ?>
    

<form action="registration.php" method="POST">

    <input type="text" name="firstName" placeholder="first name" required><br>
    <input type="text" name="lastName" placeholder="last name" required><br>
    
    <input type="email" name="email" placeholder="email" required><br>
    
    <input type="password" name="password" placeholder="password" required><br>
    
    <input type="password" name="confirm_password" placeholder="confirm password" required><br>

    <button type="submit" name="submit" style="background:none; border:none; outline:none; cursor:default; padding:0;">
        <img src="cat-button.jpg" class="image-button">
    </button>

</form>

<p><a href="login.php">login</a></p>
</div>

<?php include 'footer.php' ; ?>