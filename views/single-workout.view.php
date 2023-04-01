<div class="modal fade" id="newSingle" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><?php echo _ADDITEM ?></h5>
</div>
<div class="modal-body">
<form>

<label><?php echo _EXERCISES ?></label>
<select class="selectDrop form-control" name="exerciseid[]">
<?php foreach($exercises as $item): ?>
<option value="<?php echo echoOutput($item['exercise_id']); ?>"><?php echo echoOutput($item['exercise_title']); ?></option>
<?php endforeach; ?>
</select>

<label></label>
<select class="custom-select form-control timevsreps" name="exercisetype[]">
<option value="repsbased" selected><?php echo _REPBASED; ?></option>
<option value="timebased"><?php echo _TIMEBASED; ?></option>
</select>

<div class="timebased" style="display: none;">
<br>

<label><?php echo _TABLEFIELDTIME ?></label>
<input type="number" min="5" value="" placeholder="<?php echo _VALUEINSECONDS ?>" name="exercisetime[]" class="form-control">

</div>

<label></label>
<div class="row repsbased">

<div class="col-6">
<label><?php echo _TABLEFIELDREPS ?></label>
<input type="number" min="1" value="" name="exercisereps[]" class="form-control">
</div>

<div class="col-6">
<label><?php echo _TABLEFIELDSETS ?></label>
<input type="number" min="1" value="" name="exercisesets[]" class="form-control">
</div>

</div>

<hr>

<button type="button" class="btn btn-success add-single-item"><?php echo _SAVECHANGES ?></button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo _CANCELBUTTONALERT ?></button>
</form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="editSingle" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><?php echo _EDITITEM ?><span id="week_id"></span></h5>
</div>
<div class="modal-body">
<form>

<label><?php echo _EXERCISES ?></label>
<select class="selectDrop form-control" name="exerciseid[]">
<?php foreach($exercises as $item): ?>
<option value="<?php echo echoOutput($item['exercise_id']); ?>"><?php echo echoOutput($item['exercise_title']); ?></option>
<?php endforeach; ?>
</select>

<label></label>
<select class="custom-select form-control timevsreps" name="exercisetype[]">
<option value="repsbased" selected><?php echo _REPBASED; ?></option>
<option value="timebased"><?php echo _TIMEBASED; ?></option>
</select>

<div class="timebased" style="display: none;">
<br>

<label><?php echo _TABLEFIELDTIME ?></label>
<input type="number" min="5" value="" placeholder="<?php echo _VALUEINSECONDS ?>" name="exercisetime[]" class="form-control">

</div>

<label></label>
<div class="row repsbased">

<div class="col-6">
<label><?php echo _TABLEFIELDREPS ?></label>
<input type="number" min="1" value="" name="exercisereps[]" class="form-control">
</div>

<div class="col-6">
<label><?php echo _TABLEFIELDSETS ?></label>
<input type="number" min="1" value="" name="exercisesets[]" class="form-control">
</div>

</div>

<hr>

<button type="button" class="btn btn-success save-single-item"><?php echo _UPDATEITEM ?></button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo _CANCELBUTTONALERT ?></button>
</form>
</div>
</div>
</div>
</div>

<script type="text/javascript">

'use strict';
$(document).ready(function(){  

$(document).on("click", ".add_rest_single",function(){
  var row_count = $("#single_plan table tbody tr").length;

$("#single_plan table tbody").append('<tr class="exercise_'+row_count+' is_rest_time" style="cursor: move;">'
+'<td class="text-center" colspan="8"><div class="input-group"> <span class="input-group-addon text-dark"><?= _RESTBETWEENSETS ?></span> <input class="form-control" name="rest_time[]" placeholder="<?= _VALUEINSECONDS ?>" style="border-top-right-radius: .25rem; border-bottom-right-radius: .25rem;"> <span class="input-group-addon" style="border: 0; padding-right: 0;"><a class="btn btn-small btn-danger text-white remove_rest_single pointer">'+DELETEITEM+'</a></span> </div></td>'
+'</tr>');

});

$(document).on("click", ".remove_rest_single",function(){

if(confirm(ST_AREYOUSUREDELETE)){

$(this).closest("#single_plan table tbody tr").remove();

process_single_plan();

}else{
return false;
}

});

});

$(document).on("click", ".open-modal-single", function () {
$('#newSingle').modal('show');
$('.add-single-item');
});

$(document).on("click",".add-single-item",function(){
var exerciseid = $("#newSingle .modal-body form").find("select[name='exerciseid[]']").val();
var exercisetitle = $("#newSingle .modal-body form").find("select[name='exerciseid[]'] option:selected").text();
var exercisetype = $("#newSingle .modal-body form").find("select[name='exercisetype[]']").val();
var exercisetypelabel = $("#newSingle .modal-body form").find("select[name='exercisetype[]'] option:selected").text();
var exercisereps = $("#newSingle .modal-body form").find("input[name='exercisereps[]']").val();
var exercisesets = $("#newSingle .modal-body form").find("input[name='exercisesets[]']").val();
var exercisetime = $("#newSingle .modal-body form").find("input[name='exercisetime[]']").val();
var row_count = $("#single_plan table tbody tr").length; 

row_count++;
$("#single_plan table tbody").append('<tr class="exercise_'+row_count+'" style="cursor: move;">'
+'<td class="exerciseid">'+exerciseid+'</td>'
+'<td class="exercisetitle">'+exercisetitle+'</td>'
+'<td class="exercisetype"><span class="typekey d-none">'+exercisetype+'</span><span class="typelabel">'+exercisetypelabel+'</span></td>'
+'<td class="exercisereps">'+exercisereps+'</td>'
+'<td class="exercisesets">'+exercisesets+'</td>'
+'<td class="exercisetime">'+exercisetime+'</td>'
+'<th class="text-right" scope="row">'
+'<a class="btn btn-small btn-danger text-white remove_exercise">'+DELETEITEM+'</a> <a class="btn btn-small btn-success text-white open-single-modal" data-row="'+row_count+'" data-target="#v" data-toggle="modal">'+EDITITEM+'</a>'
+'</th>'
+'</tr>');
$("#newSingle .modal-body form").trigger('reset')
$('#newSingle').modal('hide');
process_single_plan()
});

var selectExercise = $(".exercise_");
$(document).on("click", ".open-single-modal", function () {
var row = $(this).attr('data-row');

var exerciseid = $(".exercise_"+row).find('.exerciseid').html();
var exercisetitle = $(".exercise_"+row).find('.exercisetitle').html();
var exercisetype = $(".exercise_"+row).find('.typekey').html();
var exercisetypelabel = $(".exercise_"+row).find('.typelabel').html();
var exercisereps = $(".exercise_"+row).find('.exercisereps').html();
var exercisesets = $(".exercise_"+row).find('.exercisesets').html();
var exercisetime = $(".exercise_"+row).find('.exercisetime').html();
selectExercise = $(".exercise_"+row);

$("#editSingle .modal-body form select[name='exerciseid[]'] ").val( exerciseid );

$("#editSingle .modal-body form select[name='exerciseid[]']").val(exerciseid).select2();

$("#editSingle .modal-body form select[name='exercisetype[]'] ").val( exercisetype );
$("#editSingle .modal-body form select[name='exercisetype[]'] option:selected").text( exercisetypelabel );

if ( exercisetype == 'timebased'){
$(".timebased").show();
$(".repsbased").hide();
}else{
$(".repsbased").show();
$(".timebased").hide();
}

$("#editSingle .modal-body form input[name='exercisereps[]'] ").val( exercisereps );
$("#editSingle .modal-body form input[name='exercisesets[]'] ").val( exercisesets );
$("#editSingle .modal-body form input[name='exercisetime[]'] ").val( exercisetime );

$('#editSingle').modal('show');
});

$(document).on("click", ".save-single-item", function(){

var exerciseid = $("#editSingle .modal-body form").find("select[name='exerciseid[]']").val();
var exercisetitle = $("#editSingle .modal-body form select[name='exerciseid[]']").select2('data');
var exercisetype = $("#editSingle .modal-body form").find("select[name='exercisetype[]']").val();
var exercisetypelabel = $("#editSingle .modal-body form").find("select[name='exercisetype[]'] option:selected").text();
var exercisereps = $("#editSingle .modal-body form").find("input[name='exercisereps[]']").val();
var exercisesets = $("#editSingle .modal-body form").find("input[name='exercisesets[]']").val();
var exercisetime = $("#editSingle .modal-body form").find("input[name='exercisetime[]']").val();

selectExercise.find(".exerciseid").html(exerciseid);
selectExercise.find(".exercisetitle").html(exercisetitle[0].text);
selectExercise.find(".typekey").html(exercisetype);
selectExercise.find(".typelabel").html(exercisetypelabel);
selectExercise.find(".exercisereps").html(exercisereps);
selectExercise.find(".exercisesets").html(exercisesets);
selectExercise.find(".exercisetime").html(exercisetime);

$('#editSingle').modal('hide');
process_single_plan();

})

'use strict';
$(document).ready(function(){  

$(document).on("click", ".remove_exercise",function(){

if(confirm(ST_AREYOUSUREDELETE)){

$(this).closest("#single_plan table tbody tr").remove();

process_single_plan();

}else{
return false;
}

});

});

'use strict';
$(document).ready(function(){  

$("#single_plan table tbody").sortable({
axis: 'y',
update:function(){
process_single_plan();
}
});

});

$(document).on("change","#single_plan table tbody tr td input", function(){
  process_single_plan();
});

function process_single_plan(){
let arr = [];
$("#single_plan table tbody tr").each(function(i){

if($(this).hasClass('is_rest_time')){

var rest_time = $(this).find("input[name='rest_time[]']").val();

arr.push({
    rest_time:rest_time
})

}else{

/*var exerciseid = $("#editSingle .modal-body form").find("select[name='exerciseid[]']").val();
var exercisetitle = $("#editSingle .modal-body form").find("select[name='exercisetitle[]'] option:selected").text();
var exercisetype = $("#editSingle .modal-body form").find("select[name='exercisetype[]']").val();
var exercisetypelabel = $("#editSingle .modal-body form").find("select[name='exercisetype[]'] option:selected").text();
var exercisereps = $("#editSingle .modal-body form").find("input[name='exercisereps[]']").val();
var exercisesets = $("#editSingle .modal-body form").find("input[name='exercisesets[]']").val();
var exercisetime = $("#editSingle .modal-body form").find("input[name='exercisetime[]']").val();*/

var exerciseid = $(this).find(".exerciseid").html();
var exercisetype = $(this).find(".typekey").html();
var exercisereps = $(this).find(".exercisereps").html();
var exercisesets = $(this).find(".exercisesets").html();
var exercisetime = $(this).find(".exercisetime").html();

arr.push({
exercise_id:exerciseid,
exercise_type:exercisetype,
exercise_reps:exercisereps,
exercise_sets:exercisesets,
exercise_time:exercisetime
})

}

});
$("#workout_exercises").val(JSON.stringify(arr));
}

</script>