<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_favorite'])){

   $book_name = $_POST['book_name'];
   $book_image = $_POST['book_image'];
   $book_quantity = $_POST['book_quantity'];

   $check_favorite_numbers = mysqli_query($conn, "SELECT * FROM `favorite` WHERE name = '$book_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_favorite_numbers) > 0){
      $message[] = 'already added to favorite!';
   }else{
      mysqli_query($conn, "INSERT INTO `favorite`(user_id, name, price, quantity, image) VALUES('$user_id', '$book_name', '$book_price', '$book_quantity', '$book_image')") or die('query failed');
      $message[] = 'book added to favorite!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>ASTU Book Store</h3>
    
      <p> <em> <b>if you are a freshman student, you are on the right place </b></em><br>
         to discover books open button below</p>
      <a href="about.php" class="white-btn">view books</a>
   </div>

</section>

<section class="books">

   <h1 class="title">Books</h1>

   <div class="box-container">

      <?php  
         $select_books = mysqli_query($conn, "SELECT * FROM `books` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_books) > 0){
            while($fetch_books = mysqli_fetch_assoc($select_books)){
      ?>
     <form action="" method="post" class="box">
     <img class="image" src="uploaded_img/<?php echo $fetch_books['image']; ?>" alt="">
     <div class="name"><?php echo $fetch_books['name']; ?></div>
      <input type="hidden" name="book_name" value="<?php echo $fetch_books['name']; ?>">
      <input type="hidden" name="book_image" value="<?php echo $fetch_books['image']; ?>">
      <input type="submit" value="add to favorite" name="add_to_favorite" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no books added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="library.php" class="option-btn">load more</a>
   </div>

</section>

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
            the website's full inventory and take advantage of the convenient shopping experience it provides.</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>reach out to our help center</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
