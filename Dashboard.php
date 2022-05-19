
<?php
// Initialize the session
session_start();
include 'functions.php';
$pdo = pdo_connect_mysql();

$stmt = $pdo->prepare('SELECT * FROM tours ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Travellogin.php");
    exit;
}
?>




<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <script src="https://kit.fontawesome.com/e22c065292.js" crossorigin="anonymous"></script>
    <link href="Dashboard.css" rel="stylesheet" type="text/css" />
  
    <!-- <link href="tour.css" rel="stylesheet" type="text/css" /> -->
  </head>

  <body>
    <div class="main-container">
      <div class="nav">
        <div class="menu">
          <img src = "logo.jpg" width="49" height="49">

          <!-- <h3>LOGO</h3> -->
          <!-- <a href="index.html"> Logout</a> -->
          <a href="logout.php" >logout</a>
          <a href="cart.html"> cart</a>
          <!-- <i class="fas fa-shopping-cart"></i> -->
        </div>
      </div>

      
      <div class="square">
        <div class="text">
          Welcome,
          <br />
         <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>
          <div class="user_icon">
            <img src="images/icons8-user-100.png" width="120" height="120" />
          </div>
        </div>
      </div>

      <div class="rectangle">
        <div class="_">
          <img src="images/setting.png" width="120px" height="120px" />
          <div class="icon">Manage order</div>
        </div>
        <div class="_">
          <img
            class="flight"
            src="images/search-flight.png"
            width="100px"
            height="100px"
          />
          <div class="icon">Search flight</div>
        </div>
        <div class="_">
          <img src="images/icons8-tour-96.png" width="130px" height="140px" />
          <div class="tour">Book tours</div>
        </div>
        <div class="_ ">
          <img src="images/icons8-hotel-96.png" width="120px" height="120px" />
          <div class="icon">Book hotels</div>
        </div>
      </div>

      <div class = searchText>
        Search for flights and tours
        <div class = search-bar></div>
        <div class = magnify>
          <img src="images/search.png" width="20" height="20">
        </div>
      </div>

      <div class = filterText>
        Filter
        <div class = filter></div>
      </div>


      <div class="container">

   
    <div class="box">
        <?php foreach ($recently_added_tours as $tours): ?>
        <a href="routing.php?page=routes&id=<?=$tours['id']?>" class="product">
            <img class = "image"src="<?=$tours['img']?>" width="150" height="100" alt="<?=$tours['name']?>">
            <div class="tname"><?=$tours['name']?></div>
            <span class="price">
                <!-- &dollar;<?=$tours['price']?> -->
                
                <p><button>Add to Cart</button></p>
                <?php if ($tours['rrp'] > 0): ?>
                  <span class="rrp">&dollar;<?=$tours['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    
    </div>

   
</div>



 <footer>

      <div class="content">
          <a href="#"> Customer service </a>
          <a href="#"> FAQ </a>
        </div>
        <div class="content">
            <a href="#"> About us</a>
          <a href="#"> Need help? </a>
        </div>

        <div class="content">
          <a href="#"> Accessibility </a>
          <a href="#"> User Agreement </a>
        </div>
        <div class="content">
          <a href="#"> Cookie Policy</a>
          <a href="#"> Privacy Policy </a>
        </div>
        <div class="content">
          <a href="#"> Contact Us</a>
          <div class="socialmedia">
            <a href="https://www.facebook.com/"><i class="fab fa-facebook "></i></a>
            <a href="https://www.instagram.com/?hl=en"><i class="fa-brands fa-instagram "></i></a>
            <a href="https://mail.google.com/mail/u/0/#inbox"><i class="fas fa-at "></i></a>
          </div>
        </div>
        <div class="copyright">
          <p><small>&copy; Copyright 2022, TeamToTheMoon. All rights reserved. <br>NOTE: All information and materials used only for educational purposes.</small></p>
        </div>
      </footer>
               </div>

  </body>
</html>
