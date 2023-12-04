
<?php include "../includes/header.php" ?>
<?php 
    if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $query = $conn->query("SELECT p.id,p.name,p.location,p.price,p.image,p.bed,p.bath,p.sqft,p.home_type,p.year_built,p.type,p.price_sqft,p.description,p.admin_name,p.created_at FROM props p INNER JOIN requests r ON p.id = r.prop_id WHERE r.user_id='$user_id'");
    $query->execute();
    $requests = $query->fetchAll(PDO::FETCH_OBJ);
    $requestsNum = $query->rowCount();
    }else{
        echo "<script>window.location.href='".APPURL."/404.php'</script>";
      }
?>
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?= APPURL; ?>/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">Requests</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      
      <div class="row mb-5 mt-5">
      <?php if($requestsNum > 0): ?>
      <?php foreach($requests as $prop):  ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="property-entry h-100">
            <a href="<?= APPURL; ?>/property-details.php?id=<?= $prop->id; ?>" class="property-thumbnail">
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
        
      <?php else: ?>
        <div class="alert alert-danger" style="margin-left:auto;margin-right:auto;">None Request has been sent yet</div>
      <?php endif; ?>
    </div>
   
      
    </div>
    <?php include "../includes/footer.php" ?>