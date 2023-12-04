<?php include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php 
if(isset($_SESSION['admin_name'])){
 if(isset($_POST['submit'])){
  if(empty($_POST['name'])){
    echo "<script>alert('Input field is empty')</script>";
  }else{
    $name = $_POST['name'];
    $final_name = str_replace(' ','-',trim($name));
    $query = $conn->prepare("INSERT INTO categories(name) VALUES (?)");
    $insert = $query->execute(array($final_name));
    if($insert){
      echo "<script>window.location.href='".ADMINURL."/categories-admins/show-categories.php'</script>";
    }
  }
 }

}else{
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
}



?>
    <div class="container-fluid mt-5">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="create-category.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php include "../layouts/footer.php"; ?>