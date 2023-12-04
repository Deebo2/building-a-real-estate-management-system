<?php 
  include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php
if(isset($_SESSION['admin_name'])){
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = $conn->query("SELECT * FROM categories WHERE id='$id'");
    $query->execute();
    $category = $query->fetch(PDO::FETCH_OBJ);
    $count = $query->rowCount();
    if($count > 0 ){
      if(isset($_POST['submit'])){
        $name = $_POST['name'];
      $update = $conn->prepare("UPDATE categories SET name=:name WHERE id=:id");
      $updateRow = $update->execute([
        ":name" => $name,
        ":id"   => $id
      ]);
      
        echo "<script>window.location.href='".ADMINURL."/categories-admins/show-categories.php'</script>";
      }
    }else{
      echo "<script>window.location.href='".ADMINURL."/categories-admins/show-categories.php'</script>";
    }
  }else{
    echo "<script>window.location.href='".APPURL."/404.php'</script>";
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
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="update-category.php?id=<?= $id; ?>" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" value="<?php 
                    if($count > 0){
                     echo $category->name;
                    }
                  ?>" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php include "../layouts/header.php"; ?>