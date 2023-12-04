<?php include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php 
if(isset($_SESSION['admin_name'])){
  $admin_id = $_SESSION['admin_id'];
  $query = $conn->query("SELECT * FROM requests WHERE user_id='$admin_id'");
  $query->execute();
  $requests = $query->fetchAll(PDO::FETCH_OBJ);
  $count = $query->rowCount();
}else{
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
}



?>
    <div class="container" style="margin-top: 8%;">

          <div class="row " >
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Requests</h5>
              <?php if($count == 0): ?>
                <div class="alert alert-danger mt-4">There is no request reseived yet</div>
                <?php else: ?>
              <table class="table mt-3">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">go to this property</th>
                  </tr>
                </thead>
                <tbody>
                
                <?php foreach($requests as $request): ?>
                  <tr>
                    <th scope="row"><?= $request->id; ?></th>
                    <td><?= $request->name; ?></td>
                    <td><?= $request->email; ?></td>
                    <td><?= $request->phone; ?></td>
                     <td><a href="<?= APPURL; ?>/property-details.php?id=<?= $request->prop_id; ?>" class="btn btn-success  text-center ">go</a></td>
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
  <?php include "../layouts/footer.php"; ?>
