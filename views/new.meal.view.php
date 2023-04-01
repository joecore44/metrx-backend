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
            <input type="text" placeholder="" name="meal_title" class="form-control" required="">

            <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
            <textarea type="text" class="form-control" name="meal_description"></textarea>

            <label><?php echo _TABLEFIELDAVAILABILITY; ?></label>
            <select class="custom-select form-control" name="meal_availability">
            <option value="free" selected=""><?php echo _FREE; ?></option>
            <option value="premium"><?php echo _PREMIUM; ?></option>
            </select>

            <label><?php echo _TABLEFIELDCALORIES; ?></label>
            <input type="number" name="meal_calories" class="form-control">

            <br>
            <br>

            <fieldset>
            <legend><?php echo _CATEGORIES; ?></legend>

            <div class="row">
            <?php foreach($categories as $val): ?>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3 d-flex align-items-center">
            <div class="pretty p-default p-round">
            <input type="checkbox" value="<?php echo $val['category_id']; ?>" name="meal_categories[]" />
            <div class="state p-success">
            <label style="display: flex; letter-spacing: 0;"><?php echo $val['category_title']; ?></label>
            </div>
            </div>
            </div>
            <?php endforeach; ?>
            </div>

            </fieldset>

            <label><?php echo _TABLEFIELDTRAINER; ?></label>
            <select class="selectDrop form-control" name="meal_trainer">
            <option value selected>-</option>
            <?php foreach($trainers as $val): ?>
            <option value="<?php echo $val['member_id']; ?>"><?php echo $val['member_name']; ?></option>
            <?php endforeach; ?>
            </select>

            <label><?php echo _TABLEFIELDSTATUS; ?></label>
            <select class="custom-select form-control" name="meal_status">
            <option value="1" selected=""><?php echo _ENABLED; ?></option>
            <option value="2"><?php echo _DISABLED; ?></option>
            </select>

            <label><?php echo _TABLEFIELDFEATURED; ?></label>
              <select class="custom-select form-control" name="meal_featured">
              <option value="0" selected=""><?php echo _NOTEXT; ?></option>
              <option value="1"><?php echo _YESTEXT; ?></option>
            </select>

            <br/>
            <br/>

            <fieldset>
            <legend><?php echo _DAILYPLAN; ?></legend>

            <div id="accordion" class="accordion">
            <div class="days">

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

            <?php for($i = 1; $i < 6; $i++): ?>
            <div class="card mb-3 mt-3 p-3">
            <div class="row">
            <div class="col-6"><p><?php echo _MEALTEXT; ?> <?php echo $i; ?></p></div>
            <div class="col-6 text-right">
              <a class="btn btn-success text-white btn-small open-modal-daily" data-toggle="modal" data-day="1" data-meal="<?php echo $i; ?>" data-target="#v"><?php echo _ADDMEAL; ?></a>
              <a class="btn btn-info text-white btn-small add_input_recipe" data-meal="<?php echo $i; ?>" data-day="1"><?php echo _ADDMANUALRECIPE; ?></a>
            </div>
            </div>
            <hr>
            <div class="meal<?php echo $i; ?> single-meal">
            <div class="table-responsive">
            <table class="table">
            <thead>
            <tr>
            <th scope="col text-truncate"><?php echo _TABLEFIELDTITLE; ?></th>
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
              <a class="btn btn-primary text-white" id="addDay"><?php echo _ADDDAY; ?></a>
            </div>

            </fieldset>

            <textarea rows="5" class="mt-3 form-control" name="meal_days" id="meal_days" hidden></textarea>

            <label class="required"><?php echo _TABLEFIELDIMAGE; ?></label>

            <div class="new-image" id="image-preview">
            <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
            <input type="file" name="meal_image" accept=".jpg, .jpeg, .png, .gif" id="image-upload" required />
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
        
<?php require '../views/daily-meal.view.php'; ?>
<?php require 'footer.php'; ?>