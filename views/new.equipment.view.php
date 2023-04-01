<?php require 'header.php'; ?>
<?php require 'sidebar.php'; ?>

<!--Page Container--> 
<section class="page-container">
  <div class="page-content-wrapper">

    <!--Main Content-->

    <div class="content sm-gutter">
      <div class="container-fluid padding-25 sm-padding-10">
        <div class="row">
          <div class="col-12">
            <div class="section-title">
              <h5><?php echo _ADDITEM; ?></h5>
            </div>
          </div>

          <div class="col-md-12">

          <?php if(!empty($errors)): ?>
          <div class="alert alert-danger" role="alert">
          <ul>
          <?php foreach($errors as $key => $value):?>
          <li><?php echo $value; ?></li>
          <?php endforeach; ?>
          </ul>
          </div>
          <?php endif; ?>
          
            <div class="form-block mb-4">

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <div class="form-row">
                  <div class="form-group col-12 col-lg-12">
                    <div class="block col-md-12">

                      <label class="required"><?php echo _TABLEFIELDTITLE; ?></label>
                      <input type="text" placeholder="" name="equipment_title" class="form-control" required="">

                      <label><?php echo _TABLEFIELDSTATUS; ?></label>
                      <select class="custom-select form-control" name="equipment_status">
                      <option value="1" selected=""><?php echo _ENABLED; ?></option>
                      <option value="0"><?php echo _DISABLED; ?></option>
                      </select>

                      <label class="required"><?php echo _TABLEFIELDIMAGE; ?></label>
                      <div class="new-image" id="image-preview">
                      <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                      <input type="file" name="equipment_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" required="" />
                      </div>

                      <span class="text-danger recomendedsize"><?php echo _RECOMMENDEDSIZE; ?> <b>350 x 350</b> </span>


                      <hr>

                    <button class="btn btn-primary" type="submit" name="save"><?php echo _SAVECHANGES; ?></button>


                    </div>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require 'footer.php'; ?>
