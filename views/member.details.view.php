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

          <div class="col-md-12">
          
          <div class="block form-block mb-4">

          <div class="row">

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDUSERNAME; ?></p>
          <h6><?php echo echoOutput($member['member_name']); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDUSEREMAIL; ?></p>
          <h6><?php echo echoOutput($member['member_email']); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDSTATUS; ?></p>
          <h6><?php echo ($member['member_status'] == 1 ? '<span class="text-success">'._ACTIVE.'</span>' : '<span class="text-danger">'._INACTIVE.'</span>' ); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDUSERROLE; ?></p>
          <h6><?php echo echoOutput($member['role_title']); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDCREATED; ?></p>
          <h6><?php echo formatDate($member['member_created']); ?></h6>
          </div>
          </div>

          <div class="col-6 col-md-4 col-lg-2">
          <div class="mt-3 mb-3">
          <p class="label text-capitalize mb-1"><?php echo _TABLEFIELDUPDATED; ?></p>
          <h6><?php echo formatDate($member['member_updated']); ?></h6>
          </div>
          </div>

          </div>

            </div>

          </div>

          <div class="col-md-12">
          <div class="d-block mt-6">
          <a class="btn btn-primary" href="../controller/edit_member.php?id=<?php echo $member['member_id']; ?>"><?php echo _EDITITEM; ?></a>
          </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php require 'footer.php'; ?>
