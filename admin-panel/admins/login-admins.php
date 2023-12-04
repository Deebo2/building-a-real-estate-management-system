<?php include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php  
  if(isset($_SESSION['admin_name'])){
    echo "<script>window.location.href='".ADMINURL."'</script>";
  }
    if(isset($_POST['submit'])){
      if(empty($_POST['email']) || empty($_POST['password'])){
        echo "<script>alert('some inputs are empty')</script>";
      }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
        $login = $conn->query("SELECT * FROM admins WHERE email='$email'");
        $login->execute();
        //Fetch data
        if($login->rowCount() > 0){
          $admin = $login->fetch(PDO::FETCH_ASSOC);
          if(password_verify($password ,$admin['admin_pass'])){
            $_SESSION['admin_name'] = $admin['admin_name'];
            $_SESSION['email']    = $admin['email'];
            $_SESSION['admin_id']  = $admin['id'];
            echo "<script>window.location.href='".ADMINURL."'</script>";
            
          }else{
            echo "<script>alert('Wrong password')</script>";
          }
        }else{
          echo "<script>alert('Wrong email')</script>";
        }
      }
    }
  ?>
    <div class="container-fluid"> 
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mt-5">Login</h5>
                  <form method="POST" class="p-auto" action="login-admins.php">
                      <!-- Email input -->
                      <div class="form-outline mb-4">
                        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                      
                      </div>

                      
                      <!-- Password input -->
                      <div class="form-outline mb-4">
                        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                        
                      </div>



                      <!-- Submit button -->
                      <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                    
                    </form>

                </div>
          </div>
        </div>
        </div>
</div>
<?php include "../layouts/footer.php"; ?>