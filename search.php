<?php require "includes/header.php"; ?>
<?php  

  if(isset($_POST['submit'])){
    $types = $_POST['types'];
    $offers = $_POST['offers'];
    $cities = $_POST['cities'];
    $select = $conn->query("SELECT * FROM props WHERE home_type LIKE '%$types%' OR type LIKE '%$offers%' OR location LIKE '%$cities%'");
    $select->execute();
    $props = $select->fetchAll(PDO::FETCH_OBJ);
    $propsNum = $select->rowCount();
}elseif(isset($_GET['price'])){
    $price = $_GET['price'];
    if($price == 'ASC' || $price == 'DESC'){
      $select = $conn->query("SELECT * FROM props ORDER BY price $price");
      $select->execute();
      $props = $select->fetchAll(PDO::FETCH_OBJ);
      $propsNum = $select->rowCount();

    }else{
      echo "<script>window.location.href='".APPURL."/404.php'</script>";
    }
    
}elseif(isset($_GET['category'])){
    $category = $_GET['category'];
    $select = $conn->query("SELECT * FROM props WHERE home_type='$category'");
    $select->execute();
    $props = $select->fetchAll(PDO::FETCH_OBJ);
    $propsNum = $select->rowCount();
}else{
  echo "<script>window.location.href='".APPURL."/404.php'</script>";
}
?>

<?php if($propsNum > 0):  ?>
    <div class="slide-one-item home-slider owl-carousel">
      <?php foreach($props as $prop): ?>
      <div class="site-blocks-cover overlay" style="background-image: url(<?= IMAGELURL; ?>/thumbnails/<?= $prop->image; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
              <span class="d-inline-block bg-<?php if($prop->type == 'sale'){echo 'success';}else{echo 'danger';}  ?> text-white px-3 mb-3 property-offer-type rounded">For <?= $prop->type; ?></span>
              <h1 class="mb-2"><?= $prop->name; ?></h1>
              <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?= $prop->price; ?></strong></p>
              <p><a href="<?= APPURL; ?>/property-details.php?id=<?= $prop->id; ?>" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
            </div>
          </div>
        </div>
      </div>  
      <?php endforeach; ?>
      

    </div>
<?php else: ?>
    <div class="slide-one-item home-slider owl-carousel">
    <div class="site-blocks-cover overlay" style="background-color:lightgray;" data-aos="fade" data-stellar-background-ratio="0.5">

        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
              <span class="d-inline-block bg-danger text-white px-3 mb-3 property-offer-type rounded">Try again</span>
              <h1 class="mb-2">There are no matching results ,please try again!</h1>
            </div>
          </div>
        </div>
      </div>  
    </div>
<?php endif; ?>

    <div class="site-section site-section-sm pb-0">
      <div class="container">
        <div class="row">
          <form class="form-search col-md-12" method="POST" action="search.php" style="margin-top: -100px;">
            <div class="row  align-items-end">
              <div class="col-md-3">
                <label for="list-types">Listing Types</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="types" id="list-types" class="form-control d-block rounded-0">
                      <?php foreach($categories as $category): ?>
                        <option value="<?= $category->name; ?>"><?= str_replace('-',' ',$category->name); ?></option>                    
                      <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="offer-types">Offer Type</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="offers" id="offer-types" class="form-control d-block rounded-0">
                    <option value="sale">For Sale</option>
                    <option value="rent">For Rent</option>
                    <option value="lease">For Lease</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="select-city">Select City</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="cities" id="select-city" class="form-control d-block rounded-0">
                    <option value="new york">New York</option>
                    <option value="brooklyn">Brooklyn</option>
                    <option value="london">London</option>
                    <option value="japan">Japan</option>
                    <option value="philippines">Philippines</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <input type="submit" name="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
              </div>
            </div>
          </form>
        </div>  
        <div class="row">
          <div class="col-md-12">
            <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
              <div class="mr-auto">
              <a href="<?= APPURL; ?>" class="view-list px-3 border-right active">All</a>
                <a href="<?= APPURL; ?>/rent-sale.php?type=rent" class="view-list px-3 border-right">Rent</a>
                <a href="<?= APPURL; ?>/rent-sale.php?type=sale" class="view-list px-3">Sale</a>
              </div>
              <div class="ml-auto d-flex align-items-center">
              <div>
                
                <a href="<?= APPURL; ?>/search.php?price=ASC" class="view-list px-3">Price Ascending</a>
                <a href="<?= APPURL; ?>/search.php?price=DESC" class="view-list px-3">Price Descending</a>

              </div>


               
              </div>
            </div>
          </div>
        </div>
        
    </div>
    <?php if($propsNum > 0):?>
    <div class="site-section site-section-sm bg-light">
      <div class="container">
      
        <div class="row mb-5">
        
        <?php foreach($props as $prop):  ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="property-details.php?id=<?= $prop->id; ?>" class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type bg-<?php if($prop->type == 'sale'){echo 'success';}else{echo 'danger';}  ?>"><?= $prop->type; ?></span>
                </div>
                <img src="<?= IMAGELURL; ?>/thumbnails/<?= $prop->image; ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <!-- <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a> -->
                <h2 class="property-title"><a href="property-details.php?id=<?= $prop->id; ?>"><?= $prop->name; ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?= $prop->location; ?></span>
                <strong class="property-price text-primary mb-3 d-block text-success">$<?= $prop->price; ?></strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number"><?= $prop->bed; ?><sup>+</sup></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number"><?= $prop->bath; ?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number"><?= $prop->sqft; ?></span>
                    
                  </li>
                </ul>

              </div>
            </div>
          </div>
         <?php endforeach; ?>
         <?php endif; ?>
        </div>
     
        
      </div>
    </div>

   
    

    <?php require "includes/footer.php"; ?>