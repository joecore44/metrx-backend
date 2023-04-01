<?php require 'header.php'; ?>
<?php require 'sidebar.php'; ?>  

<script type="text/javascript">
  $(document).ready(function(){
    $('#table_id').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_trainers.php",
     "responsive": true,
     "bPaginate":true,
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aaSorting": [[1,'desc']],
     "aoColumns": [
     { mData: 'trainer_id', "width": "5%", "className": "text-center" },
     { "mData": null , "width": "12%", "className": "product text-center",
     "mRender" : function (data) {
      return "<img src='"+IMAGES_FOLDER+data.trainer_avatar+"' class='product-img product-img-vertical'/>";}
    },
     { mData: 'trainer_name'},
     { mData: 'member_email'},
     { mData: 'total_workouts'},
     { mData: 'total_meals'},
     { mData: 'total_users'},
     { "mData": null , "width": "6%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.trainer_status == 1) {
        return '<span class="badge badge-pill bg-success"><i class="dripicons-checkmark"></i></span>';
      }else{
        return '<span class="badge badge-pill bg-danger"><i class="dripicons-cross"></i></span>';
      }
    }
  },
  { "mData": null ,
  "width": "14%",
  "className": "text-center",
  'orderable': false,
  'searchable': false,
  "mRender" : function (data) {
    return "<a class='btn btn-small btn-info' href='../controller/trainer_details.php?id="+data.trainer_id+"'>"+VIEWITEM+"</a> <a class='btn btn-small btn-primary' href='../controller/edit_trainer.php?id="+data.trainer_id+"'>"+EDITITEM+"</a> <a class='btn btn-small btn-danger btn-delete deleteItem' data-url='../controller/delete_trainer.php?id="+data.trainer_id+"'>"+DELETEITEM+"</a>";}
  }
  ]
});
  });
</script>

<!--Page Container-->
<section class="page-container">
  <div class="page-content-wrapper">

    <!--Main Content-->

    <div class="content sm-gutter">
      <div class="container-fluid padding-25 sm-padding-10">

        <div class="section-title">
          <h5><?php echo _TRAINERS; ?></h5>
        </div>

        <div class="row">

          <div class="col-12 c-col-12">

            <a class="btn btn-primary" href="../controller/new_trainer.php">
              <i class="fa fa-plus add-new-i"></i> <?php echo _ADDITEM; ?>
            </a>
            
          </div>

          <div class="col-12">
            <div class="block table-block mb-4 c-4">

              <div class="row">
                <div class="table-responsive">
                  <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
                    <thead>
                      <tr>
                        <th><?php echo _TABLEFIELDID; ?></th>
                        <th><?php echo _TABLEFIELDAVATAR; ?></th>
                        <th><?php echo _TABLEFIELDUSERNAME; ?></th>
                        <th><?php echo _TABLEFIELDEMAIL; ?></th>
                        <th><?php echo _TABLEFIELDTOTALWORKOUTS; ?></th>
                        <th><?php echo _TABLEFIELDTOTALMEALS; ?></th>
                        <th><?php echo _TABLEFIELDASSIGNED; ?></th>
                        <th><?php echo _TABLEFIELDSTATUS; ?></th>
                        <th><?php echo _TABLEFIELDACTIONS; ?></th>
                      </tr>
                    </thead>
                  </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require 'footer.php'; ?>