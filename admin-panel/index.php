<?php include "layouts/header.php"; 
      require "../config/config.php";
?>
<?php 
  if(!isset($_SESSION['admin_name'])){
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
  }
  $propQuery = $conn->query("SELECT count(*) AS prop_count FROM props");
  $propQuery->execute();
  $propCount = $propQuery->fetch(PDO::FETCH_OBJ);
  $adminQuery = $conn->query("SELECT count(*) AS admin_count FROM admins");
  $adminQuery->execute();
  $adminCount = $adminQuery->fetch(PDO::FETCH_OBJ);
  $catQuery = $conn->query("SELECT count(*) AS cat_count FROM categories");
  $catQuery->execute();
  $catCount = $catQuery->fetch(PDO::FETCH_OBJ);

?>
   
  <div class="container-fluid">
            
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Properties</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of properties: <?= $propCount->prop_count; ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?= $catCount->cat_count; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?= $adminCount->admin_count; ?></p>
              
            </div>
          </div>
        </div>
      </div>
 
          </div>
<?php include "layouts/footer.php"; ?>
       