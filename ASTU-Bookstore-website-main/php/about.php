<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about this website</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about.jpg" alt="">
      </div>

      <div class="content">
         <h3>About this website</h3>
         <p>The ASTU Book Store website serves as a comprehensive resource for all of the textbooks, school supplies,
             and university merchandise required by incoming freshmen. The site features an intuitive, streamlined interface 
             that allows students to quickly locate and purchase the necessary course materials with ease. In addition to required textbooks, 
             the website also offers a diverse selection of supplementary learning resources, academic planners, and ASTU-branded apparel and a
             ccessories to foster campus pride and school spirit. With reliable order fulfillment and prompt delivery, the ASTU Book Store website 
             is designed to seamlessly support new students as they transition into their undergraduate studies. We encourage all freshmen to explore 
            the website's full inventory and take advantage of the convenient shopping experience it provides. </p>
         <p><b>also you can download them! </b></p>
         <a href="contact.php" class="btn">Read more</a>
      </div>

   </div>

</section>



<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>