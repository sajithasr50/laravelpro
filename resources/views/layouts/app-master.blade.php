<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.87.0">
  <title>Admin Panel</title>

  <!-- Bootstrap core CSS -->
  <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .green {
      background: #b4d8b4;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
</head>

<body>

  @include('layouts.partials.navbar')

  <main class="container">
    @yield('content')
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    (function($) {
      $.fn.styleddropdown = function() {
        return this.each(function() {
          var obj = $(this)
          obj.find('.field').on('click', function() { //onclick event, 'list' slideIn/slideOut
            obj.find('.list').slideToggle(400);
          });

          obj.find('.list li').on('click', function() { //onclick event, select 'list' item
            var classSel = $(this).attr('class'),
              typeBRules = '',
              typeCRules = '';
            // if 'li' has been disabled act like the goggles (do nothing)
            if ($(this).hasClass('disabled')) {
              $('#candidateid').val('');
              $('#candBtn').attr('disabled');

              return false;
            }

            if ($(this).hasClass('selected')) {
              $(this).removeClass('selected');
              $('#candidateid').val('');
              $('#candBtn').attr('disabled', 'disabled');


            } else {
              $('#candBtn').removeAttr('disabled');

              // Clear out any previous selection from the grouping
              $('[class~=' + classSel + ']').removeClass('selected');
              // Select clicked 'li'
              $(this).addClass('selected');
              dataval = $(this).attr('data-value');
              $('#candidateid').val(dataval);
              // Set the rules to affect by, comment out to not have the groups interact at all
              typeBRules = {
                '1': '5'
              };
              typeCRules = {
                '5': '2'
              };
            }

            // if the rules are blank interact function will just clear the 'disabled' class
            if ($(this).hasClass('typeB')) { // If it's in the second group, affect the third group
              interact($(this), typeBRules, '.typeB', '.typeC');
            } else if ($(this).hasClass('typeC')) { // If it's in the third group, affect second group
              interact($(this), typeCRules, '.typeC', '.typeB');
            }
          });

          interact = function(selection, rules, selectionClass, interactClass) {
            var valueSel = selection.html(),
              dataSel = $(interactClass + '[data-value~=' + rules[valueSel] + ']');
            if (rules[valueSel]) {
              $(selectionClass).removeClass('disabled');
              dataSel.addClass('disabled').removeClass('selected');
            } else {
              $(interactClass).removeClass('disabled');
            }
          }
        });
      };
    })(jQuery);

    $(function() {
      $('.select').styleddropdown();
    });




    $(document).ready(function() {




      var i = 0;
      var l = 0;
      //var addamount = 0;

      $("#add").click(function() {

        var i = ($('.dynamicfield tr').length - 1);

        i++;
        $('#dynamic_field').append('<tr id="row' + i + '"><td class="type_list"><input type="text" name="field[' + i + '][label]" placeholder="Label" class="form-control typeClass" /></td><td class=""><input type="text" name="field[' + i + '][sample_field]" placeholder="Sample Field" class="form-control typeClass" /></td><td><select class="form-control" name="field[' + i + '][field_type]"><option value="">Select Type</option><option value="1">Text</option><option value="2">Number</option><option value="3">Textarea</option><option value="4">Select</option><option value="5">Radio</option><option value="6">Checkbox</option></select></td><td><div class="field_wrapper' + i + '" style="width:100%"><input type="text" style="width:50%;float:left" class="form-control" name="field[' + i + '][comments][]" value=""><a style="width:50%; float:left" data-id="' + i + '"  href="javascript:void(0);" class="add_button' + i + '" title="Add field">Add</a></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        var maxField = 10; //Input fields increment limitation




        var x = 1; //Initial field counter is 1

        // Once add button is clicked
        $('.add_button' + i).click(function() {
          var x = ($('.dynamicc').length);

          fieldid = $(this).attr("data-id");

          //Check maximum number of input fields
          if (x < maxField) {
            x++; //Increase field counter
            var fieldHTML = '<div style="width:100%;float:left;padding-top:10px;"><input class="form-control" style="width:50%;float:left" type="text" name="field[' + fieldid + '][comments][]" value=""/><a href="javascript:void(0);"  class="remove_button' + i + '" style="width:50%; float:left">Remove</a></div>'; //New input field html 

            $('.field_wrapper' + fieldid).append(fieldHTML); //Add field html
          } else {
            alert('A maximum of ' + maxField + ' fields are allowed to be added. ');
          }

          $('.remove_button' + i).click(function() {
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrease field counter
          });

        });

        // Once remove button is clicked

      });

      $(document).on('click', '.btn_remove', function() {



        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
      });





    });




    var maxField = 10; //Input fields increment limitation




    var x = 1; //Initial field counter is 1

    // Once add button is clicked
    $('.add_button').click(function() {
      var x = ($('.dynamicc').length);
      fieldid = $(this).attr("data-id");
      //Check maximum number of input fields
      if (x < maxField) {
        x++; //Increase field counter
        var fieldHTML = '<div style="width:100%;float:left;padding-top:10px;"><input class="form-control" style="width:50%;float:left" type="text" name="field[' + fieldid + '][comments][]" value=""/><a href="javascript:void(0);"  class="remove_button" style="width:50%; float:left">Remove</a></div>'; //New input field html 
        var wrapper = $('.field_wrapper' + fieldid); //Input field wrapper

        $(wrapper).append(fieldHTML); //Add field html
      } else {
        alert('A maximum of ' + maxField + ' fields are allowed to be added. ');
      }
      $('.remove_button').click(function() {
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
      });

    });
    $('.remove_button').click(function() {
      $(this).parent('div').remove(); //Remove field html
      x--; //Decrease field counter
    });

    // Once remove button is clicked
  </script>
</body>

</html>