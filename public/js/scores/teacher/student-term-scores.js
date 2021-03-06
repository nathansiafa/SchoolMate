$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ajaxStart(function() {
	$(".overlay").css("display", "block");
});

$(document).ajaxStop(function() {
	$(".overlay").css("display", "none");
});

//Initialize Select2 Elements
$("#student").select2();

$(document).on('click', '.print-btn', function(event) {
	event.preventDefault();
	/* Act on the event */
	var title = $('.title').val();
	printReport('result', title);
});

// on change of the academic years populate the sponsor grade select list element
// with the grade the logged in teacher is/was sponsoring in the selected academic year.
$(document).on('change', '#academic_id', function(event) {
	event.preventDefault();
	/* Act on the event */

	var academic_id = $('#academic_id').val();

	if (academic_id != "") {

		$.ajax({
			url: '/teacher/sponsor/grade/'+academic_id,
			type: 'GET',
		})
		.done(function(data) {
			if (data.none) {

				$("#grade").val("");
				$("#grade").attr('disabled', 'true');
				$('select[name="student_id"]').empty();
				$("#student").attr('disabled', 'true');
				$("#term").attr('disabled', 'true');
				$("#result").html(data.none);
				$(".print-div").addClass('hidden');

			} else {

				$("#result").html("");
				$(".print-div").addClass('hidden');
				$('select[name="student_id"]').empty();
				$("#student").attr('disabled', 'true');
				$("#term").attr('disabled', 'true');

				$("#grade").removeAttr('disabled');
				$('select[name="grade_id"]').empty();
			  	$('select[name="grade_id"]').append('<option value="">Select Grade</option>');
			  	$.each(data, function(key, value) {
			      	$('select[name="grade_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
			  	});
			}
		})
		.fail(function() {
			$("#result").html('There was an error please contact administrator');
		});
	} else {

		$("#grade").val("");
		$("#grade").attr('disabled', 'true');
		$('select[name="student_id"]').empty();
		$("#student").attr('disabled', 'true');
		$("#term").attr('disabled', 'true');
		$("#result").html("");
		$(".print-div").addClass('hidden');
	}
	
});

// on change of the sponsor grade select list element popuulate the
// students select list element with students who are enrolled in the 
// grade the logged in teacher is sponsoring.
$(document).on('change', '#grade', function(event) {
	event.preventDefault();
	/* Act on the event */

	// hide all errors
	$('.errors').addClass('hidden');

	var academic_id = $('#academic_id').val();
	var grade = $('#grade').val();

	if (grade != "" && academic_id != "") {

		$.ajax({
			url: '/teacher/scores/academic/grade/students',
			type: 'POST',
			data: {'grade_id':grade, 'academic_id':academic_id},
		})
		.done(function(data) {
			if (data.none) {

				$('select[name="student_id"]').empty();
				$("#student").attr('disabled', 'true');
				$("#term").attr('disabled', 'true');
				$("#result").html(data.none);
			} else {

				$("#result").html('');
				$(".print-div").addClass('hidden');
				$("#student").removeAttr('disabled');
				$("#term").removeAttr('disabled');

				$('select[name="student_id"]').empty();
	          	$('select[name="student_id"]').append('<option value="">Select Students</option>');
	          	$.each(data, function(key, value) {
	            	$('select[name="student_id"]').append('<option value="'+ value.id +'">'+'('+value.student_code+')'+ value.first_name+' '+value.middle_name+' '+value.surname+'</option>');
	          	});
			}
		})
		.fail(function() {
			$("#result").html('There was an error please contact administrator');
		});
		
	} else {

		$("#term").attr('disabled','disabled');
		$('select[name="student_id"]').empty();
		$("#student").attr('disabled','disabled');
		$("#result").html('');
		$(".print-div").addClass('hidden');
	}
});

//if student and term is selected request student term report.
$('.search_fields').on('change', function(event) {
    event.preventDefault();
    /* Act on the event */

    var student_id = $('#student').val();
   	var academic_id = $('#academic_id').val();
	var term = $('#term').val();

    if (student_id != "" && academic_id != "" && term != "") {

      $.ajax({
        url: '/teacher/scores/report/terms',
        type: 'POST',
        data:{"student_id":student_id, "term_id":term, "academic_id":academic_id},
      })
      .done(function(data) {
        if (data.none) {
          $("#result").html(data.none);
          $(".print-div").addClass('hidden');
        } else {
          $("#result").html(data);
          $(".print-div").removeClass('hidden');
        }
      })
      .fail(function() {
        $('#result').html('There was an error. Please try again, if problem persits please contact adminstrator');
      });
    } else {
      $("#result").html('To view report please make sure you have all fields selected.');
      $(".print-div").addClass('hidden');
    }
});