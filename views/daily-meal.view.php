<!-- Daily -->

<div class="modal fade" id="editDaily" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><?php echo _DAYTEXT; ?> <span id="day_id"></span> <i><?php echo _MEALTEXT; ?> <span id="meal_id"></span></i></h5>
</div>
<div class="modal-body">
<form>

<label><?php echo _RECIPES ?></label>
<select class="selectDrop form-control" name="recipeid[]">
<?php foreach($recipes as $item): ?>
<option value="<?php echo echoOutput($item['recipe_id']); ?>"><?php echo echoOutput($item['recipe_title']); ?></option>
<?php endforeach; ?>
</select>

<hr>

<button type="button" class="btn btn-primary save-day-item"><?php echo _UPDATEITEM ?></button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo _CANCELBUTTONALERT ?></button>
</form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="newDaily" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><?php echo _DAYTEXT; ?> <span id="day_id"></span> <i><?php echo _MEALTEXT; ?> <span id="meal_id"></span></i></h5>
</div>
<div class="modal-body">
<form>

<label><?php echo _RECIPES ?></label>
<select class="selectDrop form-control" name="recipeid[]">
<?php foreach($recipes as $item): ?>
<option value="<?php echo echoOutput($item['recipe_id']); ?>"><?php echo echoOutput($item['recipe_title']); ?></option>
<?php endforeach; ?>
</select>

<hr>

<button type="button" class="btn btn-primary add-day-item"><?php echo _SAVECHANGES ?></button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo _CANCELBUTTONALERT ?></button>
</form>
</div>
</div>
</div>
</div>

<script>

'use strict';
$(document).ready(function(){  

$(document).on("click", ".add_input_recipe",function(){

var day_id = $(this).attr('data-day');
var meal_id = $(this).attr('data-meal');

var row_count = $("#day_"+day_id+" .meal"+meal_id+" table tbody tr").length;
row_count++;
$("#day_"+day_id+" .meal"+meal_id+" table tbody").append('<tr class="day'+day_id+'_meal'+meal_id+'_row'+row_count+' is_input_recipe" style="cursor: move;">'
+'<td class="text-center" colspan="8"><div class="input-group"> <input class="form-control" name="title[]" placeholder="<?= _TABLEFIELDTITLE ?>" style="border-top-right-radius: .25rem; border-bottom-right-radius: .25rem;"> <span class="input-group-addon" style="border: 0; padding-right: 0;"> <a class="btn btn-small btn-danger text-white remove_input_recipe pointer" data-meal="'+meal_id+'" data-day="'+day_id+'">'+DELETEITEM+'</a> </span> </div></td>'
+'</tr>');
});

$(document).on("click", ".remove_input_recipe", function(){

if(confirm(ST_AREYOUSUREDELETE)){

var the_day = $(this).attr('data-day');
var the_meal = $(this).attr('data-meal');
$(this).closest("tr").remove();
$("#day_"+day_id+" .meal"+meal_id).find("tbody tr").each(function(t){
t++;
$(this).attr("class","meal"+the_meal+"_day"+the_day+"_row"+t)
});
process_daily_plan();

}else{
return false;
}

});

});

$(document).on("click", ".open-modal-daily", function () {
var meal_id = $(this).attr('data-meal');
var day_id = $(this).attr('data-day');
$("#newDaily .modal-header #day_id").text( day_id );
$("#newDaily .modal-header #meal_id").text( meal_id );
$('#newDaily').modal('show');
$('.add-day-item').attr("data-meal",meal_id).attr("data-day",day_id)
});

$(document).on("click",".add-day-item",function(){
var meal_id = $(this).attr('data-meal');
var day_id = $(this).attr('data-day');
var recipeid = $("#newDaily .modal-body form").find("select[name='recipeid[]']").val();
var recipetitle = $("#newDaily .modal-body form").find("select[name='recipeid[]'] option:selected").text();

var row_count = $("#day_"+day_id+" .meal"+meal_id+" table tbody tr").length;
row_count++;
$("#day_"+day_id+" .meal"+meal_id+" table tbody").append('<tr class="day'+day_id+'_meal'+meal_id+'_row'+row_count+'" style="cursor: move;">'
+'<td><span class="recipeid d-none">'+recipeid+'</span><span class="recipetitle">'+recipetitle+'</span></td>'
+'<th class="text-right" scope="row">'
+'<a class="btn btn-small btn-danger text-white remove_day_item">'+DELETEITEM+'</a> <a class="btn btn-small btn-primary text-white open-edit-modal-daily" data-row="'+row_count+'" data-day="'+day_id+'" data-meal="'+meal_id+'">'+EDITITEM+'</a>'
+'</th>'
+'</tr>');
$("#newDaily .modal-body form").trigger('reset')
$('#newDaily').modal('hide');
process_daily_plan()
});

var selectr = $(".dayed");
$(document).on("click", ".open-edit-modal-daily", function () {
var row = $(this).attr('data-row');
var meal_id = $(this).attr('data-meal');
var day_id = $(this).attr('data-day');
var recipeid = $(".day"+day_id+"_meal"+meal_id+"_row"+row).find('.recipeid').html();
var recipetitle = $(".day"+day_id+"_meal"+meal_id+"_row"+row).find('.recipetitle').html();
selectr = $(".day"+day_id+"_meal"+meal_id+"_row"+row);

$("#editDaily .modal-body form select[name='recipeid[]']").val(recipeid).select2();
$("#editDaily .modal-body form select[name='recipeid[]'] ").val( recipetitle );

$("#editDaily .modal-header #day_id").text( day_id );
$("#editDaily .modal-header #meal_id").text( meal_id );
$('#editDaily').modal('show');
});

$(document).on("click", ".save-day-item", function(){

var recipeid = $("#editDaily .modal-body form").find("select[name='recipeid[]']").val();
var recipetitle = $("#editDaily .modal-body form select[name='recipeid[]']").select2('data');

selectr.find(".recipeid").html(recipeid);
selectr.find(".recipetitle").html(recipetitle[0].text);

$('#editDaily').modal('hide');
process_daily_plan();

})

'use strict';
$(document).ready(function(){  

$(document).on("click", ".remove_day_item",function(){

if(confirm(ST_AREYOUSUREDELETE)){

var the_day = $(this).closest(".single-day").find(".open-modal-daily").attr("data-day");
var the_meal = $(this).closest(".single-day").find(".open-modal-daily").attr("data-meal");
$(this).closest("tr").remove();
$("#day_"+the_day+" .meal"+the_meal).find("tbody tr").each(function(t){
t++;
$(this).attr("class","day"+the_day+"_meal"+the_meal+"_row"+t)
});
process_daily_plan();

}else{
return false;
}

});

$(document).on("click","#addDay",function(){
var count = $(".days .single-day").length;
count++;
$('.days').append('<div id="day_'+count+'" class="card mb-3 p-3 single-day"><div class="card-header bg-white rounded border" style="cursor: pointer;" data-toggle="collapse" data-target="#collapse_'+count+'" aria-expanded="true" aria-controls="collapse_'+count+'"> <div class="row d-flex align-items-center no-gutters"> <div class="col-6"> <p class="day_title m-0 font-weight-bold">'+DAYTEXT+' '+count+'</p> </div> <div class="col-6 text-right"><a class="btn btn-danger text-white btn-small remove_day">'+DELETEDAY+'</a></div> </div> </div><div id="collapse_'+count+'" class="collapse" aria-labelledby="day_'+count+'" data-parent="#accordion"><div class="card mb-3 mt-3 p-3"><div class="row"> <div class="col-6"><p>'+MEALTEXT+' 1</p></div> <div class="col-6 text-right"><a class="btn btn-success text-white btn-small open-modal-daily" data-toggle="modal" data-day="'+count+'" data-meal="1" data-target="#v"><?php echo _ADDMEAL; ?></a> <a class="btn btn-info text-white btn-small add_input_recipe" data-meal="1" data-day="'+count+'"><?php echo _ADDMANUALRECIPE; ?></a> </div> </div><hr><div class="meal1 single-meal"><div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col text-truncate"><?php echo _TABLEFIELDTITLE; ?></th> <th scope="col"></th> </tr> </thead> <tbody> </tbody> </table> </div> </div> </div> <div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+MEALTEXT+' 2</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-daily" data-toggle="modal" data-day="'+count+'" data-meal="2" data-target="#v"><?php echo _ADDMEAL; ?></a> <a class="btn btn-info text-white btn-small add_input_recipe" data-meal="2" data-day="'+count+'"><?php echo _ADDMANUALRECIPE; ?></a></div> </div> <hr> <div class="meal2 single-meal"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col text-truncate"><?php echo _TABLEFIELDTITLE; ?></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div><div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+MEALTEXT+' 3</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-daily" data-toggle="modal" data-day="'+count+'" data-meal="3" data-target="#v"><?php echo _ADDMEAL; ?></a> <a class="btn btn-info text-white btn-small add_input_recipe" data-meal="3" data-day="'+count+'"><?php echo _ADDMANUALRECIPE; ?></a></div> </div> <hr> <div class="meal3 single-meal"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col text-truncate"><?php echo _TABLEFIELDTITLE; ?></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div><div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+MEALTEXT+' 4</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-daily" data-toggle="modal" data-day="'+count+'" data-meal="4" data-target="#v"><?php echo _ADDMEAL; ?></a> <a class="btn btn-info text-white btn-small add_input_recipe" data-meal="4" data-day="'+count+'"><?php echo _ADDMANUALRECIPE; ?></a></div> </div> <hr> <div class="meal4 single-meal"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col text-truncate"><?php echo _TABLEFIELDTITLE; ?></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div><div class="card mb-3 p-3"> <div class="row"> <div class="col-6"><p>'+MEALTEXT+' 5</p></div> <div class="col-6 text-right"><a class="btn btn-success btn-small text-white open-modal-daily" data-toggle="modal" data-day="'+count+'" data-meal="5" data-target="#v"><?php echo _ADDMEAL; ?></a> <a class="btn btn-info text-white btn-small add_input_recipe" data-meal="5" data-day="'+count+'"><?php echo _ADDMANUALRECIPE; ?></a></div> </div> <hr> <div class="meal5 single-meal"> <div class="table-responsive"> <table class="table"> <thead> <tr> <th scope="col text-truncate"><?php echo _TABLEFIELDTITLE; ?></th> <th scope="col"></th> </tr> </thead> <tbody></tbody> </table> </div> </div> </div></div> </div>');  
$(".single-meal table tbody").sortable({
axis: 'y',
update:function(){
process_daily_plan();
}
});
process_daily_plan();
});

});

'use strict';
$(document).ready(function(){  

$(".single-meal table tbody").sortable({
axis: 'y',
update:function(){
process_daily_plan();
}
});

$(document).on("click",".remove_day",function(){

if(confirm(ST_AREYOUSUREDELETE)){

$(this).closest(".single-day").remove();
$(".single-day").each(function(i){
i++;
$(this).attr("id","day_"+i);
$(this).find(".day_title").text(DAYTEXT+" "+i);
$(this).find(".open-modal-daily").attr("data-day",i);
})
process_daily_plan();

}else{
return false;
}

});
});

$(document).on("change",".days table tbody tr td input", function(){
    process_daily_plan();
});

function process_daily_plan(){
var arr = {};
$(".single-day").each(function(i){
var meals = {};
i++;
$(this).find(".single-meal").each(function(k){
var items = [];
k++;
$(this).find("table tbody tr").each(function(j){

if($(this).hasClass('is_input_recipe')){

var title = $(this).find("input[name='title[]']").val();

items.push({
    title:title
})

}else{

var recipeid = $(this).find(".recipeid").html();
var recipetitle = $(this).find(".recipetitle").html();

items.push({
    recipeid:recipeid
})

}

});
    meals["meal"+k] = items;
    })
    arr["day"+i] = meals;
});
arr = Object.entries(arr).map((e) => ( { [e[0]]: e[1] } ));
$("#meal_days").val(JSON.stringify(arr))
}

</script>