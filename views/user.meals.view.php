<script type="text/javascript">
  $(document).ready(function(){
    $('#assignedMealsTable').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_meals_by_user.php?id=<?= $user->uid; ?>",
     "responsive": true,
     "bPaginate":true,
     "aaSorting": [[1,'desc']],
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aoColumns": [
     { mData: 'meal_id', "width": "5%", "className": "text-center" },
     { "mData": null , "width": "12%", "className": "product text-center",
     "mRender" : function (data) {
      return "<img src='"+IMAGES_FOLDER+data.meal_image+"' class='product-img product-img-vertical'/>";}
    },
    { mData: 'meal_title'},
    { mData: 'trainer_name'},
    { "mData": null , "width": "5%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.meal_status == 1) {
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
      return "<a class='btn btn-small btn-primary' href='../controller/edit_meal.php?id="+data.meal_id+"'>"+EDITITEM+"</a> <a class='btn btn-small btn-danger btn-delete deleteMeal' data-msg='<?= _DELETEDASSIGNEDMEAL; ?>' data-url='../controller/delete_assigned_meal.php?id="+data.id+"'>"+DELETEITEM+"</a>";}
    }
    ]
  });
  });
</script>

  <div class="row d-flex align-items-center">

  <div class="col-6 text-left">
  <h6><?php echo _ASSIGNEDMEALS; ?></h6>
  </div>

  <div class="col-6 text-right">
  <h6><button class="btn btn-primary"  data-toggle="modal" data-target="#assignMeal"><?php echo _ASSIGNMEAL; ?></button></h6>
  </div>

  </div>

    <hr>

    <table id="assignedMealsTable" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
    <thead>
    <tr>
    <th><?php echo _TABLEFIELDID; ?></th>
    <th><?php echo _TABLEFIELDIMAGE; ?></th>
    <th><?php echo _TABLEFIELDTITLE; ?></th>
    <th><?php echo _ASSIGNEDBY; ?></th>
    <th><?php echo _TABLEFIELDSTATUS; ?></th>
    <th><?php echo _TABLEFIELDACTIONS; ?></th>
    </tr>
    </thead>
    </table>

    <!-- Modals -->

<div class="modal fade" id="assignMeal" tabindex="-1" role="dialog" aria-labelledby="assignMealLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignMealLabel"><?php echo _ASSIGNMEAL; ?></h5>
      </div>
      <div class="modal-body">

        <form id="add-meal" enctype="multipart/form-data" method="post">
        <input type="hidden" value="<?php echo $memberInfo['member_id']; ?>" id="author_id">
        <input type="hidden" value="<?php echo $user->uid; ?>" id="user_id" required>
        <label><?php echo _SELECTMEAL; ?></label>
        <select class="selectDrop form-control" id="meal_id">
        <?php foreach($meals as $item): ?>
        <option data-img-src="../images/<?php echo $item['meal_image']; ?>" value="<?php echo $item['meal_id']; ?>"><?php echo $item['meal_title']; ?></option>
        <?php endforeach; ?>
        </select>

        <div class="showresults" style="margin-top: 15px;margin-bottom: 10px;"></div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _CANCELITEM ?></button>
        <button type="submit" class="btn btn-primary" data-label="<?php echo _ADDITEM ?>" data-exist="<?php echo _ALREADYASSIGNEDMEAL ?>" id="submit-meal"><?php echo _ADDITEM ?></button>
        </div>
        </form>

      </div>
    </div>
  </div>
