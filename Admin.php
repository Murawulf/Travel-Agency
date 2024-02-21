<?php
// Connect to the database
$servername = "localhost";
$username = "root"; // Assuming your MySQL username is root
$password = ""; // No password
$dbname = "wanderlux";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a new package
function addPackage($image, $title, $description, $price, $discount) {
    global $conn;

    // Upload image
    $target_dir = "uploads/";
    $uploaded_file = $_FILES["image"]["tmp_name"];

    // Check if the directory exists or create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Convert uploaded image to JPEG format
    $image = imagecreatefromstring(file_get_contents($uploaded_file));
    $jpeg_target_file = $target_dir . uniqid() . '.jpg'; // Generate unique filename
    imagejpeg($image, $jpeg_target_file, 90); // Convert to JPEG format with quality 90

    // Save JPEG image path to database
    $image_path = basename($jpeg_target_file); // Use only the filename, not the full path

    // Insert package details into database
    $sql = "INSERT INTO packages (image_url, title, description, price, discount) VALUES ('$image_path', '$title', '$description', '$price', '$discount')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to edit a package by title
function editPackage($title, $new_image, $new_description, $new_price, $new_discount) {
    global $conn;
    $sql = "UPDATE packages SET ";
    if (!empty($new_image)) {
        // Upload new image to server
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["new_image"]["name"]);
        move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file);
        $sql .= "image_url='$target_file', ";
    }
    $sql .= "description='$new_description', price='$new_price', discount='$new_discount' WHERE title='$title'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


// Function to delete a package by title
function deletePackage($title) {
    global $conn;
    $sql = "DELETE FROM packages WHERE title='$title'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add new package
    if (isset($_POST['add'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        addPackage($_FILES['image'], $title, $description, $price, $discount);
    }
    // Edit package
    if (isset($_POST['edit'])) {
        $title = $_POST['title'];
        $new_image = $_FILES['new_image'];
        $new_description = $_POST['new_description'];
        $new_price = $_POST['new_price'];
        $new_discount = $_POST['new_discount'];
        editPackage($title, $new_image, $new_description, $new_price, $new_discount);
    }
    // Delete package
    if (isset($_POST['delete'])) {
        $title = $_POST['title'];
        deletePackage($title);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        .booking {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .inputBox {
            width: 100%;
            margin-bottom: 20px;
        }

        .inputBox label {
            display: block;
            margin-bottom: 5px;
        }

        .inputBox input[type="text"],
        .inputBox textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .inputBox input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .inputBox input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
    
<!-- section en-tête commence  -->
<section class="header">
<a href="home.php" class="logo">Wanderlux.tn.</a>

   <nav class="navbar">
      <a href="Authentificate.php">Authentifier</a>
      <a href="about.php">À propos</a>
      <a href="package.php">Forfait</a>
      <a href="book.php">Réserver</a>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>
</section>
</head>
<body>

<section class="booking">

<h2>Add Package</h2>
<form method="post" enctype="multipart/form-data" class="book-form signup-form">
    <div class="inputBox">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
    </div>
    <div class="inputBox">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
    </div>
    <div class="inputBox">
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div class="inputBox">
        <label for="price">Price:</label>
        <input type="text" name="price" id="price">
    </div>
    <div class="inputBox">
        <label for="discount">Discount (%):</label>
        <input type="text" name="discount" id="discount">
    </div>
    <input type="submit" name="add" value="Add Package">
</form>

<h2>Edit Package</h2>
<form method="post" enctype="multipart/form-data" class="book-form signup-form">
    <div class="inputBox">
        <label for="edit_title">Title:</label>
        <input type="text" name="title" id="edit_title">
    </div>
    <div class="inputBox">
        <label for="new_image">New Image:</label>
        <input type="file" name="new_image" id="new_image">
    </div>
    <div class="inputBox">
        <label for="new_description">New Description:</label>
        <textarea name="new_description" id="new_description"></textarea>
    </div>
    <div class="inputBox">
        <label for="new_price">New Price:</label>
        <input type="text" name="new_price" id="new_price">
    </div>
    <div class="inputBox">
        <label for="new_discount">New Discount (%):</label>
        <input type="text" name="new_discount" id="new_discount">
    </div>
    <input type="submit" name="edit" value="Edit Package">
</form>

<h2>Delete Package</h2>
<form method="post" class="book-form signup-form">
    <div class="inputBox">
        <label for="delete_title">Title:</label>
        <input type="text" name="title" id="delete_title">
    </div>
    <input type="submit" name="delete" value="Delete Package">
</form>

</section>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
