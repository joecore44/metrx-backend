<?php require 'header.php'; ?>
<?php require 'sidebar.php'; ?>  

<script type="text/javascript">
  $(document).ready(function(){
    $('#table_id').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_products.php",
     "responsive": true,
     "bPaginate":true,
     "aaSorting": [[1,'desc']],
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aoColumns": [
     { mData: 'product_id', "width": "5%", "className": "text-center" },
     { "mData": null , "width": "12%", "className": "product text-center",
     "mRender" : function (data) {
      return "<img src='"+IMAGES_FOLDER+data.product_image+"' class='product-img product-img-vertical'/>";}
    },
    { mData: 'product_title'},
    { mData: 'product_price'},
    { mData: 'product_old_price'},
    { mData: 'member_name'},
    { "mData": null , "width": "5%", "className":"text-capitalize",
     "mRender" : function (data) {
      return '<span>'+data.product_availability+'</span>';
      }
    },
    { "mData": null , "width": "10%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.product_featured == 1) {
        return '<span class="badge badge-pill bg-success"><i class="dripicons-checkmark"></i></span>';
      }else{
        return '<span class="badge badge-pill bg-warning"><i class="dripicons-cross"></i></span>';
        }
      }
    },
    { "mData": null , "width": "10%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.product_status == 1) {
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
      return "<a class='btn btn-small btn-primary' href='../controller/edit_product.php?id="+data.product_id+"'>"+EDITITEM+"</a> <a class='btn btn-small btn-danger btn-delete deleteItem' data-url='../controller/delete_product.php?id="+data.product_id+"'>"+DELETEITEM+"</a>";}
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
          <h5><?php echo _PRODUCTS; ?></h5>
        </div>

        <div class="row">

          <div class="col-12 c-col-12">

          <a class="btn btn-primary" href="../controller/product_tags.php">
              <i class="fa fa-tag add-new-i"></i> <?php echo _PRODUCTTAGS; ?>
            </a>

            <a class="btn btn-primary" href="../controller/new_product.php">
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
                        <th><?php echo _TABLEFIELDIMAGE; ?></th>
                        <th><?php echo _TABLEFIELDTITLE; ?></th>
                        <th><?php echo _TABLEFIELDPRICE; ?></th>
                        <th><?php echo _TABLEFIELDOLDPRICE; ?></th>
                        <th><?php echo _TABLEFIELDAUTHOR; ?></th>
                        <th><?php echo _TABLEFIELDAVAILABILITY; ?></th>
                        <th><?php echo _TABLEFIELDFEATURED; ?></th>
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
