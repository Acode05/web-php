<?php
session_start();
include 'connection.php';
include 'header.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $stock = $_POST['stock'];
    $cat_id = $_POST['cat_id'];
    $created_by = $_SESSION['user_id'];

    $image = '';
if($_FILES['image']['error'] == 0){
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $image = uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
}
$query = "INSERT INTO product (name, image, description, price, discount, stock, cat_id, created_by) 
          VALUES ('$name', '$image', '$description', '$price', '$discount', '$stock', '$cat_id', '$created_by')";

$result = mysqli_query($conn, $query);

if($result){
   echo '<div class="alert-success"> Product added successfully!</div>'; 
} else {
    echo '<div class="alert-error"> Something went wrong!</div>';
}
}
?>

<head>
<link rel="stylesheet" href="style.css" >
</head>


<div class="form-box">
    <h2>Create Offer</h2>
    <form action="submit-offer.php" method="POST" enctype="multipart/form-data">
        <div class="form-field">
            <label>Title</label>
            <input type="text" name="name" required>
        </div>
        
        <div class="form-field">
            <label>Enter your image</label>
            <input type="file" name="image" accept="image/*" required>
        </div>
        
        <div class="form-field">
            <label>Description</label>
            <textarea name="description" rows="4" required></textarea>
        </div>
        
        <div class="form-field">
            <label>Price ($)</label>
            <input type="number" name="price" step="0.01" required>
        </div>
        
        <div class="form-field">
            <label>Discount Percentage (%)</label>
            <input type="number" name="discount" step="0.1" required>
        </div>
        
        <div class="form-field">
            <label>Quantity</label>
            <input type="number" name="stock" required>
        </div>
        
        <div class="form-field">
            <label>Category</label>
            <select name="cat_id" required>
                <option value="1">Pet Accessories</option>
                <option value="2">Pet Food</option>
            </select>
        </div>
        
        <button type="submit" class="btn">CREATE</button>
    </form>
</div>

<?php include 'footer.php' ; ?>