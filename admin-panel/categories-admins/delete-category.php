<?php 
  include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php
if(isset($_SESSION['admin_name'])){
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = $conn->query("DELETE FROM categories WHERE id='$id'");
    $query->execute();
    echo "<script>window.location.href='".ADMINURL."/categories-admins/show-categories.php'</script>";
   
  }else{
    echo "<script>window.location.href='".APPURL."/404.php'</script>";
  }
}else{
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
}



?>