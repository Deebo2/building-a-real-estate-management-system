<?php 
session_start();
include "config/config.php";
    if(isset($_POST['submit'])){
        $prop_id = $_POST['prop_id'];
        $user_id = $_POST['user_id'];
        $insert =$conn->prepare("INSERT INTO favs (prop_id ,user_id) VALUES (:prop_id ,:user_id)");
        $insert->execute([
            ":prop_id" => $prop_id,
            ":user_id" => $user_id,
        ]);
        echo "<script>window.location.href='".APPURL."/property-details.php?id=".$prop_id."' </script>";
      
    }
    if(isset($_GET['id']) && isset($_SESSION['user_id'])){
        $prop_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];
        $delete = $conn->prepare("DELETE FROM favs WHERE prop_id='$prop_id' AND user_id='$user_id'");
        $delete->execute();
        echo "<script>window.location.href='".APPURL."/property-details.php?id=".$prop_id."' </script>";
    }else{
        echo "<script>window.location.href='".APPURL."/404.php'</script>";
      }
    












?>