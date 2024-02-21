<?php
session_start();

// Check if the role session variable is set
if (isset($_SESSION['role'])) {
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

    // Initialize packages variable
    $packages = [];

    // Check if the search form is submitted
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        // Fetch packages from the database based on search query
        $sql = "SELECT * FROM packages WHERE title LIKE '%$search%' OR price LIKE '%$search%'";
    } else {
        // Fetch all packages from the database
        $sql = "SELECT * FROM packages";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch each row as an associative array
        while ($row = $result->fetch_assoc()) {
            // Add each row (package) to the packages array
            $packages[] = $row;
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>package</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
  /* CSS for the search form */
.search-form {
    margin-top: 20px;
    text-align: center;
}

.search-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.search-container input[type="text"] {
    padding: 10px;
    margin-right: 10px;
    width: 200px;
}

.price-container {
    display: flex;
    align-items: center;
}

.price-container label {
    margin-right: 10px;
}

.price-container .price-slider {
    margin-right: 10px;
}

.price-container .price-value {
    font-weight: bold;
}


</style>

</head>
<body>

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

<div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
   <h1>packages</h1>
</div>

<!-- Search form -->
<form method="post" action="package.php" class="search-form">
    <div class="search-container">
        <input type="text" name="search" placeholder="Search by title">
        <div class="price-container">
            <label for="price">Prix:</label>
            <input type="range" name="price" id="price" min="0" max="1000" value="0" class="price-slider">
            <span class="price-value">0</span>
        </div>
        &nbsp;
        <button type="submit">Search</button>
    </div>
</form>

<!-- JavaScript to update price value -->
<script>
    const priceSlider = document.querySelector('.price-slider');
    const priceValue = document.querySelector('.price-value');

    // Update price value when slider is moved
    priceSlider.addEventListener('input', function() {
        priceValue.textContent = this.value;
    });
</script>


<section class="packages">

   <h1 class="heading-title">top destinations</h1>

   <div class="box-container">
      <?php foreach ($packages as $package): ?>
         <div class="box">
    <div class="image">
        <!-- Assuming the image_url column contains the filename of the image -->
        <?php $image_path = 'uploads/' . $package['image_url']; ?>
        <img src="<?php echo $image_path; ?>" alt="">
    </div>
    <div class="content">
        <h3><?php echo $package['title']; ?></h3>
        <p><?php echo $package['description']; ?></p>
        <?php if ($_SESSION['role'] == 'entreprise'): ?>
            <?php if ($package['discount'] > 0): ?>
                <p>Discount: <?php echo $package['discount']; ?>%</p>
                <p>Discounted Price: <?php echo $package['price'] - ($package['price'] * $package['discount'] / 100); ?></p>
            <?php endif; ?>
        <?php elseif ($_SESSION['role'] == 'admin'): ?>
            <p>Price: <?php echo $package['price']; ?></p>
            <?php if ($package['discount'] > 0): ?>
                <p>Discount: <?php echo $package['discount']; ?>%</p>
                <p>Discounted Price: <?php echo $package['price'] - ($package['price'] * $package['discount'] / 100); ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p>Price: <?php echo $package['price']; ?></p>
        <?php endif; ?>
        <a href="book.php?title=<?php echo urlencode($package['title']); ?>&discount=<?php echo urlencode($package['discount']); ?>" class="btn">Book Now</a>

    </div>
</div>

      <?php endforeach; ?>
   </div>

   <div class="load-more"><span class="btn">Load More</span></div>

</section>

<!-- footer section starts  -->

<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
         <a href="book.php"> <i class="fas fa-angle-right"></i> book</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
         <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
         <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
         <a href="#"> <i class="fas fa-envelope"></i> shaikhanas@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> mumbai, india - 400104 </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

   <div class="credit"> created by <span>mr. web designer</span> | all rights reserved! </div>

</section>

<!-- footer section ends -->

<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
