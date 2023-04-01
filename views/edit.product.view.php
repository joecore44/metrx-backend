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
              <h5><?php echo _EDITITEM; ?></h5>
            </div>
          </div>

          <div class="col-md-12">

          <?php if(!empty($success)): ?>
          <div class="d-flex align-items-center alert alert-success" role="alert">
          <i class="icon dripicons-checkmark"></i> <?php echo $success; ?>
          </div>
          <?php endif; ?>

          <?php if(!empty($errors)): ?>
          <div class="alert alert-danger" role="alert">
          <ul>
          <?php foreach($errors as $key => $value):?>
          <li><?php echo $value; ?></li>
          <?php endforeach; ?>
          </ul>
          </div>
          <?php endif; ?>

            <div>
              <table>
                <tr>
                  <td><p><b><?php echo _AUTHORBY; ?> </b> <a class="link-primary" href="../controller/edit_member.php?id=<?php echo $productDetails['product_author']; ?>"><?php echo $productDetails['member_name']; ?></a></p></td>
                  <td><p><b><?php echo _PUBLISHED; ?> </b> <?php echo echoOutput($productDetails['product_created']); ?></p></td>
                  <td><p><b><?php echo _UPDATED; ?> </b> <?php echo echoOutput($productDetails['product_updated']); ?></p></td>
                </tr>
              </table>
            </div>

            <div class="form-block mb-4">

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $productDetails['product_id']; ?>" method="post">

               <input type="hidden" value="<?php echo $productDetails['product_author']; ?>" name="product_author">
               <input type="hidden" value="<?php echo $productDetails['product_id']; ?>" name="product_id">

               <div class="form-row">
                <div class="form-group col-12 col-lg-12">
                  <div class="block col-md-12">

                    <label class="required"><?php echo _TABLEFIELDTITLE; ?></label>
                    <input type="text" value="<?php echo $productDetails['product_title']; ?>" name="product_title" class="form-control" required="">

                    <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                    <textarea type="text" class="simpletinymce form-control" name="product_description"><?php echo $productDetails['product_description']; ?></textarea>


                   <label class="required"><?php echo _TABLEFIELDLINK; ?></label>
                      <input type="url" pattern="https?://.*" value="<?php echo $productDetails['product_link']; ?>" name="product_link" class="form-control" required="">

                      <label class="required"><?php echo _TABLEFIELDPRICE; ?></label>
                      <input type="text" value="<?php echo $productDetails['product_price']; ?>" name="product_price" class="form-control" required="">

                      <label><?php echo _TABLEFIELDOLDPRICE; ?></label>
                      <input type="text" value="<?php echo $productDetails['product_old_price']; ?>" name="product_old_price" class="form-control">

                      <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
						<select class="custom-select form-control" name="product_availability" required="">
							<?php if($productDetails['product_availability'] == 'free'){
							echo '<option value="free" selected="selected">'._FREE.'</option>';
							echo '<option value="premium">'._PREMIUM.'</option>';
							}elseif($productDetails['product_availability'] == 'premium'){
							echo '<option value="premium" selected="selected">'._PREMIUM.'</option>';
							echo '<option value="free">'._FREE.'</option>';
							}
							?>
						</select>

                    <br>
                    <br>

                    <fieldset>
                    <legend><?php echo _TAGS; ?></legend>

                    <div class="row">
                    <?php foreach($tags as $val): ?>
                      <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <?php if(!empty($productDetails['product_tags'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['tag_id'], json_decode($productDetails['product_tags'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['tag_id']; ?>" name="product_tags[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['tag_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['tag_id'], json_decode($productDetails['product_tags'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['tag_id']; ?>" name="product_tags[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['tag_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['tag_id']; ?>" name="product_tags[]" />
                      <div class="state p-success">
                      <label style="display: flex; letter-spacing: 0;"><?php echo $val['tag_title']; ?></label>
                      </div>
                      </div>

                      <?php endif; ?>

                      </div>

                    <?php endforeach; ?>
                      </div>

                    </fieldset>

                    <label><?php echo _TABLEFIELDSTATUS; ?></label>
                   <select class="custom-select form-control" name="product_status">

                    <?php if($productDetails['product_status'] == 1){
                      echo '<option value="1" selected="selected">'._ENABLED.'</option>';
                      echo '<option value="2">'._DISABLED.'</option>';
                    }elseif($productDetails['product_status'] == 2){
                      echo '<option value="2" selected="selected">'._DISABLED.'</option>';
                      echo '<option value="1">'._ENABLED.'</option>';
                    }
                    ?>
                  </select>

                  <label><?php echo _TABLEFIELDFEATURED; ?></label>
                  <select class="custom-select form-control" name="product_featured">

                  <?php if($productDetails['product_featured'] == 1){
                    echo '<option value="1" selected="selected">'._YESTEXT.'</option>';
                    echo '<option value="0">'._NOTEXT.'</option>';
                  }elseif($productDetails['product_featured'] == 0){
                    echo '<option value="0" selected="selected">'._NOTEXT.'</option>';
                    echo '<option value="1">'._YESTEXT.'</option>';
                  }
                  ?>
                  </select>
                  
                  <label class="control-label"><?php echo _TABLEFIELDGALLERY; ?></label>
                  <input type="file" name="files" class="gallery_media">

                  <label><?php echo _TABLEFIELDIMAGE; ?></label>
                  <div class="new-image" id="image-preview" style="background: url(<?php echo $target_dir; ?><?php echo $productDetails['product_image'] ?>);">
                    <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                    <input type="hidden" value="<?php echo $productDetails['product_image']; ?>" name="product_image_save">
                    <input type="file" name="product_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" />
                  </div>

                  <span class="text-danger recomendedsize"><?php echo _RECOMMENDEDSIZE; ?> <b>650 x 350</b> </span>

                  <hr>

                  <button class="btn btn-primary" type="submit" name="save"><?php echo _UPDATEITEM; ?></button>
                <button class="btn btn-danger deleteItem" type="button" data-url="../controller/delete_product.php?id=<?php echo $productDetails['product_id']; ?>" data-redirect="../controller/products.php"><?php echo _DELETEITEM; ?></button>
                

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
<?php require '../views/product.gallery.view.php'; ?>



