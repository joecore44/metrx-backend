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
                      <input type="text" placeholder="" name="product_title" class="form-control" required="">

                      <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                      <textarea type="text" class="simpletinymce form-control" name="product_description"></textarea>
                      
                      <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
                      <select class="custom-select form-control" name="product_availability">
                        <option value="free" selected=""><?php echo _FREE; ?></option>
                        <option value="premium"><?php echo _PREMIUM; ?></option>
                      </select>

                      <label class="required"><?php echo _TABLEFIELDLINK; ?></label>
                      <input type="url" pattern="https?://.*" placeholder="" name="product_link" class="form-control" required="">

                      <label class="required"><?php echo _TABLEFIELDPRICE; ?></label>
                      <input class="form-control" name="product_price" type="text" required="">
                      
                      <label><?php echo _TABLEFIELDOLDPRICE; ?></label>
                      <input class="form-control" name="product_old_price" type="text">

                   <br>
                   <br>

                   <fieldset>
                  <legend><?php echo _TAGS; ?></legend>

                  <div class="row">
                  <?php foreach($tags as $val): ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['tag_id']; ?>" name="product_tags[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['tag_title']; ?></label>
                        </div>
                      </div>
                      </div>
                  <?php endforeach; ?>
  							  </div>

                  </fieldset>

                  <label><?php echo _TABLEFIELDSTATUS; ?></label>
                 <select class="custom-select form-control" name="product_status">
                  <option value="1" selected=""><?php echo _ENABLED; ?></option>
                  <option value="2"><?php echo _DISABLED; ?></option>
                </select>

                <label><?php echo _TABLEFIELDFEATURED; ?></label>
                 <select class="custom-select form-control" name="product_featured">
                  <option value="0" selected=""><?php echo _NOTEXT; ?></option>
                  <option value="1"><?php echo _YESTEXT; ?></option>
                </select>

                <label class="required"><?php echo _TABLEFIELDIMAGE; ?></label>
                <div class="new-image" id="image-preview">
                  <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                  <input type="file" name="product_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" required />
                </div>

                <span class="text-danger recomendedsize"><?php echo _RECOMMENDEDSIZE; ?> <b>650 x 350</b> </span>
                <br/>

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
