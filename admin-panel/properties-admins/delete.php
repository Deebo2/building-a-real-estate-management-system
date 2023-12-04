<?php 
  include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php
if(isset($_SESSION['admin_name'])){
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select1 = $conn->query("SELECT * FROM props WHERE id='$id'");
    $select1->execute();
    $prop = $select1->fetch(PDO::FETCH_OBJ);
    unlink("thumbnails/".$prop->image);
    $select2 = $conn->query("SELECT * FROM prop_images WHERE prop_id='$id'");
    $select2->execute();
    $prop_images = $select2->fetchAll(PDO::FETCH_OBJ);
    foreach($prop_images as $image){
    unlink("images/".$image->image);
    }
    $query = $conn->query("DELETE FROM props WHERE id='$id'");
    $query->execute();
    $query2 = $conn->query("DELETE FROM prop_images WHERE prop_id='$id'");
    $query2->execute();
    echo "<script>window.location.href='".ADMINURL."/properties-admins/show-properties.php'</script>";
   
  }else{
    echo "<script>window.location.href='".APPURL."/404.php'</script>";
  }
}else{
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
}



?>