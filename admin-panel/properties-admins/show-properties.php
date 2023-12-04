<?php include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php 
if(isset($_SESSION['admin_name'])){
  $query = $conn->query("SELECT * FROM props");
  $query->execute();
  $props = $query->fetchAll(PDO::FETCH_OBJ);
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
              <h5 class="card-title mb-4 d-inline">Properties</h5>
              <a href="create-properties.php" class="btn btn-primary mb-4 text-center float-right">Create Properties</a>

              <table class="table mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">price</th>
                    <th scope="col">home type</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($count > 0): ?>
                <?php foreach($props as $prop): ?>
                  <tr>
                    <th scope="row"><?= $prop->id; ?></th>
                    <td><?= $prop->name; ?></td>
                    <td><?= $prop->price; ?></td>
                    <td><?= str_replace('-',' ',$prop->home_type); ?></td>
                     <td><a href="delete.php?id=<?= $prop->id; ?>" class="btn btn-danger  text-center ">delete</a></td>
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