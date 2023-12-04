<?php include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php  
  if(isset($_SESSION['admin_name'])){
    // echo "<script>window.location.href='".APPURL."'</script>";
  
    if(isset($_POST['submit'])){
      if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])){
        echo "<script>alert('some inputs are empty')</script>";
      }else{
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $insert = $conn->prepare("INSERT INTO admins (admin_name ,email , admin_pass) VALUES (:admin_name ,:email ,:admin_pass)");
        $insert->execute([
          ":admin_name" => $username,
          ":email"    => $email,
          ":admin_pass"      => password_hash($password,PASSWORD_DEFAULT)
        ]);
        echo "<script>window.location.href='".ADMINURL."/admins/admins.php'</script>";
        
      }
    }
  }else{
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
  }

?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php include "../layouts/footer.php";
?>