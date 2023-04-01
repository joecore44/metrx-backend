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
            <input type="text" placeholder="" name="workout_title" class="form-control" required="">

            <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
            <textarea type="text" class="form-control" name="workout_description"></textarea>

            <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
            <select class="custom-select form-control" name="workout_availability">
            <option value="free" selected=""><?php echo _FREE; ?></option>
            <option value="premium"><?php echo _PREMIUM; ?></option>
            </select>

            <label><?php echo _TABLEFIELDRATE; ?></label>
            <input type="number" min="1" max="3" name="workout_rate" class="form-control">

            <br>
            <br>

            <fieldset>
            <legend><?php echo _BODYPARTS; ?></legend>

            <div class="row">
            <?php foreach($bodyparts as $val): ?>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
            <div class="pretty p-default p-round">
            <input type="checkbox" value="<?php echo $val['bodypart_id']; ?>" name="workout_bodyparts[]" />
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
            <legend><?php echo _GOALS; ?></legend>

            <div class="row">
            <?php foreach($goals as $val): ?>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
            <div class="pretty p-default p-round">
            <input type="checkbox" value="<?php echo $val['goal_id']; ?>" name="workout_goals[]" />
            <div class="state p-success">
            <label style="display: flex; letter-spacing: 0;"><?php echo $val['goal_title']; ?></label>
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
            <input type="checkbox" value="<?php echo $val['equipment_id']; ?>" name="workout_equipments[]" />
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
            <input type="checkbox" value="<?php echo $val['level_id']; ?>" name="workout_levels[]" />
            <div class="state p-success">
            <label style="display: flex; letter-spacing: 0;"><?php echo $val['level_title']; ?></label>
            </div>
            </div>
            </div>
            <?php endforeach; ?>
            </div>

            </fieldset>

            <label><?php echo _TABLEFIELDTRAINER; ?></label>
            <select class="selectDrop form-control" name="workout_trainer">
            <option value selected>-</option>
            <?php foreach($trainers as $val): ?>
            <option value="<?php echo $val['member_id']; ?>"><?php echo $val['member_name']; ?></option>
            <?php endforeach; ?>
            </select>

            <label><?php echo _TABLEFIELDSTATUS; ?></label>
            <select class="custom-select form-control" name="workout_status">
            <option value="1" selected=""><?php echo _ENABLED; ?></option>
            <option value="2"><?php echo _DISABLED; ?></option>
            </select>

            <label></label>
            <select class="custom-select form-control singlevsweekly" name="workout_type">
                <option value="single" selected><?php echo _SINGLEPLAN; ?></option>
                <option value="weekly"><?php echo _WEEKLYPLAN; ?></option>
            </select>

            <br/>
            <br/>

            <div class="single">

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

            <hr>

            <div>
            <a class="btn btn-primary text-white btn-small open-modal-single" data-toggle="modal" data-target="#v"><?php echo _ADDEXERCSISE; ?></a>
            <a class="btn btn-info text-white btn-small add_rest_single"><?php echo _ADDRESTTIME; ?></a>
            </div>

            </div>

            </fieldset>

            </div>

            <div class="weekly" style="display: none;">

            <fieldset>
            <legend><?php echo _WEEKLYPLAN; ?></legend>

            <div id="accordion" class="accordion">
            <div class="weeks">

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
            <div class="col-6 text-right">
              <a class="btn btn-success text-white btn-small open-modal-weekly" data-toggle="modal" data-week="1" data-day="<?php echo $i; ?>" data-target="#v"><?php echo _ADDEXERCSISE; ?></a>
              <a class="btn btn-info text-white btn-small add_rest_weekly" data-week="1" data-day="<?php echo $i; ?>"><?php echo _ADDRESTTIME; ?></a>
            </div>
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
            </div>
            </div>

            <hr>

            <div>
              <a class="btn btn-primary text-white" id="addWeek"><?php echo _ADDWEEK; ?></a>
            </div>

            </fieldset>

            </div>

            <textarea rows="5" class="mt-3 form-control" name="workout_exercises" id="workout_exercises" hidden></textarea>

            <label class="required"><?php echo _TABLEFIELDIMAGE; ?></label>

            <div class="new-image" id="image-preview">
            <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
            <input type="file" name="workout_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" required />
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

        
<?php require '../views/single-workout.view.php'; ?>
<?php require '../views/weekly-workout.view.php'; ?>
<?php require 'footer.php'; ?>