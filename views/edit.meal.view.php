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
                  <td><p><b><?php echo _AUTHORBY; ?> </b> <a class="link-primary" href="../controller/edit_member.php?id=<?php echo $mealDetails['meal_author']; ?>"><?php echo $mealDetails['member_name']; ?></a></p></td>
                  <td><p><b><?php echo _PUBLISHED; ?> </b> <?php echo echoOutput($mealDetails['meal_created']); ?></p></td>
                  <td><p><b><?php echo _UPDATED; ?> </b> <?php echo echoOutput($mealDetails['meal_updated']); ?></p></td>
                </tr>
              </table>
            </div>

            <div class="form-block mb-4">

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $mealDetails['meal_id']; ?>" method="post">

               <input type="hidden" value="<?php echo $mealDetails['meal_author']; ?>" name="meal_author">
               <input type="hidden" value="<?php echo $mealDetails['meal_id']; ?>" name="meal_id">

               <div class="form-row">
                <div class="form-group col-12 col-lg-12">
                  <div class="block col-md-12">

                    <label class="required"><?php echo _TABLEFIELDTITLE; ?></label>
                    <input type="text" value="<?php echo $mealDetails['meal_title']; ?>" name="meal_title" class="form-control" required="">

                    <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                    <textarea type="text" class="form-control" name="meal_description"><?php echo $mealDetails['meal_description']; ?></textarea>

                    <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
                    <select class="custom-select form-control" name="meal_availability">

                      <?php if($mealDetails['meal_availability'] == 'free'){
                        echo '<option value="free" selected="selected">'._FREE.'</option>';
                        echo '<option value="premium">'._PREMIUM.'</option>';
                      }elseif($mealDetails['meal_availability'] == 'premium'){
                        echo '<option value="premium" selected="selected">'._PREMIUM.'</option>';
                        echo '<option value="free">'._FREE.'</option>';
                      }
                      ?>
                    </select>

                    <label><?php echo _TABLEFIELDCALORIES; ?></label>
                    <input type="number" value="<?php echo $mealDetails['meal_calories']; ?>" name="meal_calories" class="form-control">

                    <br>
                    <br>

                    <fieldset>
                    <legend><?php echo _CATEGORIES; ?></legend>

                    <div class="row">
                    <?php foreach($categories as $val): ?>
                      <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <?php if(!empty($mealDetails['meal_categories'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['category_id'], json_decode($mealDetails['meal_categories'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['category_id']; ?>" name="meal_categories[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['category_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['category_id'], json_decode($mealDetails['meal_categories'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['category_id']; ?>" name="meal_categories[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['category_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['category_id']; ?>" name="meal_categories[]" />
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

                  <legend><?php echo _TABLEFIELDTRAINER; ?></legend>
                  <select class="selectDrop form-control" name="meal_trainer">
                  <?php foreach($trainers as $val): ?>
                  <?php if($mealDetails['meal_trainer'] == $val['member_id']): ?>
                  <option value="<?php echo $val['member_id']; ?>" selected><?php echo $val['member_name']; ?></option>
                  <?php else: ?>
                  <option value selected>-</option>
                  <option value="<?php echo $val['member_id']; ?>"><?php echo $val['member_name']; ?></option>
                  <?php endif; ?>

                  <?php endforeach; ?>
                  </select>

                    <label><?php echo _TABLEFIELDSTATUS; ?></label>
                   <select class="custom-select form-control" name="meal_status" required="">

                    <?php if($mealDetails['meal_status'] == 1){
                      echo '<option value="1" selected="selected">'._ENABLED.'</option>';
                      echo '<option value="2">'._DISABLED.'</option>';
                    }elseif($mealDetails['meal_status'] == 2){
                      echo '<option value="2" selected="selected">'._DISABLED.'</option>';
                      echo '<option value="1">'._ENABLED.'</option>';
                    }
                    ?>
                  </select>

                  <label><?php echo _TABLEFIELDFEATURED; ?></label>
                  <select class="custom-select form-control" name="meal_featured">

                  <?php if($mealDetails['meal_featured'] == 1){
                    echo '<option value="1" selected="selected">'._YESTEXT.'</option>';
                    echo '<option value="0">'._NOTEXT.'</option>';
                  }elseif($mealDetails['meal_featured'] == 0){
                    echo '<option value="0" selected="selected">'._NOTEXT.'</option>';
                    echo '<option value="1">'._YESTEXT.'</option>';
                  }
                  ?>
                  </select>

                  <br>
                  <br>

                    <!-- START DAILY -->

                    <div class="daily">

                    <fieldset>
                    <legend><?php echo _DAILYPLAN; ?></legend>

                    <div id="accordion" class="accordion">
                    <div class="days">

                    <?php if(isset($mealDetails['meal_days'])): ?>
                    <?php if(!empty($mealDetails['meal_days'])): ?>

                    <?php $dailyMeals = json_decode($mealDetails['meal_days'], true); ?>

                    <?php foreach($dailyMeals as $dayNumber => $dayDetails): ?>
                    <div id="day_<?php echo $dayNumber+1; ?>" class="card mb-3 p-3 single-day">

                    <div class="card-header bg-white rounded border" style="cursor: pointer;" data-toggle="collapse" data-target="#collapse_<?php echo $dayNumber+1; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $dayNumber+1; ?>">
                    <div class="row d-flex align-items-center no-gutters">
                    <div class="col-6">
                    <p class="day_title m-0 font-weight-bold"><?php echo _DAYTEXT; ?> <?php echo $dayNumber+1; ?></p>
                    </div>
                    <div class="col-6 text-right"><a class="btn btn-danger text-white btn-small remove_day"><?php echo _DELETEDAY; ?></a></div>
                    </div>
                    </div>

                    <div id="collapse_<?php echo $dayNumber+1; ?>" class="collapse" aria-labelledby="day_<?php echo $dayNumber+1; ?>" data-parent="#accordion">

                      <?php foreach($dayDetails as $dayKey => $meals): ?>
                      <?php for($mealNumber = 0; $mealNumber < count($meals); $mealNumber++): ?>

                      <div class="card mb-3 mt-3 p-3">
                      <div class="row">
                      <div class="col-6"><p><?php echo _MEALTEXT; ?> <?php echo $mealNumber+1; ?></p></div>
                      <div class="col-6 text-right">
                        <a class="btn btn-success text-white btn-small open-modal-daily" data-toggle="modal" data-day="<?php echo $dayNumber+1; ?>" data-meal="<?php echo $mealNumber+1; ?>" data-target="#v"><?php echo _ADDMEAL; ?></a>
                        <a class="btn btn-info text-white btn-small add_input_recipe" data-meal="<?php echo $mealNumber+1; ?>" data-day="<?php echo $dayNumber+1; ?>"><?php echo _ADDMANUALRECIPE; ?></a>
                      </div>
                      </div>
                      <hr>
                      <div class="meal<?php echo $mealNumber+1; ?> single-meal">
                      <div class="table-responsive">
                      <table class="table">
                      <thead>
                      <tr>
                      <th scope="col text-truncate"><?php echo _TABLEFIELDTITLE; ?></th>
                      <th scope="col"></th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php foreach($meals as $mealKey => $mealMeals): ?>

                      <?php if($mealKey == "meal".$mealNumber+1): ?>

                      <?php foreach($mealMeals as $key => $value3): ?>

                      <?php if(isset($value3['title'])): ?>

                        <tr class="day<?php echo $dayNumber+1; ?>_meal<?php echo $mealNumber+1; ?>_row<?php echo $key+1; ?> is_input_recipe" style="cursor: move;">
                        <td class="text-center" colspan="8"><div class="input-group"> <input class="form-control" value="<?php echo $value3['title']; ?>" name="title[]" placeholder="<?= _TABLEFIELDTITLE ?>" style="border-top-right-radius: .25rem; border-bottom-right-radius: .25rem;"> <span class="input-group-addon" style="border: 0; padding-right: 0;"><a class="btn btn-small btn-danger text-white remove_input_recipe pointer" data-day="<?php echo $dayNumber+1; ?>" data-meal="<?php echo $mealNumber+1; ?>"><?php echo _DELETEITEM; ?></a></span> </div></td>
                        </tr>

                      <?php else: ?>

                      <?php foreach($recipes As $value4): ?>
                      <?php if($value3['recipeid'] == $value4['recipe_id']): ?>

                      <tr class="day<?php echo $dayNumber+1; ?>_meal<?php echo $mealNumber+1; ?>_row<?php echo $key+1; ?>" style="cursor: move;">
                      <td><span class="recipeid d-none"><?php echo $value4['recipe_id']; ?></span><span class="recipetitle"><?php echo $value4['recipe_title']; ?></span></td>
                      <th class="text-right" scope="row">
                      <a class="btn btn-small btn-danger text-white remove_day_item"><?php echo _DELETEITEM ?></a> 
                      <a class="btn btn-small btn-primary text-white open-edit-modal-daily" data-row="<?php echo $key+1; ?>" data-day="<?php echo $dayNumber+1; ?>" data-meal="<?php echo $mealNumber+1; ?>" data-target="#v" data-toggle="modal"><?php echo _EDITITEM; ?></a>
                      </th>
                      </tr>

                      <?php endif; ?>
                      <?php endforeach; ?>
                      <?php endif; ?>

                      <?php endforeach; ?>

                      <?php endif; ?>

                      <?php endforeach; ?>

                      </tbody>
                      </table>
                      </div>
                      </div>
                      </div>

                      <?php endfor; ?>
                      <?php endforeach; ?>

                    </div>
                    </div>

                    <?php endforeach; ?>

                    <?php else: ?>

                    <div id="day_1" class="card mb-3 p-3 single-day">
                    <div class="card-header bg-white rounded border" style="cursor: pointer;" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" aria-controls="collapse_1">
                    <div class="row d-flex align-items-center no-gutters">
                    <div class="col-6">
                    <p class="day_title m-0 font-weight-bold"><?php echo _DAYTEXT; ?> 1</p>
                    </div>
                    <div class="col-6 text-right"><a class="btn btn-danger text-white btn-small remove_day"><?php echo _DELETEDAY; ?></a></div>
                    </div>
                    </div>
                    <div id="collapse_1" class="collapse" aria-labelledby="day_1" data-parent="#accordion">

                    <?php for($i = 1; $i < 8; $i++): ?>
                    <div class="card mb-3 mt-3 p-3">
                    <div class="row">
                    <div class="col-6"><p><?php echo _MEALTEXT; ?> <?php echo $i; ?></p></div>
                    <div class="col-6 text-right"><a class="btn btn-success text-white btn-small open-modal-daily" data-toggle="modal" data-day="1" data-meal="<?php echo $i; ?>" data-target="#v"><?php echo _ADDMEAL; ?></a></div>
                    </div>
                    <hr>
                    <div class="meal<?php echo $i; ?> single-meal">
                    <div class="table-responsive">
                    <table class="table">
                    <thead>
                    <tr>
                    <th scope="col"><?php echo _TABLEFIELDID; ?></th>
                    <th scope="col text-truncate"><?php echo _TABLEFIELDTITLE; ?></th>
                    <th scope="col"><?php echo _TABLEFIELDTYPE; ?></th>
                    <th scope="col"><?php echo _TABLEFIELDREPS; ?></th>
                    <th scope="col"><?php echo _TABLEFIELDSETS; ?></th>
                    <th scope="col"><?php echo _TABLEFIELDTIME; ?></th>
                    <th scope="col"><?php echo _TABLEFIELDREST; ?></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    <?php endfor; ?>

                    </div>
                    </div>

                    <?php endif; ?>
                    <?php endif; ?>

                    </div>
                    </div>

                    <hr>

                    <div>
                      <a class="btn btn-primary text-white" id="addDay"><?php echo _ADDDAY; ?></a>
                    </div>


                    </fieldset>
                    </div>

                    <!-- END DAILY -->

                  <textarea rows="5" class="mt-3 form-control" name="meal_days" id="meal_days" hidden><?php echo $mealDetails['meal_days'] ?></textarea>

                  <label><?php echo _TABLEFIELDIMAGE; ?></label>

                  <div class="new-image" id="image-preview" style="background: url(<?php echo $target_dir; ?><?php echo $mealDetails['meal_image'] ?>);">
                    <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                    <input type="hidden" value="<?php echo $mealDetails['meal_image']; ?>" name="meal_image_save">
                    <input type="file" name="meal_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" />
                  </div>

                <span class="text-danger recomendedsize"><?php echo _RECOMMENDEDSIZE; ?> <b>650 x 350</b> </span>
                  <br/>
                
                  <hr>
                  
                <button class="btn btn-primary" type="submit" name="save"><?php echo _UPDATEITEM; ?></button>
                <button class="btn btn-danger deleteItem" type="button" data-url="../controller/delete_meal.php?id=<?php echo $mealDetails['meal_id']; ?>" data-redirect="../controller/meals.php"><?php echo _DELETEITEM; ?></button>
                

              </form></div></div></div></div></div></div></section>

<?php require '../views/daily-meal.view.php'; ?>
<?php require 'footer.php'; ?>