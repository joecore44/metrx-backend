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
                      <input type="text" placeholder="" name="exercise_title" class="form-control" required="">

                      <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                      <textarea type="text" class="form-control" name="exercise_description"></textarea>
                      
                      <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
                      <select class="custom-select form-control" name="exercise_availability">
                        <option value="free" selected=""><?php echo _FREE; ?></option>
                        <option value="premium"><?php echo _PREMIUM; ?></option>
                      </select>
                      
                      <label></label>
                        <select class="custom-select form-control timevsreps" name="exercise_type">
                          <option value="repsbased" selected><?php echo _REPBASED; ?></option>
                          <option value="timebased"><?php echo _TIMEBASED; ?></option>
                        </select>

                      <div class="row timebased" style="display: none;">

                      <div class="col-12">
                      <label><?php echo _TABLEFIELDTIME ?></label>
                      <input type="number" min="5" placeholder="<?php echo _VALUEINSECONDS ?>" name="exercise_time" class="form-control">
                      </div>

                      </div>

                      <div class="row repsbased">

                      <div class="col-6">
                      <label><?php echo _TABLEFIELDREPS ?></label>
                      <input type="number" min="1" value="1" name="exercise_reps" class="form-control">
                      </div>

                      <div class="col-6">
                      <label><?php echo _TABLEFIELDSETS ?></label>
                      <input type="number" min="1" value="1" name="exercise_sets" class="form-control">
                      </div>

                      </div>

                      <label><?php echo _TABLEFIELDREST ?></label>
                      <input type="number" min="3" placeholder="<?php echo _VALUEINSECONDS ?>" name="exercise_rest" class="form-control">

                      <label class="required"><?php echo _TABLEFIELDVIDEO ?></label>
                      <input type="text" placeholder="" name="exercise_video" class="form-control" required="">

                   <br>
                   <br>

                   <fieldset>
                  <legend><?php echo _BODYPARTS; ?></legend>

                  <div class="row">
                  <?php foreach($bodyparts as $val): ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['bodypart_id']; ?>" name="exercise_bodyparts[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['bodypart_title']; ?></label>
                        </div>
                      </div>
                      </div>
                  <?php endforeach; ?>
  							  </div>

                  </fieldset>

                  <br>

                  <fieldset>
                  <legend><?php echo _EQUIPMENTS; ?></legend>

                  <div class="row">
                  <?php foreach($equipments as $val): ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['equipment_id']; ?>" name="exercise_equipments[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['equipment_title']; ?></label>
                        </div>
                      </div>
                      </div>
                  <?php endforeach; ?>
  							  </div>

                  </fieldset>

                  <br>

                  <fieldset>
                  <legend><?php echo _LEVELS; ?></legend>

                  <div class="row">
                  <?php foreach($levels as $val): ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['level_id']; ?>" name="exercise_levels[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['level_title']; ?></label>
                        </div>
                      </div>
                      </div>
                  <?php endforeach; ?>
                  </div>

                  </fieldset>

                  <br>

                  <fieldset>
                  <legend><?php echo _INSTRUCTIONS; ?></legend>
                  <div class="col-md-12 p-0">
                  <div id="instructions">
                  <div class="w-100 d-flex align-items-center instruction-input-container" id="rowInstruction1">
                  <div class="w-5 p-2">
                  <i class="move text-muted dripicons-move"></i>
                  </div>

                  <div class="w-100 p-2">
                  <input class="form-control" type="text" placeholder="<?php echo _TABLEFIELDVALUE; ?>" name="value[]" />
                  </div>

                  <div class="w-5 p-2">
                  <a id="1" class="pointer remove_instruction"><i class="dripicons-cross text-danger h5"></i></a>
                  </div>

                  </div>
                  </div>
                  </div>

                  <textarea class="mt-3 form-control" name="exercise_instructions" id="instructions_results" hidden></textarea>

                  <hr>
                  <a class="btn btn-success text-white" id="addInstruction"><?php echo _ADDMORE; ?></a>

                  </fieldset>

                  <label><?php echo _TABLEFIELDSTATUS; ?></label>
                 <select class="custom-select form-control" name="exercise_status">
                  <option value="1" selected=""><?php echo _ENABLED; ?></option>
                  <option value="2"><?php echo _DISABLED; ?></option>
                </select>

                <label class="required"><?php echo _TABLEFIELDIMAGE; ?></label>
                <div class="new-image" id="image-preview">
                  <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                  <input type="file" name="exercise_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" required />
                </div>

                <span class="text-danger recomendedsize"><?php echo _RECOMMENDEDSIZE; ?> <b>650 x 350</b> </span>
                <br/>

              <hr>

              <button class="btn btn-primary" type="submit" name="save"><?php echo _SAVECHANGES; ?></button>

                  <br>

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
