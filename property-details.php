<?php require "includes/header.php"; ?>

<?php  
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $select = $conn->query("SELECT * FROM props WHERE id='$id'");
  $select->execute();
  $prop = $select->fetch(PDO::FETCH_OBJ);
  $count = $select->rowCount();
  if($count >0){
  //Get related images
  $getImages = $conn->query("SELECT image FROM prop_images WHERE prop_id='$id'");
  $getImages->execute();
  $images = $getImages->fetchAll(PDO::FETCH_OBJ);
  $imagesCount = $getImages->rowCount();
  //Get related properties
  $getRelatedProps = $conn->query("SELECT * FROM props WHERE id != '$id' AND home_type='$prop->home_type'");
  $getRelatedProps->execute();
  $relatedProps = $getRelatedProps->fetchAll(PDO::FETCH_OBJ);
  $relatedPropsCount = $getRelatedProps->rowCount();
  //Check if added to fav
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $checkFav = $conn->query("SELECT * FROM favs WHERE prop_id='$prop->id' AND user_id='$user_id'");
    $checkFav->execute();
    $checkFavCount = $checkFav->rowCount();
  }
   //Check if user add a request to this property
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $checkReq = $conn->query("SELECT * FROM requests WHERE prop_id='$prop->id' AND user_id='$user_id'");
    $checkReq->execute();
    $checkReqNum = $checkReq->rowCount();
  }
}else{
  echo "<script>window.location.href='".APPURL."/404.php'</script>";
}
 
  
}else{
  echo "<script>window.location.href='".APPURL."/404.php'</script>";
}

?>

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?= IMAGELURL; ?>/thumbnails/<?= $prop->image; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Property Details of</span>
            <h1 class="mb-2"><?= $prop->name; ?></h1>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?= $prop->price; ?></strong></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div>
              <div class="slide-one-item home-slider owl-carousel">
                <?php if($imagesCount > 0){
                  foreach($images as $image){ ?>
                <div><img src="<?= IMAGELURL; ?>/images/<?= $image->image; ?>" alt="Image" class="img-fluid"></div>
                <?php }} ?>
              </div>
            </div>
            <div class="bg-white property-body border-bottom border-left border-right">
              <div class="row mb-5">
                <div class="col-md-6">
                  <strong class="text-success h1 mb-3">$<?= $prop->price; ?></strong>
                </div>
                <div class="col-md-6">
                  <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
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
              <div class="row mb-5">
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
                  <strong class="d-block"><?= str_replace('-',' ',$prop->home_type); ?></strong>
                </div>
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
                  <strong class="d-block"><?= $prop->year_built; ?></strong>
                </div>
                <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
                  <strong class="d-block">$<?= $prop->price_sqft; ?></strong>
                </div>
              </div>
              <h2 class="h4 text-black">More Info</h2>
              <p><?= $prop->description; ?></p>
             
              <div class="row no-gutters mt-5">
                <div class="col-12">
                  <h2 class="h4 text-black mb-3">Gallery</h2>
                </div>
                <?php if($imagesCount > 0){
                  foreach($images as $image){ ?>
                  <div class="col-sm-6 col-md-4 col-lg-3">
                  <a href="<?= IMAGELURL; ?>/images/<?= $image->image; ?>" class="image-popup gal-item"><img src="<?= APPURL; ?>/images/<?= $image->image; ?>" alt="Image" class="img-fluid"></a>
                </div>
                <?php }} ?>
                
              </div>
            </div>
          </div>
          <div class="col-lg-4">

            <div class="bg-white widget border rounded">

              <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
              <?php if(isset($_SESSION['user_id'])): ?>
                <?php if( $checkReqNum == 0): ?>
              <form method="POST"  action="requests/add.php" class="form-contact-agent">
              <input type="hidden" name="prop_id" value="<?= $_GET['id'] ?>">
              <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'];?>">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                  <input type="submit" name="submit" id="phone" class="btn btn-primary" value="Send Message">
                </div>
              </form>
              <?php else: ?>
                <p>Requerst has been sent already for this user</p>
              <?php endif; ?>
              <?php else: ?>
                <p>Log in to be able to Contact the Agent</p>
              <?php endif; ?>
            </div>

            <div class="bg-white widget border rounded">
              <h3 class="h4 text-black widget-title mb-3 ml-0">Share</h3>
                  <div class="px-3" style="margin-left: -15px;">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= APPURL; ?>/property-details.php?id=<?= $prop->id; ?>&quote=<?= $prop->name; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                    <a  href="https://twitter.com/intent/tweet?text=<?= $prop->name; ?>&url=<?= APPURL; ?>/property-details.php?id=<?= $prop->id; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= APPURL; ?>/property-details.php?id=<?= $prop->id; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>    
                  </div>            
            </div>
            <?php if(isset($_SESSION['user_id'])): ?>
              
            <?php if( $checkFavCount > 0): ?>
              <a href="<?= APPURL; ?>/prop-fav.php?id=<?= $prop->id; ?> " style="margin-left:30% ;font-size:150%;"><span class="icon-heart-o" style="color: red;"> Fav</span></a>
            <?php else: ?>
            <div class="bg-white widget border rounded">
              <h3 class="h4 text-black widget-title mb-3 ml-0">Add to Fav</h3>
                  <div class="px-3" style="margin-left: -15px;">
                  <form  method="POST" action="prop-fav.php"  class="form-contact-agent">
                    <div class="form-group">
                      <input type="hidden" name="prop_id" value="<?= $prop->id; ?>"  class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="hidden"  name="user_id" value="<?= $_SESSION['user_id']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" name="submit" id="phone" class="btn btn-primary" value="Add to Fav">
                    </div>
                  </form>
                  </div>            
            </div>
            <?php endif; ?>
            <?php else: ?>
              <div class="bg-white widget border rounded">
              <h3 class="h4 text-black widget-title mb-3 ml-0">Add to Fav</h3>
              <p>Log in to be able to add this property to favorite</p>
              </div>
            <?php endif; ?>

          </div>
          
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">

        <div class="row">
          <div class="col-12">
            <div class="site-section-title mb-5">
              <h2>Related Properties</h2>
            </div>
          </div>
        </div>
      
        <div class="row mb-5">
          <?php
            if($relatedPropsCount > 0){
              foreach($relatedProps as $relatedProp){
            
          ?>
            <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="property-details.php?id=<?= $relatedProp->id; ?>" class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type bg-<?php if($relatedProp->type == 'sale'){echo 'success';}else{echo 'danger';}  ?>"><?= $relatedProp->type; ?></span>
                </div>
                <img src="<?= IMAGELURL; ?>/thumbnails/<?= $relatedProp->image; ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <!-- <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a> -->
                <h2 class="property-title"><a href="property-details.php?id=<?= $relatedProp->id; ?>"><?= $relatedProp->name; ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?= $relatedProp->location; ?></span>
                <strong class="property-price text-primary mb-3 d-block text-success">$<?= $relatedProp->price; ?></strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number"><?= $relatedProp->bed; ?><sup>+</sup></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number"><?= $relatedProp->bath; ?></span>
                    
                  </li>
                  <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number"><?= $relatedProp->sqft; ?></span>
                    
                  </li>
                </ul>

              </div>
            </div>
          </div>
          <?php }}else{
            echo "<div class='alert alert-danger'>No related properties are found!</div>";
          } ?>
                
        </div>
      </div>

      <?php require "includes/footer.php"; ?>