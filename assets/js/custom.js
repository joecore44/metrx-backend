//------------------------------------------------

'use strict';
$(document).ready(function() {
      $(".selectDrop").select2({
        placeholder: ""
      });
});

$(document).ready(function() {
$("form").confirmExit("Your message");
});

'use strict';
$(document).ready(function() {
      // Init preview 1
      $.uploadPreview({
        input_field: "#image1-upload",
        preview_box: "#image-1",
      });

      // Init preview 2
      $.uploadPreview({
        input_field: "#image2-upload",
        preview_box: "#image-2",
        no_label: true
      });

      // Init preview 3
      $.uploadPreview({
        input_field: "#image3-upload",
        preview_box: "#image-3",
        no_label: true
      });

      // Init preview 4
      $.uploadPreview({
        input_field: "#image4-upload",
        preview_box: "#image-4",
        no_label: true
      });

      // Init preview 4
      $.uploadPreview({
        input_field: "#image6-upload",
        preview_box: "#image-6",
        no_label: true
      });

      // Init preview 4
      $.uploadPreview({
        input_field: "#image7-upload",
        preview_box: "#image-7",
        no_label: true
      });

      // Init preview 4
      $.uploadPreview({
        input_field: "#image-upload",
        preview_box: "#image-preview",
        label_field: "#image-label"
      });

    });

//------------------------------------------------

'use strict';
function replaceDecimalSep(x, sep) {

  if(sep == ","){
  return x.replace(".", sep);
  }else if(sep == "."){
    return x.replace(",", sep);
  }

}

'use strict';
$(document).ready(function(){
  $('.timevsreps').on('change', function() {
    if ( this.value == 'timebased'){
      $(".timebased").show();
      $(".repsbased").hide();
    }else{
      $(".repsbased").show();
      $(".timebased").hide();
    }
  });
});

'use strict';
$(document).ready(function(){
  $('.singlevsweekly').on('change', function() {
    if ( this.value == 'single'){
      $(".single").show();
      $(".weekly").hide();
    }else{
      $(".weekly").show();
      $(".single").hide();
    }
  });
});

//------------------------------------------------

'use strict';
$('#adminlanguages').on('change', function() {

  var value = this.value;
  Cookies.set('adminLang', value);
  location.reload();
  
});

//------------------------------------------------

// One Per Page
'use strict';
$(document).ready(function(){
  $('#single-select').each(function(){
    var selected = $(this).data('selected');
    $(this).find('option[value="' + selected + '"]').attr("selected", "selected");
  });
});

//------------------------------------------------

'use strict';
$(document).ready(function(){
  tinymce.init({
    plugins: ["link paste"],
    menubar: false,
    oninit : "setPlainText",
    language: TINYMCELANG,
    selector: ".simpletinymce",
    valid_elements: "p,br,b,i,strong,em,ul,li,ol",
    toolbar1: "bold italic | alignleft aligncenter alignright"
  });
});

'use strict';
$(document).ready(function(){
  tinymce.init({
    plugins: ["fullpage code image link template autoresize"],
    fullpage_default_doctype: '<!DOCTYPE html>',
    selector: ".emailtinymce",
    language: TINYMCELANG,
    templates: '../emails/templates.php',
    template_preview_replace_values: {
      LOGO_URL: '../../images/logo.png',
      PROPERTY_IMAGE: '../assets/images/placeholder.png',
    },
    toolbar1: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
  });
});

$('.add_field').on('click', function(e) {
  e.preventDefault();
  tinymce.activeEditor.execCommand('mceInsertContent', false, $(this).text());

});

//------------------------------------------------

'use strict';
$(document).ready(function(){
 $('#add-meal').on("submit", function(event){ 

  event.preventDefault();

  var $this = $('#submit-meal');
  var btnLabel = $($this).data('label');
  var msgExist = $($this).data('exist');
  var loadingText = ST_PROCESSING;
  if ($('#submit-meal').html() !== loadingText) {
    $this.html(loadingText);
  }

  $.ajax({  
    url:"../controller/new_user_meal.php",  
    method:"POST",  
    data: {
      author_id:$("#author_id").val(),
      user_id:$("#user_id").val(),
      meal_id:$("#meal_id").val()
    },
    success:function(data){

      if(data === "success"){

      location.reload();

      }else if(data === "access_denied"){

      window.location.href = '../controller/denied.php';

      }else if(data === "exist"){

      $('.showresults').html(msgExist);
      $('.showresults').addClass('text-danger');
      $this.html(btnLabel);

      }

    }
  });  
});  
});

//------------------------------------------------

'use strict';
$(document).ready(function(){
 $('#add-workout').on("submit", function(event){ 

  event.preventDefault();

  var $this = $('#submit-workout');
  var btnLabel = $($this).data('label');
  var msgExist = $($this).data('exist');
  var loadingText = ST_PROCESSING;
  if ($('#submit-workout').html() !== loadingText) {
    $this.html(loadingText);
  }

  $.ajax({  
    url:"../controller/new_user_workout.php",  
    method:"POST",  
    data: {
      author_id:$("#author_id").val(),
      user_id:$("#user_id").val(),
      workout_id:$("#workout_id").val()
    },
    success:function(data){

      if(data === "success"){

      location.reload();

      }else if(data === "access_denied"){

      window.location.href = '../controller/denied.php';

      }else if(data === "exist"){

      $('.showresults').html(msgExist);
      $('.showresults').addClass('text-danger');
      $this.html(btnLabel);

      }

    }
  });  
});  
});


//------------------------------------------------

'use strict';
$(document).ready(function(){
 $('#test-email').on("submit", function(event){ 

  event.preventDefault();

  var $this = $('#submit-send');
  var loadingText = ST_PROCESSING;
  if ($('#submit-send').html() !== loadingText) {
    $this.html(loadingText);
  }

  $.ajax({  
    url:"../controller/test-email.php",  
    method:"POST",  
    data: {
      idtemplate:$("#idtemplate").val(),
      sendto:$("#sendto").val()
    },
    success:function(data){
      $('#showresults').html(data);
      $this.html(ST_SENDBUTTON);
    }
  });  
});  
});

//------------------------------------------------

'use strict';
function deleteAlert(urlItem, reDirect = null, customMsg = null) {
  swal({
    title: ST_AREYOUSURE,
    text: (customMsg ? customMsg : ST_YOUWILLNOT),
    type: "error",
    cancelButtonClass: "btn-default btn-sm",
    showCancelButton: true,
    cancelButtonText: ST_CANCELBUTTONALERT,
    confirmButtonClass: "btn-danger btn-sm",
    confirmButtonText: ST_YESDELETEIT,
    closeOnConfirm: false },
    function () {
      $.ajax({
        type: 'POST',
        url: urlItem,
        success: function (response) {
          if (reDirect) {
            window.location.href = reDirect;
          }else{
            if(response == "access_denied"){
              window.location.href = '../controller/denied.php';
            }else{
              location.reload();
            }
          }
        },
        error: function (error) {
          console.log(error);
        }
      });
    });

};

'use strict';
$(document).ready(function(){
  $('.deleteItem').on('click', function(){

    var customMsg = $(this).data('msg');
    var urlItem = $(this).data('url');
    var reDirect = $(this).data('redirect'); // Redirect page name after delete e.g. "items"

    deleteAlert(urlItem, reDirect, customMsg);

  });
});

'use strict';
$(document).ready(function(){
  $('#table_id tbody').on('click', '.deleteItem', function(){

    var customMsg = $(this).data('msg');
    var urlItem = $(this).data('url');
    var reDirect = $(this).data('redirect'); // Redirect page name after delete e.g. "items"

    deleteAlert(urlItem, reDirect, customMsg);

  });
});

'use strict';
$(document).ready(function(){
  $('#assignedWorkoutTable tbody').on('click', '.deleteWorkout', function(){

    var customMsg = $(this).data('msg');
    var urlItem = $(this).data('url');
    var reDirect = $(this).data('redirect'); // Redirect page name after delete e.g. "items"

    deleteAlert(urlItem, reDirect, customMsg);

  });
});

'use strict';
$(document).ready(function(){
  $('#assignedMealsTable tbody').on('click', '.deleteMeal', function(){

    var customMsg = $(this).data('msg');
    var urlItem = $(this).data('url');
    var reDirect = $(this).data('redirect'); // Redirect page name after delete e.g. "items"

    deleteAlert(urlItem, reDirect, customMsg);

  });
});

//------------------------------------------------

'use strict';
$(document).ready(function(){  

var count = $('[id^=singleExercise]').filter(function () {
return this.id.match(/singleExercise\d+$/);
}).length;

$(document).on('click', '#addSingleExercise', function(){  

count++;  
$('#single_exercises').append('<div class="w-100 d-flex align-items-center input-container-single" id="singleExercise'+count+'">'
+'<div class="w-5 p-2"><i class="move text-muted dripicons-move"></i></div>'
+'<div class="w-100 p-2"><input class="form-control" type="text" name="exercise_id[]" /></div>'
+'<div class="w-5 p-2"><a id="'+count+'" class="pointer remove_single_exercise"><i class="dripicons-cross text-danger h5"></i></a></div>'
+'</div>');  
});

$(document).on('click', '.remove_single_exercise', function(){ 

  if(confirm(ST_AREYOUSUREDELETE)){

    var button_id = $(this).attr("id");   
    $('#singleExercise'+button_id+'').remove();  
    process_single_exercises();
    
    }else{
    return false;
    }

});

$("#single_exercises").sortable({
axis: 'y',
update:function(){
  process_single_exercises();
}
});

$(document).on("change", ".input-container-single input, .input-container-single select", function(){
  process_single_exercises();
})

function process_single_exercises(){
let arr = [];
$(".input-container-single").each(function(i){

  var exercise_id = $(this).find("select[name='exercise_id[]']").val();
  arr.push({order:i,exercise_id:exercise_id});

});

$("#single_exercises_results").val(JSON.stringify(arr));

}

});

//------------------------------------------------

'use strict';
$(document).ready(function(){  

var count = $('[id^=rowStep]').filter(function () {
return this.id.match(/rowStep\d+$/);
}).length;

$(document).on('click', '#addStep', function(){  

count++;  
$('#steps').append('<div class="w-100 d-flex align-items-center step-input-container" id="rowStep'+count+'">'
+'<div class="w-5 p-2"><i class="move text-muted dripicons-move"></i></div>'
+'<div class="w-100 p-2"><input class="form-control" type="text" placeholder="'+FIELDVALUE+'" name="value[]" /></div>'
+'<div class="w-5 p-2"><a id="'+count+'" class="pointer remove_step"><i class="dripicons-cross text-danger h5"></i></a></div>'
+'</div>');  
});

$(document).on('click', '.remove_step', function(){  

  if(confirm(ST_AREYOUSUREDELETE)){

    var button_id = $(this).attr("id");   
    $('#rowStep'+button_id+'').remove();  
    process_steps();
    
    }else{
    return false;
    }

});

$("#steps").sortable({
axis: 'y',
update:function(){
process_steps();
}
});

$(document).on("change", ".step-input-container input", function(){
  process_steps();
})

function process_steps(){
let arr = [];
$(".step-input-container").each(function(i){

  var value = $(this).find("input[name='value[]']").val();
  arr.push({order:i,value:value});

});

$("#steps_results").val(JSON.stringify(arr));

}

});

//------------------------------------------------

'use strict';
$(document).ready(function(){  

var count = $('[id^=rowIngredient]').filter(function () {
return this.id.match(/rowIngredient\d+$/);
}).length;

$(document).on('click', '#addIngredient', function(){  

count++;  
$('#ingredients').append('<div class="w-100 d-flex align-items-center ingredient-input-container" id="rowIngredient'+count+'">'
+'<div class="w-5 p-2"><i class="move text-muted dripicons-move"></i></div>'
+'<div class="w-100 p-2"><input class="form-control" type="text" placeholder="'+FIELDVALUE+'" name="value[]" /></div>'
+'<div class="w-5 p-2"><a id="'+count+'" class="pointer remove_ingredient"><i class="dripicons-cross text-danger h5"></i></a></div>'
+'</div>');  
});

$(document).on('click', '.remove_ingredient', function(){  

  if(confirm(ST_AREYOUSUREDELETE)){

    var button_id = $(this).attr("id");   
    $('#rowIngredient'+button_id+'').remove();  
    process_ingredients();
    
    }else{
    return false;
    }

});

$("#ingredients").sortable({
axis: 'y',
update:function(){
process_ingredients();
}
});

$(document).on("change", ".ingredient-input-container input", function(){
  process_ingredients();
})

function process_ingredients(){
let arr = [];
$(".ingredient-input-container").each(function(i){

  var value = $(this).find("input[name='value[]']").val();
  arr.push({order:i,value:value});

});

$("#ingredients_results").val(JSON.stringify(arr));

}

});

//------------------------------------------------

  'use strict';
  $(document).ready(function(){  

  var count = $('[id^=rowInstruction]').filter(function () {
  return this.id.match(/rowInstruction\d+$/);
  }).length;

  $(document).on('click', '#addInstruction', function(){  

  count++;  
  $('#instructions').append('<div class="w-100 d-flex align-items-center instruction-input-container" id="rowInstruction'+count+'">'
  +'<div class="w-5 p-2"><i class="move text-muted dripicons-move"></i></div>'
  +'<div class="w-100 p-2"><input class="form-control" type="text" placeholder="'+FIELDVALUE+'" name="value[]" /></div>'
  +'<div class="w-5 p-2"><a id="'+count+'" class="pointer remove_instruction"><i class="dripicons-cross text-danger h5"></i></a></div>'
  +'</div>');  
  });

  $(document).on('click', '.remove_instruction', function(){  

    if(confirm(ST_AREYOUSUREDELETE)){
  
        var button_id = $(this).attr("id");   
        $('#rowInstruction'+button_id+'').remove();  
        process_instructions();
      
      }else{
      return false;
      }
  
  });

  $("#instructions").sortable({
  axis: 'y',
  update:function(){
  process_instructions();
  }
  });

  $(document).on("change", ".instruction-input-container input", function(){
    process_instructions();
  })

  function process_instructions(){
  let arr = [];
  $(".instruction-input-container").each(function(i){

    var value = $(this).find("input[name='value[]']").val();
    arr.push({order:i,value:value});

  });

  $("#instructions_results").val(JSON.stringify(arr));

  }

});

//------------------------------------------------

'use strict';
$(".toggle-password").on("click", function(){

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

//------------------------------------------------

'use strict';
$(document).ready(function(){
  $(".m_switch_check:checkbox").mSwitch({
    onRender:function(elem){
      var entity = elem.attr("entity");
      var label = elem.parent().parent().prev(".m_settings_label");
      if (elem.val() == 0){
        $.mSwitch.turnOff(elem);
        label.html(entity + " <span class=\"m_red\">(Disable)</font>");
      }else{
        label.html(entity + " <span class=\"m_green\">(Enable)</font>");
        $.mSwitch.turnOn(elem);
      }
    },
    onRendered:function(elem){
      /*console.log(elem);*/
    },
    onTurnOn:function(elem){
      var entity = elem.attr("entity");
      var label = elem.parent().parent().prev(".m_settings_label");
      if (elem.val() == "0"){
        elem.val("1");
        label.html(entity + " <span class=\"m_green\">(Enable)</font>");
      }else{
        label.html(entity + " <span class=\"m_red\">(Error)</font>");
      }
    },
    onTurnOff:function(elem){
      var entity = elem.attr("entity");
      var label = elem.parent().parent().prev(".m_settings_label");
      if (elem.val() == 1){
        elem.val("0");
        label.html(entity + " <span class=\"m_red\">(Disable)</font>");
      }else{
        label.html(entity + " <span class=\"m_red\">(Error)</font>");
      }
    }
  });
});

//------------------------------------------------

'use strict';
$(document).ready(function(){
  $(".image-radio").each(function(){
    if($(this).find('input[type="radio"]').first().attr("checked")){
      $(this).addClass('image-radio-checked');
    }else{
      $(this).removeClass('image-radio-checked');
    }
  });

    // sync the input state
    $(".image-radio").on("click", function(e){
      $(".image-radio").removeClass('image-radio-checked');
      $(this).addClass('image-radio-checked');
      var $radio = $(this).find('input[type="radio"]');
      $radio.prop("checked",!$radio.prop("checked"));

      e.preventDefault();
    });
  });

//------------------------------------------------

'use strict';
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

// color picker

$(function() {
  $('#primary-color-picker').colorpicker().on('changeColor', function(e) {
    $('#primary-color-preview')[0].style.backgroundColor = e.color
    .toString('rgba');
  });
});

$(function() {
  $('#secondary-color-picker').colorpicker().on('changeColor', function(e) {
    $('#secondary-color-preview')[0].style.backgroundColor = e.color
    .toString('rgba');
  });
});


