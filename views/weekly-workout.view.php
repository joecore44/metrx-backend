<!-- Weekly -->

<div class="modal fade" id="editWeekly" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><?php echo _WEEKTEXT; ?> <span id="week_id"></span> <i><?php echo _DAYTEXT; ?> <span id="day_id"></span></i></h5>
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

<button type="button" class="btn btn-success save-week-item"><?php echo _UPDATEITEM ?></button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo _CANCELBUTTONALERT ?></button>
</form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="newWeekly" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><?php echo _WEEKTEXT; ?> <span id="week_id"></span> <i><?php echo _DAYTEXT; ?> <span id="day_id"></span></i></h5>
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

<button type="button" class="btn btn-success add-week-item"><?php echo _SAVECHANGES ?></button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo _CANCELBUTTONALERT ?></button>
</form>
</div>
</div>
</div>
</div>

<script>

'use strict';
$(document).ready(function(){  

$(document).on("click", ".add_rest_weekly",function(){

var day_id = $(this).attr('data-day');
var week_id = $(this).attr('data-week');

var row_count = $("#week_"+week_id+" .day"+day_id+" table tbody tr").length;
row_count++;
$("#week_"+week_id+" .day"+day_id+" table tbody").append('<tr class="week'+week_id+'_day'+day_id+'_row'+row_count+' is_rest_time" style="cursor: move;">'
+'<td class="text-center" colspan="8"><div class="input-group"> <span class="input-group-addon text-dark"><?= _RESTBETWEENSETS ?></span> <input class="form-control" name="rest_time[]" placeholder="<?= _VALUEINSECONDS ?>" style="border-top-right-radius: .25rem; border-bottom-right-radius: .25rem;"> <span class="input-group-addon" style="border: 0; padding-right: 0;"><a class="btn btn-small btn-danger text-white remove_rest_weekly pointer" data-week="'+week_id+'" data-day="'+day_id+'">'+DELETEITEM+'</a></span> </div></td>'
+'</tr>');

});

$(document).on("click", ".remove_rest_weekly",function(){

if(confirm(ST_AREYOUSUREDELETE)){

var the_day = $(this).attr('data-day');
var the_week = $(this).attr('data-week');
$(this).closest("tr").remove();
$("#week_"+the_week+" .day"+the_day).find("tbody tr").each(function(t){
t++;
$(this).attr("class","week"+the_week+"_day"+the_day+"_row"+t)
});
process_weekly_plan();

}else{
return false;
}

});

});

$(document).on("click", ".open-modal-weekly", function () {
var day_id = $(this).attr('data-day');
var week_id = $(this).attr('data-week');
$("#newWeekly .modal-header #week_id").text( week_id );
$("#newWeekly .modal-header #day_id").text( day_id );
$('#newWeekly').modal('show');
$('.add-week-item').attr("data-day",day_id).attr("data-week",week_id)
});

$(document).on("click",".add-week-item",function(){
var day_id = $(this).attr('data-day');
var week_id = $(this).attr('data-week');
var exerciseid = $("#newWeekly .modal-body form").find("select[name='exerciseid[]']").val();
var exercisetitle = $("#newWeekly .modal-body form").find("select[name='exerciseid[]'] option:selected").text();
var exercisetype = $("#newWeekly .modal-body form").find("select[name='exercisetype[]']").val();
var exercisetypelabel = $("#newWeekly .modal-body form").find("select[name='exercisetype[]'] option:selected").text();
var exercisereps = $("#newWeekly .modal-body form").find("input[name='exercisereps[]']").val();
var exercisesets = $("#newWeekly .modal-body form").find("input[name='exercisesets[]']").val();
var exercisetime = $("#newWeekly .modal-body form").find("input[name='exercisetime[]']").val();
var row_count = $("#week_"+week_id+" .day"+day_id+" table tbody tr").length;
row_count++;
$("#week_"+week_id+" .day"+day_id+" table tbody").append('<tr class="week'+week_id+'_day'+day_id+'_row'+row_count+'" style="cursor: move;">'
+'<td class="exerciseid">'+exerciseid+'</td>'
+'<td class="exercisetitle">'+exercisetitle+'</td>'
+'<td class="exercisetype"><span class="typekey d-none">'+exercisetype+'</span><span class="typelabel">'+exercisetypelabel+'</span></td>'
+'<td class="exercisereps">'+exercisereps+'</td>'
+'<td class="exercisesets">'+exercisesets+'</td>'
+'<td class="exercisetime">'+exercisetime+'</td>'
+'<th class="text-right" scope="row">'
+'<a class="btn btn-small btn-danger text-white remove_week_exercise">'+DELETEITEM+'</a> <a class="btn btn-small btn-success text-white open-edit-modal-weekly" data-row="'+row_count+'" data-week="'+week_id+'" data-day="'+day_id+'">'+EDITITEM+'</a>'
+'</th>'
+'</tr>');
$("#newWeekly .modal-body form").trigger('reset')
$('#newWeekly').modal('hide');
process_weekly_plan()
});

var selectr = $(".weeked");
$(document).on("click", ".open-edit-modal-weekly", function () {
var row = $(this).attr('data-row');
var day_id = $(this).attr('data-day');
var week_id = $(this).attr('data-week');
var exerciseid = $(".week"+week_id+"_day"+day_id+"_row"+row).find('.exerciseid').html();
var exercisetitle = $(".week"+week_id+"_day"+day_id+"_row"+row).find('.exercisetitle').html();
var exercisetype = $(".week"+week_id+"_day"+day_id+"_row"+row).find('.typekey').html();
var exercisetypelabel = $(".week"+week_id+"_day"+day_id+"_row"+row).find('.typelabel').html();
var exercisereps = $(".week"+week_id+"_day"+day_id+"_row"+row).find('.exercisereps').html();
var exercisesets = $(".week"+week_id+"_day"+day_id+"_row"+row).find('.exercisesets').html();
var exercisetime = $(".week"+week_id+"_day"+day_id+"_row"+row).find('.exercisetime').html();
selectr = $(".week"+week_id+"_day"+day_id+"_row"+row);

$("#editWeekly .modal-body form select[name='exerciseid[]']").val(exerciseid).select2();
$("#editWeekly .modal-body form select[name='exercisetype[]'] ").val( exercisetype );

if ( exercisetype == 'timebased'){
$(".timebased").show();
$(".repsbased").hide();
}else{
$(".repsbased").show();
$(".timebased").hide();
}

$("#editWeekly .modal-body form input[name='exercisereps[]'] ").val( exercisereps );
$("#editWeekly .modal-body form input[name='exercisesets[]'] ").val( exercisesets );
$("#editWeekly .modal-body form input[name='exercisetime[]'] ").val( exercisetime );

$("#editWeekly .modal-header #week_id").text( week_id );
$("#editWeekly .modal-header #day_id").text( day_id );
$('#editWeekly').modal('show');
});

$(document).on("click", ".save-week-item", function(){

var exerciseid = $("#editWeekly .modal-body form").find("select[name='exerciseid[]']").val();
var exercisetitle = $("#editWeekly .modal-body form select[name='exerciseid[]']").select2('data');
var exercisetype = $("#editWeekly .modal-body form").find("select[name='exercisetype[]']").val();
var exercisetypelabel = $("#editWeekly .modal-body form").find("select[name='exercisetype[]'] option:selected").text();
var exercisereps = $("#editWeekly .modal-body form").find("input[name='exercisereps[]']").val();
var exercisesets = $("#editWeekly .modal-body form").find("input[name='exercisesets[]']").val();
var exercisetime = $("#editWeekly .modal-body form").find("input[name='exercisetime[]']").val();

selectr.find(".exerciseid").html(exerciseid);
selectr.find(".exercisetitle").html(exercisetitle[0].text);
selectr.find(".typekey").html(exercisetype);
selectr.find(".typelabel").html(exercisetypelabel);
selectr.find(".exercisereps").html(exercisereps);
selectr.find(".exercisesets").html(exercisesets);
selectr.find(".exercisetime").html(exercisetime);

$('#editWeekly').modal('hide');
process_weekly_plan();

})

'use strict';
$(document).ready(function(){  

$(document).on("click", ".remove_week_exercise",function(){

if(confirm(ST_AREYOUSUREDELETE)){

var the_week = $(this).closest(".single-week").find(".open-modal-weekly").attr("data-week");
var the_day = $(this).closest(".single-week").find(".open-modal-weekly").attr("data-day");
$(this).closest("tr").remove();
$("#week_"+the_week+" .day"+the_day).find("tbody tr").each(function(t){
t++;
$(this).attr("class","week"+the_week+"_day"+the_day+"_row"+t)
});
process_weekly_plan();

}else{
return false;
}

});

$(document).on("click","#addWeek",function(){
var count = $(".weeks .single-week").length;
count++;
$('.weeks').append('<div id="week_'+count+'" class="card mb-3 p-3 single-week"><div class="card-header bg-white rounded border" style="cursor: pointer;" data-toggle="collapse" data-target="#collapse_'+count+'" aria-expanded="true" aria-controls="collapse_'+count+'"> <div class="row d-flex align-items-center no-gutters"> <div class="col-6"> <p class="week_title m-0 font-weight-bold">'+WEEKTEXT+' '+count+'</p> </div> <div class="col-6 text-right"><a class="btn btn-danger text-white btn-small remove_week">'+DELETEWEEK+'</a></div> </div> </div><div id="collapse_'+count+'" class="collapse" aria-labelledby="week_'+count+'" data-parent="#accordion"><div class="card mb-3 mt-3 p-3"><div class="row"> <div class="col-6"><p>'+DAYTEXT+' 1</p></div> <div class="col-6 text-right"><a class="btn btn-success text-white btn-small open-modal-weekly" data-toggle="modal" data-week="'+count+'" data-day="1" data-target="#v"><?php echo _ADDEXERCSISE; ?></a> <a class="btn btn-info text-white btn-small add_rest_weekly" data-week="'+count+'" data-day="1"><?php echo _ADDRESTTIME; ?></a></div> </div><hr><div class="day1 single-day"><div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col">E. Id</th> <th scope="col">Exercise</th> <th scope="col">Type</th> <th scope="col">Reps</th> <th scope="col">Sets</th> <th scope="col">Time</th> <th scope="col">Rest</th> <th scope="col"></th> <th scope="col"></th> </tr> </thead> <tbody> </tbody> </table> </div> </div> </div> <div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+DAYTEXT+' 2</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-weekly" data-toggle="modal" data-week="'+count+'" data-day="2" data-target="#v"><?php echo _ADDEXERCSISE; ?> <a class="btn btn-info text-white btn-small add_rest_weekly" data-week="'+count+'" data-day="2"><?php echo _ADDRESTTIME; ?></a></a></div> </div> <hr> <div class="day2 single-day"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col">E. Id</th> <th scope="col">Exercise</th> <th scope="col">Type</th> <th scope="col">Reps</th> <th scope="col">Sets</th> <th scope="col">Time</th> <th scope="col">Rest</th> <th scope="col"></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div><div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+DAYTEXT+' 3</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-weekly" data-toggle="modal" data-week="'+count+'" data-day="3" data-target="#v"><?php echo _ADDEXERCSISE; ?></a> <a class="btn btn-info text-white btn-small add_rest_weekly" data-week="'+count+'" data-day="3"><?php echo _ADDRESTTIME; ?></a></div> </div> <hr> <div class="day3 single-day"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col">E. Id</th> <th scope="col">Exercise</th> <th scope="col">Reps</th> <th scope="col">Sets</th> <th scope="col">Time</th> <th scope="col"></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div><div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+DAYTEXT+' 4</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-weekly" data-toggle="modal" data-week="'+count+'" data-day="4" data-target="#v"><?php echo _ADDEXERCSISE; ?></a> <a class="btn btn-info text-white btn-small add_rest_weekly" data-week="'+count+'" data-day="4"><?php echo _ADDRESTTIME; ?></a></div> </div> <hr> <div class="day4 single-day"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col">E. Id</th> <th scope="col">Exercise</th> <th scope="col">Type</th> <th scope="col">Reps</th> <th scope="col">Sets</th> <th scope="col">Time</th> <th scope="col">Rest</th> <th scope="col"></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div><div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+DAYTEXT+' 5</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-weekly" data-toggle="modal" data-week="'+count+'" data-day="5" data-target="#v"><?php echo _ADDEXERCSISE; ?></a> <a class="btn btn-info text-white btn-small add_rest_weekly" data-week="'+count+'" data-day="5"><?php echo _ADDRESTTIME; ?></a></div> </div> <hr> <div class="day5 single-day"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col">E. Id</th> <th scope="col">Exercise</th> <th scope="col">Type</th> <th scope="col">Reps</th> <th scope="col">Sets</th> <th scope="col">Time</th> <th scope="col">Rest</th> <th scope="col"></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div><div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+DAYTEXT+' 6</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-weekly" data-toggle="modal" data-week="'+count+'" data-day="6" data-target="#v"><?php echo _ADDEXERCSISE; ?></a> <a class="btn btn-info text-white btn-small add_rest_weekly" data-week="'+count+'" data-day="6"><?php echo _ADDRESTTIME; ?></a></div> </div> <hr> <div class="day6 single-day"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col">E. Id</th> <th scope="col">Exercise</th> <th scope="col">Type</th> <th scope="col">Reps</th> <th scope="col">Sets</th> <th scope="col">Time</th> <th scope="col">Rest</th> <th scope="col"></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div><div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+DAYTEXT+' 7</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-weekly" data-toggle="modal" data-week="'+count+'" data-day="7" data-target="#v"><?php echo _ADDEXERCSISE; ?></a> <a class="btn btn-info text-white btn-small add_rest_weekly" data-week="'+count+'" data-day="7"><?php echo _ADDRESTTIME; ?></a></div> </div> <hr> <div class="day7 single-day"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col">E. Id</th> <th scope="col">Exercise</th> <th scope="col">Type</th> <th scope="col">Reps</th> <th scope="col">Sets</th> <th scope="col">Time</th> <th scope="col">Rest</th> <th scope="col"></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div> </div> </div>');  
process_weekly_plan();
});

});

'use strict';
$(document).ready(function(){  

$(".single-day table tbody").sortable({
axis: 'y',
update:function(){
process_weekly_plan();
}
});

$(document).on("click",".remove_week",function(){

if(confirm(ST_AREYOUSUREDELETE)){

$(this).closest(".single-week").remove();
$(".single-week").each(function(i){
i++;
$(this).attr("id","week_"+i);
$(this).find(".week_title").text(WEEKTEXT+" "+i);
$(this).find(".open-modal-weekly").attr("data-week",i);
})
process_weekly_plan();

}else{
return false;
}

});
});

$(document).on("change",".weekly table tbody tr td input", function(){
    process_weekly_plan();
});

function process_weekly_plan(){
var arr = {};
$(".single-week").each(function(i){
var days = {};
i++;
$(this).find(".single-day").each(function(k){
var items = [];
k++;
$(this).find("table tbody tr").each(function(j){

if($(this).hasClass('is_rest_time')){

var rest_time = $(this).find("input[name='rest_time[]']").val();

items.push({
    rest_time:rest_time
})

}else{

var exerciseid = $("#editWeekly .modal-body form").find("select[name='exerciseid[]']").val();
var exercisetitle = $("#editWeekly .modal-body form").find("select[name='exercisetitle[]'] option:selected").text();
var exercisetype = $("#editWeekly .modal-body form").find("select[name='exercisetype[]']").val();
var exercisetypelabel = $("#editWeekly .modal-body form").find("select[name='exercisetype[]'] option:selected").text();
var exercisereps = $("#editWeekly .modal-body form").find("input[name='exercisereps[]']").val();
var exercisesets = $("#editWeekly .modal-body form").find("input[name='exercisesets[]']").val();
var exercisetime = $("#editWeekly .modal-body form").find("input[name='exercisetime[]']").val();

var exerciseid = $(this).find(".exerciseid").html();
var exercisetype = $(this).find(".typekey").html();
var exercisereps = $(this).find(".exercisereps").html();
var exercisesets = $(this).find(".exercisesets").html();
var exercisetime = $(this).find(".exercisetime").html();

items.push({
exercise_id:exerciseid,
exercise_type:exercisetype,
exercise_reps:exercisereps,
exercise_sets:exercisesets,
exercise_time:exercisetime
})

}

});
days["day"+k] = items;
})
arr["week"+i] = days;
});
arr = Object.entries(arr).map((e) => ( { [e[0]]: e[1] } ));
$("#workout_exercises").val(JSON.stringify(arr))
}

</script>