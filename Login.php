<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* Additional custom styles for login/signup form */
      .login-form {
         display: block;
      }

      .signup-form.hidden {
         display: none;
      }

      .form-toggle {
         text-align: center;
         margin-top: 20px;
      }

      .form-toggle a {
         color: #333;
         text-decoration: underline;
         cursor: pointer;
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

<!-- header section ends -->

<div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
   <h1>Login</h1>
</div>

<!-- login form starts  -->

<section class="booking login-form">

   <h1 class="heading-title">Welcome Back!</h1>

   <form action="auth.php" method="post" class="book-form">
      <div class="flex">
         <div class="inputBox">
            <span>Email:</span>
            <input type="email" placeholder="Enter your email" name="email">
         </div>
         <div class="inputBox">
            <span>Password:</span>
            <input type="password" placeholder="Enter your password" name="password">
         </div>
      </div>
      <input type="submit" value="Login" class="btn" name="login">
   </form>

   <div class="form-toggle">
      <a href="signup.php">Don't have an account? Sign Up</a>
   </div>

</section>

<!-- login form ends -->

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
