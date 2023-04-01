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
                      <input type="text" placeholder="" name="recipe_title" class="form-control" required="">

                      <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                      <textarea type="text" class="form-control" name="recipe_description"></textarea>
                      
                      <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
                      <select class="custom-select form-control" name="recipe_availability">
                        <option value="free" selected=""><?php echo _FREE; ?></option>
                        <option value="premium"><?php echo _PREMIUM; ?></option>
                      </select>
                      
                   <br>
                   <br>

                   <fieldset>
                  <legend><?php echo _CATEGORIES; ?></legend>

                  <div class="row">
                  <?php foreach($categories as $val): ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['category_id']; ?>" name="recipe_categories[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['category_title']; ?></label>
                        </div>
                      </div>
                      </div>
                  <?php endforeach; ?>
  							  </div>

                  </fieldset>

                  <br>

                  <fieldset>
                  <legend><?php echo _INGREDIENTS; ?></legend>
                  <div class="col-md-12 p-0">
                  <div id="ingredients">
                  <div class="w-100 d-flex align-items-center ingredient-input-container" id="rowIngredient1">
                  <div class="w-5 p-2">
                  <i class="move text-muted dripicons-move"></i>
                  </div>

                  <div class="w-100 p-2">
                  <input class="form-control" type="text" placeholder="<?php echo _TABLEFIELDVALUE; ?>" name="value[]" />
                  </div>

                  <div class="w-5 p-2">
                  <a id="1" class="pointer remove_ingredient"><i class="dripicons-cross text-danger h5"></i></a>
                  </div>

                  </div>
                  </div>
                  </div>

                  <textarea class="mt-3 form-control" name="recipe_ingredients" id="ingredients_results" hidden></textarea>

                  <hr>
                  <a class="btn btn-success text-white" id="addIngredient"><?php echo _ADDMORE; ?></a>

                  </fieldset>

                  <br>

                  <fieldset>
                  <legend><?php echo _STEPS; ?></legend>
                  <div class="col-md-12 p-0">
                  <div id="steps">
                  <div class="w-100 d-flex align-items-center step-input-container" id="rowStep1">
                  <div class="w-5 p-2">
                  <i class="move text-muted dripicons-move"></i>
                  </div>

                  <div class="w-100 p-2">
                  <input class="form-control" type="text" placeholder="<?php echo _TABLEFIELDVALUE; ?>" name="value[]" />
                  </div>

                  <div class="w-5 p-2">
                  <a id="1" class="pointer remove_step"><i class="dripicons-cross text-danger h5"></i></a>
                  </div>

                  </div>
                  </div>
                  </div>

                  <textarea class="mt-3 form-control" name="recipe_steps" id="steps_results" hidden></textarea>

                  <hr>
                  <a class="btn btn-success text-white" id="addStep"><?php echo _ADDMORE; ?></a>

                  </fieldset>

                  <label><?php echo _TABLEFIELDSTATUS; ?></label>
                 <select class="custom-select form-control" name="recipe_status">
                  <option value="1" selected=""><?php echo _ENABLED; ?></option>
                  <option value="2"><?php echo _DISABLED; ?></option>
                </select>

                <label><?php echo _TABLEFIELDFEATURED; ?></label>
                 <select class="custom-select form-control" name="recipe_featured">
                  <option value="0" selected=""><?php echo _NOTEXT; ?></option>
                  <option value="1"><?php echo _YESTEXT; ?></option>
                </select>

                <label class="required"><?php echo _TABLEFIELDIMAGE; ?></label>

                <div class="new-image" id="image-preview">
                  <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                  <input type="file" name="recipe_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" required />
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
