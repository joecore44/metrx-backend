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
                  <td><p><b><?php echo _AUTHORBY; ?> </b> <a class="link-primary" href="../controller/edit_member.php?id=<?php echo $exerciseDetails['exercise_author']; ?>"><?php echo $exerciseDetails['member_name']; ?></a></p></td>
                  <td><p><b><?php echo _PUBLISHED; ?> </b> <?php echo echoOutput($exerciseDetails['exercise_created']); ?></p></td>
                  <td><p><b><?php echo _UPDATED; ?> </b> <?php echo echoOutput($exerciseDetails['exercise_updated']); ?></p></td>
                </tr>
              </table>
            </div>

            <div class="form-block mb-4">

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $exerciseDetails['exercise_id']; ?>" method="post">

               <input type="hidden" value="<?php echo $exerciseDetails['exercise_author']; ?>" name="exercise_author">
               <input type="hidden" value="<?php echo $exerciseDetails['exercise_id']; ?>" name="exercise_id">

               <div class="form-row">
                <div class="form-group col-12 col-lg-12">
                  <div class="block col-md-12">

                    <label class="required"><?php echo _TABLEFIELDTITLE; ?></label>
                    <input type="text" value="<?php echo $exerciseDetails['exercise_title']; ?>" name="exercise_title" class="form-control" required="">

                    <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                    <textarea type="text" class="form-control" name="exercise_description"><?php echo $exerciseDetails['exercise_description']; ?></textarea>

                    <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
                   <select class="custom-select form-control" name="exercise_availability" required="">

                    <?php if($exerciseDetails['exercise_availability'] == 'free'){
                      echo '<option value="free" selected="selected">'._FREE.'</option>';
                      echo '<option value="premium">'._PREMIUM.'</option>';
                    }elseif($exerciseDetails['exercise_availability'] == 'premium'){
                      echo '<option value="premium" selected="selected">'._PREMIUM.'</option>';
                      echo '<option value="free">'._FREE.'</option>';
                    }
                    ?>
                  </select>

                    <label></label>
                    <select class="custom-select form-control timevsreps" name="exercise_type">
                      <option value="repsbased" <?php echo ($exerciseDetails['exercise_type'] == "repsbased" ? "selected" : null); ?>><?php echo _REPBASED; ?></option>
                      <option value="timebased" <?php echo ($exerciseDetails['exercise_type'] == "timebased" ? "selected" : null); ?>><?php echo _TIMEBASED; ?></option>
                    </select>

                    <div class="row timebased" <?php echo ($exerciseDetails['exercise_type'] == "timebased" ? null : "style='display: none'"); ?>>

                    <div class="col-12">
                    <label><?php echo _TABLEFIELDTIME ?></label>
                    <input type="number" min="5" value="<?php echo $exerciseDetails['exercise_time']; ?>" name="exercise_time" class="form-control">
                    </div>

                    </div>

                    <div class="row repsbased" <?php echo ($exerciseDetails['exercise_type'] == "repsbased" ? null : "style='display: none'"); ?>>

                    <div class="col-6">
                    <label><?php echo _TABLEFIELDREPS ?></label>
                    <input type="number" min="1" value="<?php echo $exerciseDetails['exercise_reps']; ?>" name="exercise_reps" class="form-control">
                    </div>

                    <div class="col-6">
                    <label><?php echo _TABLEFIELDSETS ?></label>
                    <input type="number" min="1" value="<?php echo $exerciseDetails['exercise_sets']; ?>" name="exercise_sets" class="form-control">
                    </div>

                    </div>

                    <label><?php echo _TABLEFIELDREST ?></label>
                    <input type="number" min="3" value="<?php echo $exerciseDetails['exercise_rest']; ?>" name="exercise_rest" class="form-control">

                    <label class="required"><?php echo _TABLEFIELDVIDEO; ?></label>
                    <input type="text" value="<?php echo $exerciseDetails['exercise_video']; ?>" name="exercise_video" class="form-control" required="">

                    <br>
                    <br>

                    <fieldset>
                    <legend><?php echo _BODYPARTS; ?></legend>

                    <div class="row">
                    <?php foreach($bodyparts as $val): ?>
                      <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <?php if(!empty($exerciseDetails['exercise_bodyparts'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['bodypart_id'], json_decode($exerciseDetails['exercise_bodyparts'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['bodypart_id']; ?>" name="exercise_bodyparts[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['bodypart_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['bodypart_id'], json_decode($exerciseDetails['exercise_bodyparts'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['bodypart_id']; ?>" name="exercise_bodyparts[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['bodypart_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['bodypart_id']; ?>" name="exercise_bodyparts[]" />
                      <div class="state p-success">
                      <label style="display: flex; letter-spacing: 0;"><?php echo $val['bodypart_title']; ?></label>
                      </div>
                      </div>

                      <?php endif; ?>

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
                    <?php if(!empty($exerciseDetails['exercise_equipments'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['equipment_id'], json_decode($exerciseDetails['exercise_equipments'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['equipment_id']; ?>" name="exercise_equipments[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['equipment_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['equipment_id'], json_decode($exerciseDetails['exercise_equipments'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['equipment_id']; ?>" name="exercise_equipments[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['equipment_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['equipment_id']; ?>" name="exercise_equipments[]" />
                      <div class="state p-success">
                      <label style="display: flex; letter-spacing: 0;"><?php echo $val['equipment_title']; ?></label>
                      </div>
                      </div>

                      <?php endif; ?>

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
                    <?php if(!empty($exerciseDetails['exercise_levels'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['level_id'], json_decode($exerciseDetails['exercise_levels'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['level_id']; ?>" name="exercise_levels[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['level_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['level_id'], json_decode($exerciseDetails['exercise_levels'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['level_id']; ?>" name="exercise_levels[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['level_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['level_id']; ?>" name="exercise_levels[]" />
                      <div class="state p-success">
                      <label style="display: flex; letter-spacing: 0;"><?php echo $val['level_title']; ?></label>
                      </div>
                      </div>

                      <?php endif; ?>

                      </div>

                    <?php endforeach; ?>
                      </div>

                    </fieldset>


                    <br>

                    <fieldset>
                    <legend><?php echo _INSTRUCTIONS; ?></legend>

                    <?php $itemInstructions = json_decode($exerciseDetails['exercise_instructions'], true); ?>

                    <?php if(empty($itemInstructions) || !isset($itemInstructions)): ?>

                    <div class="col-md-12 p-0">
                    <div id="instructions">

                    <div class="w-100 d-flex align-items-center instruction-input-container" id="rowInstruction">
                    <div class="w-5 p-2">
                    <i class="move text-muted dripicons-move"></i>
                    </div>

                    <div class="w-100 p-2">
                    <input class="form-control" type="text" placeholder="<?php echo _TABLEFIELDTITLE; ?>" name="value[]" />
                    </div>

                    <div class="w-5 p-2">
                    <a class="pointer remove_instruction"><i class="dripicons-cross text-danger h5"></i></a>
                    </div>

                    </div>
                    </div>
                    </div>

                    <?php else: ?>

                    <div class="col-md-12 p-0">
                    <div id="instructions">

                    <?php foreach($itemInstructions as $key => $value): ?>

                    <div class="w-100 d-flex align-items-center instruction-input-container" id="rowInstruction<?php echo $key; ?>">
                    <div class="w-5 p-2">
                    <i class="move text-muted dripicons-move"></i>
                    </div>

                    <div class="w-100 p-2">
                    <input class="form-control" type="text" value="<?php echo $value['value']; ?>" name="value[]" required />
                    </div>

                    <div class="w-5 p-2">
                    <a id="<?php echo $key; ?>" class="pointer text-danger remove_instruction"><i class="dripicons-cross text-danger h5"></i></a>
                    </div>

                    </div>

                    <?php endforeach; ?>

                    </div>
                    </div>

                    <?php endif; ?>

                    <textarea class="mt-3 form-control" name="exercise_instructions" id="instructions_results" hidden><?php echo $exerciseDetails['exercise_instructions']; ?></textarea>

                    <hr>
                    <a class="btn btn-success text-white" id="addInstruction"><?php echo _ADDMORE; ?></a>

                    </fieldset>

                    <br>

                    <label><?php echo _TABLEFIELDSTATUS; ?></label>
                   <select class="custom-select form-control" name="exercise_status" required="">

                    <?php if($exerciseDetails['exercise_status'] == 1){
                      echo '<option value="1" selected="selected">'._ENABLED.'</option>';
                      echo '<option value="2">'._DISABLED.'</option>';
                    }elseif($exerciseDetails['exercise_status'] == 2){
                      echo '<option value="2" selected="selected">'._DISABLED.'</option>';
                      echo '<option value="1">'._ENABLED.'</option>';
                    }
                    ?>
                  </select>

                  <label><?php echo _TABLEFIELDIMAGE; ?></label>

                  <div class="new-image" id="image-preview" style="background: url(<?php echo $target_dir; ?><?php echo $exerciseDetails['exercise_image'] ?>);">
                    <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                    <input type="hidden" value="<?php echo $exerciseDetails['exercise_image']; ?>" name="exercise_image_save">
                    <input type="file" name="exercise_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" />
                  </div>

                <span class="text-danger recomendedsize"><?php echo _RECOMMENDEDSIZE; ?> <b>650 x 350</b> </span>
                  <br/>
                
                  <hr>
                  
                <button class="btn btn-primary" type="submit" name="save"><?php echo _UPDATEITEM; ?></button>
                <button class="btn btn-danger deleteItem" type="button" data-url="../controller/delete_exercise.php?id=<?php echo $exerciseDetails['exercise_id']; ?>" data-redirect="../controller/exercises.php"><?php echo _DELETEITEM; ?></button>
                

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
