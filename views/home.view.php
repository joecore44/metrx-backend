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
    <h4><?php echo _SUMMARY; ?></h4>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $exercises_total; ?></div>
    <i class="ti ti-stretching i-icon"></i>
    <p class="label"><?php echo _EXERCISES; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $workouts_total; ?></div>
    <i class="ti ti-calendar i-icon"></i>
    <p class="label"><?php echo _WORKOUTS; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $bodyparts_total; ?></div>
    <i class="ti ti-accessible i-icon"></i>
    <p class="label"><?php echo _BODYPARTS; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $equipments_total; ?></div>
    <i class="ti ti-barbell i-icon"></i>
    <p class="label"><?php echo _EQUIPMENTS; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $levels_total; ?></div>
    <i class="ti ti-activity-heartbeat i-icon"></i>
    <p class="label"><?php echo _LEVELS; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $goals_total; ?></div>
    <i class="ti ti-trophy i-icon"></i>
    <p class="label"><?php echo _GOALS; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $recipes_total; ?></div>
    <i class="ti ti-chef-hat i-icon"></i>
    <p class="label"><?php echo _RECIPES; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $meals_total; ?></div>
    <i class="ti ti-tools-kitchen-2 i-icon"></i>
    <p class="label"><?php echo _MEALS; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $trainers_total; ?></div>
    <i class="ti ti-members i-icon"></i>
    <p class="label"><?php echo _TRAINERS; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $products_total; ?></div>
    <i class="ti ti-shopping-cart i-icon"></i>
    <p class="label"><?php echo _PRODUCTS; ?></p>
    </div>
    </div>

    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
    <div class="block counter-block mb-4">
    <div class="value"><?php echo $posts_total; ?></div>
    <i class="ti ti-article i-icon"></i>
    <p class="label"><?php echo _POSTS; ?></p>
    </div>
    </div>

    </div>

    <div class="row">

    <div class="col-12 col-md-12 col-lg-6 mb-4">
    <div class="block table-block mb-4 h-100">
    <div class="block-heading d-flex align-items-center">
    <h5 class="text-truncate"><?php echo _EXERCISES; ?></h5>
    <div class="graph-pills graph-home">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
    <li class="nav-item">
    <a class="btn btn-secondary text-dark" href="../controller/exercises.php"><?php echo _VIEWALL; ?> <i class="fa fa-angle-right ml-1"></i></a>
    </li>
    </ul>
    </div>
    </div>

    <?php if(!empty($latestexercises)): ?>
    <div class="table-responsive text-no-wrap">
    <table class="table">
    <tbody class="text-middle">
    <?php foreach($latestexercises as $item): ?>
    <tr>
    <td class="product" width="50px">
    <img class="product-img product-img-vertical" src="<?php echo $target_dir; ?><?php echo $item['exercise_image']; ?>">
    </td>
    <td class="name"><span class="span-title"><a class="btn-link" href="../controller/edit_exercise.php?id=<?php echo echoOutput($item['exercise_id']) ?>"><?php echo echoOutput($item['exercise_title']); ?></a></span></td>
    <?php if($item['exercise_status'] == 1): ?>
    <td align="center" class="status success">
    <i class="ti ti-circle-check"></i>
    <?php elseif($item['exercise_status'] == 2): ?>
    <td align="center" class="status danger">
    <i class="ti ti-circle-x"></i>
    <?php endif; ?>
    </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    </div>
    <?php endif; ?>

    <?php if(empty($latestexercises)): ?>
    <p class="text-muted text-center mt-4"><?php echo _NODATAFOUND; ?></p>
    <?php endif; ?>


    </div>
    </div>


    <div class="col-12 col-md-12 col-lg-6 mb-4">
    <div class="block table-block mb-4 h-100">
    <div class="block-heading d-flex align-items-center">
    <h5 class="text-truncate"><?php echo _WORKOUTS; ?></h5>
    <div class="graph-pills graph-home">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
    <li class="nav-item">
    <a class="btn btn-secondary text-dark" href="../controller/workouts.php"><?php echo _VIEWALL; ?> <i class="fa fa-angle-right ml-1"></i></a>
    </li>
    </ul>
    </div>
    </div>

    <?php if(!empty($latestworkouts)): ?>
    <div class="table-responsive text-no-wrap">
    <table class="table">
    <tbody class="text-middle">
    <?php foreach($latestworkouts as $item): ?>
    <tr>
    <td class="product" width="50px">
    <img class="product-img product-img-vertical" src="<?php echo $target_dir; ?><?php echo $item['workout_image']; ?>">
    </td>
    <td class="name"><span class="span-title"><a class="btn-link" href="../controller/edit_workout.php?id=<?php echo echoOutput($item['workout_id']) ?>"><?php echo echoOutput($item['workout_title']); ?></a></span></td>
    <?php if($item['workout_status'] == 1): ?>
    <td align="center" class="status success">
    <i class="ti ti-circle-check"></i>
    <?php elseif($item['workout_status'] == 2): ?>
    <td align="center" class="status danger">
    <i class="ti ti-circle-x"></i>
    <?php endif; ?>
    </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    </div>
    <?php endif; ?>

    <?php if(empty($latestworkouts)): ?>
    <p class="text-muted text-center mt-4"><?php echo _NODATAFOUND; ?></p>
    <?php endif; ?>


    </div>
    </div> 

    </div>
    </div>
    </div>
    </div>
    </section>
    <?php require 'footer.php'; ?>
