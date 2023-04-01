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
              <h5><?php echo _DETAILSITEM; ?></h5>
            </div>
          </div>

          <div class="col-12 c-col-12 mb-4">
          <a class="btn btn-primary" href="../controller/edit_user.php?id=<?php echo $user->uid; ?>"><?php echo _EDITITEM; ?></a>
          </div>

          <div class="col-md-12">
          
          <div class="block form-block mb-4">

          <div class="row">

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDUSERNAME; ?></p>
          <h6><?php echo echoOutput($user->displayName); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDUSEREMAIL; ?></p>
          <h6><?php echo echoOutput($user->email); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDVERIFIED; ?></p>
          <h6><?php echo ($user->emailVerified == 1 ? '<span class="text-success">'._YESTEXT.'</span>' : '<span class="text-danger">'._NOTEXT.'</span>' ); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDSTATUS; ?></p>
          <h6><?php echo ($user->disabled == 1 ? '<span class="text-danger">'._INACTIVE.'</span>' : '<span class="text-success">'._ACTIVE.'</span>' ); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDCREATED; ?></p>
          <h6><?php echo echoOutput($user->metadata->createdAt->format('d/m/Y H:i:s')); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDLASTLOGIN; ?></p>
          <h6><?php echo echoOutput($user->metadata->lastLoginAt->format('d/m/Y H:i:s')); ?></h6>
          </div>
          </div>

          </div>

          </div>

          </div>

          <div class="col-md-12">
          <div class="block form-block mb-4">
          <?php require '../views/user.workouts.view.php'; ?>
          </div>
          </div>

          <div class="col-md-12">
          <div class="block form-block mb-4">
          <?php require '../views/user.meals.view.php'; ?>
          </div>
          </div>

          <div class="col-md-12">
          <div class="block form-block mb-4">
          <?php require '../views/user.progress.view.php'; ?>
          </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php require 'footer.php'; ?>
