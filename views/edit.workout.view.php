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
                  <td><p><b><?php echo _AUTHORBY; ?> </b> <a class="link-primary" href="../controller/edit_member.php?id=<?php echo $workoutDetails['workout_author']; ?>"><?php echo $workoutDetails['member_name']; ?></a></p></td>
                  <td><p><b><?php echo _PUBLISHED; ?> </b> <?php echo echoOutput($workoutDetails['workout_created']); ?></p></td>
                  <td><p><b><?php echo _UPDATED; ?> </b> <?php echo echoOutput($workoutDetails['workout_updated']); ?></p></td>
                </tr>
              </table>
            </div>

            <div class="form-block mb-4">

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $workoutDetails['workout_id']; ?>" method="post">

               <input type="hidden" value="<?php echo $workoutDetails['workout_author']; ?>" name="workout_author">
               <input type="hidden" value="<?php echo $workoutDetails['workout_id']; ?>" name="workout_id">

               <div class="form-row">
                <div class="form-group col-12 col-lg-12">
                  <div class="block col-md-12">

                    <label class="required"><?php echo _TABLEFIELDTITLE; ?></label>
                    <input type="text" value="<?php echo $workoutDetails['workout_title']; ?>" name="workout_title" class="form-control" required="">

                    <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                    <textarea type="text" class="form-control" name="workout_description"><?php echo $workoutDetails['workout_description']; ?></textarea>

                    <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
                   <select class="custom-select form-control" name="workout_availability" required="">

                    <?php if($workoutDetails['workout_availability'] == 'free'){
                      echo '<option value="free" selected="selected">'._FREE.'</option>';
                      echo '<option value="premium">'._PREMIUM.'</option>';
                    }elseif($workoutDetails['workout_availability'] == 'premium'){
                      echo '<option value="premium" selected="selected">'._PREMIUM.'</option>';
                      echo '<option value="free">'._FREE.'</option>';
                    }
                    ?>
                  </select>

                  <label><?php echo _TABLEFIELDRATE; ?></label>
                  <input type="number" min="1" max="3" value="<?php echo $workoutDetails['workout_rate']; ?>" name="workout_rate" class="form-control">

                    <br>
                    <br>

                    <fieldset>
                    <legend><?php echo _BODYPARTS; ?></legend>

                    <div class="row">
                    <?php foreach($bodyparts as $val): ?>
                      <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <?php if(!empty($workoutDetails['workout_bodyparts'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['bodypart_id'], json_decode($workoutDetails['workout_bodyparts'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['bodypart_id']; ?>" name="workout_bodyparts[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['bodypart_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['bodypart_id'], json_decode($workoutDetails['workout_bodyparts'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['bodypart_id']; ?>" name="workout_bodyparts[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['bodypart_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['bodypart_id']; ?>" name="workout_bodyparts[]" />
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
                    <legend><?php echo _GOALS; ?></legend>

                    <div class="row">
                    <?php foreach($goals as $val): ?>
                      <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
                    <?php if(!empty($workoutDetails['workout_goals'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['goal_id'], json_decode($workoutDetails['workout_goals'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['goal_id']; ?>" name="workout_goals[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['goal_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['goal_id'], json_decode($workoutDetails['workout_goals'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['goal_id']; ?>" name="workout_goals[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['goal_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['goal_id']; ?>" name="workout_goals[]" />
                      <div class="state p-success">
                      <label style="display: flex; letter-spacing: 0;"><?php echo $val['goal_title']; ?></label>
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
                    <?php if(!empty($workoutDetails['workout_equipments'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['equipment_id'], json_decode($workoutDetails['workout_equipments'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['equipment_id']; ?>" name="workout_equipments[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['equipment_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['equipment_id'], json_decode($workoutDetails['workout_equipments'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['equipment_id']; ?>" name="workout_equipments[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['equipment_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['equipment_id']; ?>" name="workout_equipments[]" />
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
                    <?php if(!empty($workoutDetails['workout_levels'])): ?>

                      <div class="pretty p-default p-round">
                      <?php if(in_array($val['level_id'], json_decode($workoutDetails['workout_levels'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['level_id']; ?>" name="workout_levels[]" checked="" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['level_title']; ?></label>
                        </div>
                      </div>
                      <?php elseif(!in_array($val['level_id'], json_decode($workoutDetails['workout_levels'], true))): ?>
                      <input type="checkbox" value="<?php echo $val['level_id']; ?>" name="workout_levels[]" />
                      <div class="state p-success">
                          <label style="display: flex; letter-spacing: 0;"><?php echo $val['level_title']; ?></label>
                        </div>
                      </div>
                      <?php endif; ?>

                      <?php else: ?>

                      <div class="pretty p-default p-round">
                      <input type="checkbox" value="<?php echo $val['level_id']; ?>" name="workout_levels[]" />
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

                  <legend><?php echo _TABLEFIELDTRAINER; ?></legend>
                  <select class="selectDrop form-control" name="workout_trainer">
                  <?php foreach($trainers as $val): ?>
                  <?php if($workoutDetails['workout_trainer'] == $val['member_id']): ?>
                  <option value="<?php echo $val['member_id']; ?>" selected><?php echo $val['member_name']; ?></option>
                  <?php else: ?>
                  <option value selected>-</option>
                  <option value="<?php echo $val['member_id']; ?>"><?php echo $val['member_name']; ?></option>
                  <?php endif; ?>

                    <?php endforeach; ?>
                  </select>


                    <label><?php echo _TABLEFIELDSTATUS; ?></label>
                   <select class="custom-select form-control" name="workout_status" required="">

                    <?php if($workoutDetails['workout_status'] == 1){
                      echo '<option value="1" selected="selected">'._ENABLED.'</option>';
                      echo '<option value="2">'._DISABLED.'</option>';
                    }elseif($workoutDetails['workout_status'] == 2){
                      echo '<option value="2" selected="selected">'._DISABLED.'</option>';
                      echo '<option value="1">'._ENABLED.'</option>';
                    }
                    ?>
                  </select>

                  <label></label>
                    <select class="custom-select form-control singlevsweekly" name="workout_type">
                      <option value="single" <?php echo ($workoutDetails['workout_type'] == "single" ? "selected" : null); ?>><?php echo _SINGLEPLAN; ?></option>
                      <option value="weekly" <?php echo ($workoutDetails['workout_type'] == "weekly" ? "selected" : null); ?>><?php echo _WEEKLYPLAN; ?></option>
                    </select>

                    <br>
                    <br>

                    <!-- START SINGLE -->

                    <div class="single" <?php echo ($workoutDetails['workout_type'] == "single" ? null : "style='display: none'"); ?>>

                    <fieldset>
                    <legend><?php echo _SINGLEPLAN; ?></legend>

                    <div class="card p-3">

                    <div class="row d-flex align-items-center">
                    <div class="col-6"><p class="font-weight-bold"><?php echo _EXERCISES; ?></p></div>
                    <div class="col-6 text-right"></div>
                    </div>

                    <hr>

                    <div id="single_plan">
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
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(!empty($workoutDetails['workout_exercises']) && isset($workoutDetails['workout_exercises']) && $workoutDetails['workout_type'] == "single"): ?>

                    <?php $singleExercises = json_decode($workoutDetails['workout_exercises'], true); ?>

                    <?php foreach($singleExercises as $key1 => $value1): ?>

                      <?php if(isset($value1['rest_time'])): ?>

                      <tr class="exercise_<?php echo $key1+1; ?> is_rest_time" style="cursor: move;">
                      <td class="text-center" colspan="8">
                        <div class="input-group">
                          <span class="input-group-addon text-dark"><?= _RESTBETWEENSETS ?></span>
                          <input class="form-control" name="rest_time[]" placeholder="<?= _VALUEINSECONDS ?>" value="<?= $value1['rest_time']; ?>" style="border-top-right-radius: .25rem; border-bottom-right-radius: .25rem;">
                          <span class="input-group-addon" style="border: 0; padding-right: 0;">
                          <a class="btn btn-small btn-danger text-white remove_rest_single pointer"><?php echo _DELETEITEM ?></a></span> </div></td>
                      </tr>

                      <?php else: ?>

                    <?php foreach($exercises as $key2 => $value2): ?>

                    <?php if($value1['exercise_id'] == $value2['exercise_id']): ?>

                    <tr class="exercise_<?php echo $key1+1; ?>" style="cursor: move;">
                    <td class="exerciseid"><?php echo $value1['exercise_id']; ?></td>
                    <td class="exercisetitle"><?php echo $value2['exercise_title']; ?></td>
                    <td class="exercisetype">
                    <span class="typekey d-none"><?php echo $value1['exercise_type']; ?></span>
                    <span class="typelabel"><?php echo ($value1['exercise_type'] == "repsbased" ? _REPBASED : _TIMEBASED); ?></span>
                    </td>
                    <td class="exercisereps"><?php echo $value1['exercise_reps']; ?></td>
                    <td class="exercisesets"><?php echo $value1['exercise_sets']; ?></td>
                    <td class="exercisetime"><?php echo $value1['exercise_time']; ?></td>
                    <th class="text-right" scope="row">
                    <a class="btn btn-small btn-danger text-white remove_exercise"><?php echo _DELETEITEM ?></a> 
                    <a class="btn btn-small btn-primary text-white open-single-modal" data-row="<?php echo $key1+1; ?>" data-target="#v" data-toggle="modal"><?php echo _EDITITEM ?></a>
                    </th>
                    </tr>

                    <?php endif; ?>

                    <?php endforeach; ?>

                    <?php endif; ?>

                    <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>

                    </table>
                    </div>
                    </div>

                    <hr>

                    <div>
                    <a class="btn btn-success text-white btn-small open-modal-single" data-toggle="modal" data-target="#v"><?php echo _ADDEXERCSISE; ?></a>
                    <a class="btn btn-info text-white btn-small add_rest_single"><?php echo _ADDRESTTIME; ?></a>
                    </div>

                    </div>

                    </fieldset>

                    </div>

                    <!-- END SINGLE -->

                    <!-- START WEEKLY -->

                    <div class="weekly" <?php echo ($workoutDetails['workout_type'] == "weekly" ? null : "style='display: none'"); ?>>

                    <fieldset>
                    <legend><?php echo _WEEKLYPLAN; ?></legend>

                    <div id="accordion" class="accordion">
                    <div class="weeks">

                    <?php if(isset($workoutDetails['workout_exercises']) && $workoutDetails['workout_type'] == "weekly"): ?>
                    <?php if(!empty($workoutDetails['workout_exercises'])): ?>

                    <?php $weeklyExercises = json_decode($workoutDetails['workout_exercises'], true); ?>

                    <?php foreach($weeklyExercises as $weekNumber => $weekDetails): ?>
                    <div id="week_<?php echo $weekNumber+1; ?>" class="card mb-3 p-3 single-week">

                    <div class="card-header bg-white rounded border" style="cursor: pointer;" data-toggle="collapse" data-target="#collapse_<?php echo $weekNumber+1; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $weekNumber+1; ?>">
                    <div class="row d-flex align-items-center no-gutters">
                    <div class="col-6">
                    <p class="week_title m-0 font-weight-bold"><?php echo _WEEKTEXT; ?> <?php echo $weekNumber+1; ?></p>
                    </div>
                    <div class="col-6 text-right"><a class="btn btn-danger text-white btn-small remove_week"><?php echo _DELETEWEEK; ?></a></div>
                    </div>
                    </div>

                    <div id="collapse_<?php echo $weekNumber+1; ?>" class="collapse" aria-labelledby="week_<?php echo $weekNumber+1; ?>" data-parent="#accordion">

                      <?php foreach($weekDetails as $weekKey => $days): ?>
                      <?php for($dayNumber = 0; $dayNumber < count($days); $dayNumber++): ?>

                      <div class="card mb-3 mt-3 p-3">
                      <div class="row">
                      <div class="col-6"><p><?php echo _DAYTEXT; ?> <?php echo $dayNumber+1; ?></p></div>
                      <div class="col-6 text-right">
                        <a class="btn btn-success text-white btn-small open-modal-weekly" data-toggle="modal" data-week="<?php echo $weekNumber+1; ?>" data-day="<?php echo $dayNumber+1; ?>" data-target="#v"><?php echo _ADDEXERCSISE; ?></a>
                        <a class="btn btn-info text-white btn-small add_rest_weekly" data-week="<?php echo $weekNumber+1; ?>" data-day="<?php echo $dayNumber+1; ?>"><?php echo _ADDRESTTIME; ?></a>
                      </div>
                      </div>
                      <hr>
                      <div class="day<?php echo $dayNumber+1; ?> single-day">
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
                      <th scope="col"></th>
                      <th scope="col"></th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php foreach($days as $dayKey => $dayExercises): ?>

                      <?php if($dayKey == "day".$dayNumber+1): ?>

                        <?php foreach($dayExercises as $key => $value3): ?>

                          <?php if(isset($value3['rest_time'])): ?>

                          <tr class="week<?php echo $weekNumber+1; ?>_day<?php echo $dayNumber+1; ?>_row<?php echo $key+1; ?> is_rest_time" style="cursor: move;">
                          <td class="text-center" colspan="8">
                            <div class="input-group">
                              <span class="input-group-addon text-dark"><?= _RESTBETWEENSETS ?></span>
                              <input class="form-control" name="rest_time[]" placeholder="<?= _VALUEINSECONDS ?>" value="<?= $value3['rest_time']; ?>" style="border-top-right-radius: .25rem; border-bottom-right-radius: .25rem;">
                              <span class="input-group-addon" style="border: 0; padding-right: 0;">
                              <a class="btn btn-small btn-danger text-white remove_rest_weekly pointer" data-week="<?php echo $weekNumber+1; ?>" data-day="<?php echo $dayNumber+1; ?>"><?php echo _DELETEITEM ?></a></span> </div></td>
                          </tr>

                          <?php elseif(isset($value3['exercise_id'])): ?>

                          <?php foreach($exercises As $value4): ?>
                          <?php if($value3['exercise_id'] == $value4['exercise_id']): ?>
                          <tr class="week<?php echo $weekNumber+1; ?>_day<?php echo $dayNumber+1; ?>_row<?php echo $key+1; ?>" style="cursor: move;">
                          <td class="exerciseid"><?php echo $value3['exercise_id']; ?></td>
                          <td class="exercisetitle"><?php echo $value4['exercise_title']; ?></td>
                          <td class="exercisetype">
                          <span class="typekey d-none"><?php echo $value3['exercise_type']; ?></span>
                          <span class="typelabel"><?php echo ($value3['exercise_type'] == "repsbased" ? _REPBASED : _TIMEBASED); ?></span>
                          </td>
                          <td class="exercisereps"><?php echo $value3['exercise_reps']; ?></td>
                          <td class="exercisesets"><?php echo $value3['exercise_sets']; ?></td>
                          <td class="exercisetime"><?php echo $value3['exercise_time']; ?></td>
                          <th class="text-right" scope="row">
                          <a class="btn btn-small btn-danger text-white remove_week_exercise"><?php echo _DELETEITEM ?></a> 
                          <a class="btn btn-small btn-primary text-white open-edit-modal-weekly" data-row="<?php echo $key+1; ?>" data-week="<?php echo $weekNumber+1; ?>" data-day="<?php echo $dayNumber+1; ?>" data-target="#v" data-toggle="modal"><?php echo _EDITITEM ?></a>
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

                    <div id="week_1" class="card mb-3 p-3 single-week">
                    <div class="card-header bg-white rounded border" style="cursor: pointer;" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" aria-controls="collapse_1">
                    <div class="row d-flex align-items-center no-gutters">
                    <div class="col-6">
                    <p class="week_title m-0 font-weight-bold"><?php echo _WEEKTEXT; ?> 1</p>
                    </div>
                    <div class="col-6 text-right"><a class="btn btn-danger text-white btn-small remove_week"><?php echo _DELETEWEEK; ?></a></div>
                    </div>
                    </div>
                    <div id="collapse_1" class="collapse" aria-labelledby="week_1" data-parent="#accordion">

                    <?php for($i = 1; $i < 8; $i++): ?>
                    <div class="card mb-3 mt-3 p-3">
                    <div class="row">
                    <div class="col-6"><p><?php echo _DAYTEXT; ?> <?php echo $i; ?></p></div>
                    <div class="col-6 text-right"><a class="btn btn-success text-white btn-small open-modal-weekly" data-toggle="modal" data-week="1" data-day="<?php echo $i; ?>" data-target="#v"><?php echo _ADDEXERCSISE; ?></a></div>
                    </div>
                    <hr>
                    <div class="day<?php echo $i; ?> single-day">
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
                      <a class="btn btn-primary text-white" id="addWeek"><?php echo _ADDWEEK; ?></a>
                    </div>


                    </fieldset>
                    </div>

                    <!-- END WEEKLY -->

                  <textarea rows="5" class="mt-3 form-control" name="workout_exercises" id="workout_exercises" hidden><?php echo $workoutDetails['workout_exercises'] ?></textarea>

                  <label><?php echo _TABLEFIELDIMAGE; ?></label>

                  <div class="new-image" id="image-preview" style="background: url(<?php echo $target_dir; ?><?php echo $workoutDetails['workout_image'] ?>);">
                    <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                    <input type="hidden" value="<?php echo $workoutDetails['workout_image']; ?>" name="workout_image_save">
                    <input type="file" name="workout_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" />
                  </div>

                <span class="text-danger recomendedsize"><?php echo _RECOMMENDEDSIZE; ?> <b>650 x 350</b> </span>
                  <br/>
                
                  <hr>
                  
                <button class="btn btn-primary" type="submit" name="save"><?php echo _UPDATEITEM; ?></button>
                <button class="btn btn-danger deleteItem" type="button" data-url="../controller/delete_workout.php?id=<?php echo $workoutDetails['workout_id']; ?>" data-redirect="../controller/workouts.php"><?php echo _DELETEITEM; ?></button>
                

              </form></div></div></div></div></div></div></section>

<?php require '../views/single-workout.view.php'; ?>
<?php require '../views/weekly-workout.view.php'; ?>
<?php require 'footer.php'; ?>