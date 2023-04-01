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
                  <td><p><b><?php echo _AUTHORBY; ?> </b> <a class="link-primary" href="../controller/edit_member.php?id=<?php echo $recipeDetails['recipe_author']; ?>"><?php echo $recipeDetails['member_name']; ?></a></p></td>
                  <td><p><b><?php echo _PUBLISHED; ?> </b> <?php echo echoOutput($recipeDetails['recipe_created']); ?></p></td>
                  <td><p><b><?php echo _UPDATED; ?> </b> <?php echo echoOutput($recipeDetails['recipe_updated']); ?></p></td>
                </tr>
              </table>
            </div>

            <div class="form-block mb-4">

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $recipeDetails['recipe_id']; ?>" method="post">

               <input type="hidden" value="<?php echo $recipeDetails['recipe_author']; ?>" name="recipe_author">
               <input type="hidden" value="<?php echo $recipeDetails['recipe_id']; ?>" name="recipe_id">

               <div class="form-row">
                <div class="form-group col-12 col-lg-12">
                  <div class="block col-md-12">

                    <label class="required"><?php echo _TABLEFIELDTITLE; ?></label>
                    <input type="text" value="<?php echo $recipeDetails['recipe_title']; ?>" name="recipe_title" class="form-control" required="">

                    <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                    <textarea type="text" class="form-control" name="recipe_description"><?php echo $recipeDetails['recipe_description']; ?></textarea>

                    <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
                   <select class="custom-select form-control" name="recipe_availability">

                    <?php if($recipeDetails['recipe_availability'] == 'free'){
                      echo '<option value="free" selected="selected">'._FREE.'</option>';
                      echo '<option value="premium">'._PREMIUM.'</option>';
                    }elseif($recipeDetails['recipe_availability'] == 'premium'){
                      echo '<option value="premium" selected="selected">'._PREMIUM.'</option>';
                      echo '<option value="free">'._FREE.'</option>';
                    }
                    ?>
                  </select>

                    <br>
                    <br>

                    <fieldset>
                    <legend><?php echo _CATEGORIES; ?></legend>

                    <div class="row">
                    <?php foreach($categories as $val): ?>
                      <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <?php if(!empty($recipeDetails['recipe_categories'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['category_id'], json_decode($recipeDetails['recipe_categories'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['category_id']; ?>" name="recipe_categories[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['category_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['category_id'], json_decode($recipeDetails['recipe_categories'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['category_id']; ?>" name="recipe_categories[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['category_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['category_id']; ?>" name="recipe_categories[]" />
                      <div class="state p-success">
                      <label style="display: flex; letter-spacing: 0;"><?php echo $val['category_title']; ?></label>
                      </div>
                      </div>

                      <?php endif; ?>

                      </div>

                    <?php endforeach; ?>
                      </div>

                    </fieldset>

                    <br>

                    <fieldset>
                    <legend><?php echo _INGREDIENTS; ?></legend>

                    <?php $itemIngredients = json_decode($recipeDetails['recipe_ingredients'], true); ?>

                    <?php if(empty($itemIngredients) || !isset($itemIngredients)): ?>

                    <div class="col-md-12 p-0">
                    <div id="ingredients">

                    <div class="w-100 d-flex align-items-center ingredient-input-container" id="rowIngredient">
                    <div class="w-5 p-2">
                    <i class="move text-muted dripicons-move"></i>
                    </div>

                    <div class="w-100 p-2">
                    <input class="form-control" type="text" placeholder="<?php echo _TABLEFIELDTITLE; ?>" name="value[]" />
                    </div>

                    <div class="w-5 p-2">
                    <a class="pointer remove_ingredient"><i class="dripicons-cross text-danger h5"></i></a>
                    </div>

                    </div>
                    </div>
                    </div>

                    <?php else: ?>

                    <div class="col-md-12 p-0">
                    <div id="ingredients">

                    <?php foreach($itemIngredients as $key => $value): ?>

                    <div class="w-100 d-flex align-items-center ingredient-input-container" id="rowIngredient<?php echo $key; ?>">
                    <div class="w-5 p-2">
                    <i class="move text-muted dripicons-move"></i>
                    </div>

                    <div class="w-100 p-2">
                    <input class="form-control" type="text" value="<?php echo $value['value']; ?>" name="value[]" required />
                    </div>

                    <div class="w-5 p-2">
                    <a id="<?php echo $key; ?>" class="pointer text-danger remove_ingredient"><i class="dripicons-cross text-danger h5"></i></a>
                    </div>

                    </div>

                    <?php endforeach; ?>

                    </div>
                    </div>

                    <?php endif; ?>

                    <textarea class="mt-3 form-control" name="recipe_ingredients" id="ingredients_results" hidden><?php echo $recipeDetails['recipe_ingredients']; ?></textarea>

                    <hr>
                    <a class="btn btn-success text-white" id="addIngredient"><?php echo _ADDMORE; ?></a>

                    </fieldset>

                    <br>

                    <fieldset>
                    <legend><?php echo _STEPS; ?></legend>

                    <?php $itemSteps = json_decode($recipeDetails['recipe_steps'], true); ?>

                    <?php if(empty($itemSteps) || !isset($itemSteps)): ?>

                    <div class="col-md-12 p-0">
                    <div id="steps">

                    <div class="w-100 d-flex align-items-center step-input-container" id="rowStep">
                    <div class="w-5 p-2">
                    <i class="move text-muted dripicons-move"></i>
                    </div>

                    <div class="w-100 p-2">
                    <input class="form-control" type="text" placeholder="<?php echo _TABLEFIELDTITLE; ?>" name="value[]" />
                    </div>

                    <div class="w-5 p-2">
                    <a class="pointer remove_step"><i class="dripicons-cross text-danger h5"></i></a>
                    </div>

                    </div>
                    </div>
                    </div>

                    <?php else: ?>

                    <div class="col-md-12 p-0">
                    <div id="steps">

                    <?php foreach($itemSteps as $key => $value): ?>

                    <div class="w-100 d-flex align-items-center step-input-container" id="rowStep<?php echo $key; ?>">
                    <div class="w-5 p-2">
                    <i class="move text-muted dripicons-move"></i>
                    </div>

                    <div class="w-100 p-2">
                    <input class="form-control" type="text" value="<?php echo $value['value']; ?>" name="value[]" required />
                    </div>

                    <div class="w-5 p-2">
                    <a id="<?php echo $key; ?>" class="pointer text-danger remove_step"><i class="dripicons-cross text-danger h5"></i></a>
                    </div>

                    </div>

                    <?php endforeach; ?>

                    </div>
                    </div>

                    <?php endif; ?>

                    <textarea class="mt-3 form-control" name="recipe_steps" id="steps_results" hidden><?php echo $recipeDetails['recipe_steps']; ?></textarea>

                    <hr>
                    <a class="btn btn-success text-white" id="addStep"><?php echo _ADDMORE; ?></a>

                    </fieldset>

                    <br>

                    <label><?php echo _TABLEFIELDSTATUS; ?></label>
                   <select class="custom-select form-control" name="recipe_status">

                    <?php if($recipeDetails['recipe_status'] == 1){
                      echo '<option value="1" selected="selected">'._ENABLED.'</option>';
                      echo '<option value="2">'._DISABLED.'</option>';
                    }elseif($recipeDetails['recipe_status'] == 2){
                      echo '<option value="2" selected="selected">'._DISABLED.'</option>';
                      echo '<option value="1">'._ENABLED.'</option>';
                    }
                    ?>
                  </select>

                  <label><?php echo _TABLEFIELDFEATURED; ?></label>
                  <select class="custom-select form-control" name="recipe_featured">

                  <?php if($recipeDetails['recipe_featured'] == 1){
                    echo '<option value="1" selected="selected">'._YESTEXT.'</option>';
                    echo '<option value="0">'._NOTEXT.'</option>';
                  }elseif($recipeDetails['recipe_featured'] == 0){
                    echo '<option value="0" selected="selected">'._NOTEXT.'</option>';
                    echo '<option value="1">'._YESTEXT.'</option>';
                  }
                  ?>
                  </select>
                  
                  <label><?php echo _TABLEFIELDIMAGE; ?></label>

                  <div class="new-image" id="image-preview" style="background: url(<?php echo $target_dir; ?><?php echo $recipeDetails['recipe_image'] ?>);">
                    <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                    <input type="hidden" value="<?php echo $recipeDetails['recipe_image']; ?>" name="recipe_image_save">
                    <input type="file" name="recipe_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" />
                  </div>

                  <span class="text-danger recomendedsize"><?php echo _RECOMMENDEDSIZE; ?> <b>650 x 350</b> </span>

                  <hr>

                  <button class="btn btn-primary" type="submit" name="save"><?php echo _UPDATEITEM; ?></button>
                <button class="btn btn-danger deleteItem" type="button" data-url="../controller/delete_recipe.php?id=<?php echo $recipeDetails['recipe_id']; ?>" data-redirect="../controller/recipes.php"><?php echo _DELETEITEM; ?></button>
                

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
