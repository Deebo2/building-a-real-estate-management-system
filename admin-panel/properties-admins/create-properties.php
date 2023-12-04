<?php include "../layouts/header.php";
      require "../../config/config.php";
?>
<?php 
$errors = [];
if(!isset($_SESSION['admin_name'])){
  echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
}
//Get all categories
$select = $conn->query("SELECT * FROM categories");
$select->execute();
$categories = $select->fetchAll(PDO::FETCH_OBJ);
//Inserting prop
$id = '';
if(isset($_POST['submit'])){
  if(empty($_POST['name'])){
    $errors['name']="Name field is required";
  }
  if(empty($_POST['location'])){
    $errors['location']="location field is required";
  }
  if(empty($_POST['price'])){
    $errors['price']="price field is required";
  }
  if(empty($_POST['beds'])){
    $errors['beds']="beds field is required";
  }
  if(empty($_POST['baths'])){
    $errors['baths']="baths field is required";
  }
  if(empty($_POST['sq_ft'])){
    $errors['sq_ft']="sq_ft field is required";
  }

   if(empty($_POST['year_built'])){
    $errors['year_built']="year_built field is required";
  }
  if(empty($_POST['price_sqft'])){
    $errors['price_sqft']="price_sqft field is required";
  }
  if(empty($_POST['home_type'])){
    $errors['home_type']="home_type field is required";
  }
  if(empty($_POST['type'])){
    $errors['type']="type field is required";
  }
  if(empty($_POST['description'])){
    $errors['description']="description field is required";
  }
 if(empty($errors)){
  $name = $_POST['name'];
  $location = $_POST['location'];
  $price = $_POST['price'];
  $bed = $_POST['beds'];
  $bath = $_POST['baths'];
  $sqft = $_POST['sq_ft'];

   $home_type = $_POST['home_type'];
   $year_built = $_POST['year_built'];
    $type = $_POST['type'];
    $price_sqft = $_POST['price_sqft'];
    $description = $_POST['description'];
    $admin_name = $_SESSION['admin_name'];
    $image = $_FILES['thumbnail']['name'];
    $ext1 = pathinfo($image,PATHINFO_EXTENSION);
    $file_name1 = str_replace('.','-',basename($image,$ext1));
    $newFileName1 = $file_name1.time().".".$ext1;
    $dir = 'thumbnails/'.$newFileName1;
    $sql = $conn->prepare("INSERT INTO props(name, location, price, image, bed, bath, sqft, home_type, year_built, type, price_sqft, description, admin_name) VALUES (:name, :location, :price, :image, :bed, :bath, :sqft, :home_type, :year_built, :type, :price_sqft, :description, :admin_name)");
    $insert = $sql->execute([
      ":name" => $name,
      ":location" => $location,
      ":price" => $price,
      ":image" => $newFileName1,
      ":bed" => $bed,
      ":bath" => $bath,
      ":sqft" => $sqft,
      ":home_type" => $home_type,
      ":year_built" => $year_built,
      ":type" => $type,
      ":price_sqft" => $price_sqft,
      ":description" => $description,
      ":admin_name" => $admin_name,
    ]);
    if(move_uploaded_file($_FILES['thumbnail']['tmp_name'],$dir)){
      
    }
    //Insert related images to the table
    $id = $conn->lastInsertId();

    foreach($_FILES['image']['name'] as $key=>$val){
     $image_name = $val;
     $image_tmp_name = $_FILES['image']['tmp_name'][$key];
     $ext = pathinfo($image_name,PATHINFO_EXTENSION);
     $file_name = str_replace('.','-',basename($image_name,$ext));
     $newFileName = $file_name.time().".".$ext;
      move_uploaded_file($image_tmp_name,'images/'.$newFileName);
     $sqlGalery = $conn->prepare("INSERT INTO prop_images(image ,prop_id) VALUES (:image ,:prop_id)");
     $sqlGalery->execute([
      ":image"   => $newFileName,
      ":prop_id" => $id
     ]);

     echo "<script>window.location.href='".ADMINURL."/properties-admins/show-properties.php'</script>";

    }
 }
}


?>
    <div class="container mt-5">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Properties</h5>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                        </div>    
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="location" id="form2Example1" class="form-control" placeholder="location" />
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="beds" id="form2Example1" class="form-control" placeholder="beds" />
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="baths" id="form2Example1" class="form-control" placeholder="baths" />
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="sq_ft" id="form2Example1" class="form-control" placeholder="SQ/FT" />
                        </div>   
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="year_built" id="form2Example1" class="form-control" placeholder="Year Build" />
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price_sqft" id="form2Example1" class="form-control" placeholder="Price Per SQ FT" />
                        </div> 
                        
                        <select name="home_type" class="form-control form-select" aria-label="Default select example">
                            <option selected>Select Home Type</option>
                            <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat->name; ?>"><?= str_replace('-',' ',$cat->name); ?></option>
                            <?php endforeach; ?>
                        </select>   
                        <select name="type" class="form-control mt-3 mb-4 form-select" aria-label="Default select example">
                            <option selected>Select Type</option>
                            <option value="Rent">Rent</option>
                            <option value="Sale">Sale</option>
                            <option value="Condo">Condo</option>
                        </select>  
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea placeholder="Description" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Property Thumbnail</label>
                            <input name="thumbnail" class="form-control" type="file" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Gallery Images</label>
                            <input name="image[]" class="form-control" type="file" id="formFileMultiple" multiple>
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