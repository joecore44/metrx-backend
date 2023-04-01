<script type="text/javascript">
  $(document).ready(function(){
    $('#progress').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_user_progress.php?id=<?= $user->uid; ?>",
     "responsive": true,
     "bPaginate":true,
     "aaSorting": [[1,'desc']],
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aoColumns": [
     { mData: 'workout_id', "width": "5%", "className": "text-center" },
     { "mData": null , "width": "12%", "className": "product text-center",
     "mRender" : function (data) {
      return "<img src='"+IMAGES_FOLDER+data.workout_image+"' class='product-img product-img-vertical'/>";}
    },
    { mData: 'workout_title'},
    { mData: 'progress_time'},
    { "mData": null , "width": "12%", "className": "text-center",
     "mRender" : function (data) {

      if(data.progress_percentage == 100){
        return '<div class="progress"><div class="bg-success progress-bar" role="progressbar" style="width: '+data.progress_percentage+'%;" aria-valuenow="'+data.progress_percentage+'" aria-valuemin="0" aria-valuemax="100">'+data.progress_percentage+'%</div</div>';
      }else{
        return '<div class="progress"><div class="progress-bar" role="progressbar" style="width: '+data.progress_percentage+'%;" aria-valuenow="'+data.progress_percentage+'" aria-valuemin="0" aria-valuemax="100">'+data.progress_percentage+'%</div</div>';
      }

      },
    },
    { "mData": null , "width": "15%", "className": "text-center",
     "mRender" : function (data) {
      return "<span>"+data.progress_total+"/"+data.total_exercises+"</span>";
    }
    },
    { "mData": null , "width": "15%", "className": "text-center",
     "mRender" : function (data) {
      return "<span>"+moment(data.progress_date).format("YYYY-MM-DD HH:mm")+"</span>";
    }
    },
    ]
  });
  });
</script>

  <div class="row d-flex align-items-center">

  <div class="col-6 text-left">
  <h6><?php echo _USERPROGRESS; ?></h6>
  </div>

  </div>

    <hr>

    <table id="progress" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
    <thead>
    <tr>
    <th><?php echo _TABLEFIELDID; ?></th>
    <th><?php echo _TABLEFIELDIMAGE; ?></th>
    <th><?php echo _TABLEFIELDTITLE; ?></th>
    <th><?php echo _TABLEFIELDDURATION; ?></th>
    <th><?php echo _TABLEFIELDPERCENTAGE; ?></th>
    <th><?php echo _EXERCISESCOMPLETED; ?></th>
    <th><?php echo _TABLEFIELDDATE; ?></th>
    </tr>
    </thead>
    </table>