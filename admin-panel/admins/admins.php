<?php include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php 
if(isset($_SESSION['admin_name'])){
  $query = $conn->query("SELECT * FROM admins");
  $query->execute();
  $admins = $query->fetchAll(PDO::FETCH_OBJ);
  $count = $query->rowCount();
}else{
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
}



?>
    <div class="container-fluid">

          <div class="row">
        <div class="col-12 mt-5">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($count > 0): ?>
                <?php foreach($admins as $admin): ?>
                  <tr>
                    <th scope="row"><?= $admin->id; ?></th>
                    <td><?= $admin->admin_name; ?></td>
                    <td><?= $admin->email; ?></td>
                   
                  </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
                
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



  </div>
  <?php include "../layouts/footer.php";
?>