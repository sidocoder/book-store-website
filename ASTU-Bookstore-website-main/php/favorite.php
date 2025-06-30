<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_favorite'])){
   $favorite_id = $_POST['favorite_id'];
   $favorite_quantity = $_POST['favorite_quantity'];
   mysqli_query($conn, "UPDATE `favorite` SET quantity = '$favorite_quantity' WHERE id = '$favorite_id'") or die('query failed');
   $message[] = 'favorite quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `favorite` WHERE id = '$delete_id'") or die('query failed');
   header('location:favorite.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `favorite` WHERE user_id = '$user_id'") or die('query failed');
   header('location:favorite.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>favorite</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>library favorite</h3>
   <p> <a href="home.php">home</a> / favorite </p>
</div>

<section class="library-favorite">

   <h1 class="title">books added</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_favorite = mysqli_query($conn, "SELECT * FROM `favorite` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_favorite) > 0){
            while($fetch_favorite = mysqli_fetch_assoc($select_favorite)){   
      ?>
      <div class="box">
         <a href="favorite.php?delete=<?php echo $fetch_favorite['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from favorite?');"></a>
         <img src="uploaded_img/<?php echo $fetch_favorite['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_favorite['name']; ?></div>
         
         <form action="" method="post">
            <input type="hidden" name="favorite_id" value="<?php echo $fetch_favorite['id']; ?>">
            <input type="number" min="1" name="favorite_quantity" value="<?php echo $fetch_favorite['quantity']; ?>">
            <input type="submit" name="update_favorite" value="update" class="option-btn">
         </form>
         
      </div>
      <?php
      
         }
      }else{
         echo '<p class="empty">your favorite is empty</p>';
      }
      
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="favorite.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from favorite?');">delete all</a>
   </div>

   <div class="favorite-total">
      
      <div class="flex">
         <a href="library.php" class="option-btn">continue reading</a>
         
      </div>
   </div>

</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>