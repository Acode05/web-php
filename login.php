<?php
session_start();
include 'connection.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            echo "Password is wrong!. Please try again";
        }
    } else {
        echo "Email not found!";
    }
}
?>

<?php include 'header.php'; ?>

    <div class="login-container">
        <h2>login</h2><br><br>

        <form action="login.php" method="POST">
            
            <input type="email" name="email" placeholder="email" required><br>
            <input type="password" name="password" placeholder="password" required><br>

            <button type="submit" name="login" class="image-button" style="border: none; background: none; cursor: pointer; display: block; margin: 0 auto;">
                <img src="cat-button.jpg" alt="login button" width="120" height="120" >
            </button>

        </form>

        <p><a href="registration.php">register</a></p>
    </div>

<?php include 'footer.php'; ?>