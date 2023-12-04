<?php require "../includes/header.php";
      require_once("../config/config.php");
?>
<?php  
  if(isset($_SESSION['username'])){
    echo "<script>window.location.href='".APPURL."'</script>";
  }
    if(isset($_POST['submit'])){
      if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])){
        echo "<script>alert('some inputs are empty')</script>";
      }else{
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $insert = $conn->prepare("INSERT INTO users (name ,email , pwd) VALUES (:username ,:email ,:pwd)");
        $insert->execute([
          ":username" => $username,
          ":email"    => $email,
          ":pwd"      => password_hash($password,PASSWORD_DEFAULT)
        ]);
        echo "<script>window.location.href='".APPURL."/auth/login.php'</script>";
        
      }
    }

?>

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?= APPURL; ?>/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">Register</h1>
          </div>
        </div>
      </div>
    </div>
    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
            <h3 class="h4 text-black widget-title mb-3">Register</h3>
            <form action="register.php" method="POST" class="form-contact-agent">

            <div class="form-group">
                <label for="email">Username</label>
                <input type="username" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="phone" class="btn btn-primary" value="Register">
            </div>
            </form>
          </div>
         
        </div>
      </div>
    </div>

    <?php require "../includes/footer.php"; ?>