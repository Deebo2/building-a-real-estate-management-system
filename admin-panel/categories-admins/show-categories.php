<?php include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php 
if(isset($_SESSION['admin_name'])){
  $query = $conn->query("SELECT * FROM categories");
  $query->execute();
  $categories = $query->fetchAll(PDO::FETCH_OBJ);
  $count = $query->rowCount();
}else{
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
}



?>
    <div class="container-fluid mt-5">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
              <a href="create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
               
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php if($count > 0): ?>
                <?php foreach($categories as $category): ?>
                  <tr>
                    <th scope="row"><?= $category->id; ?></th>
                    <td><?= str_replace('-',' ',$category->name); ?></td>
                    <td><a  href="update-category.php?id=<?= $category->id; ?>" class="btn btn-warning text-white text-center ">Update</a></td>
                    <td><a href="delete-category.php?id=<?= $category->id; ?>" class="btn btn-danger  text-center ">Delete</a></td>
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