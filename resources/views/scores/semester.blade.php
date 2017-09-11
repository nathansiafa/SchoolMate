@extends('layouts.master')

@section('page-title', 'Semester Report')

@section('meta')
	<meta name="csrf-token" content="{{csrf_token()}}">
@endsection

@section('page-css')
	<!-- Animate css -->
	<link href="{{ asset("/bower_components/AdminLTE/plugins/animate/animate.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-header', 'Semester Report')

@section('admin-navigation')
<!-- Sidebar Menu -->
<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <!-- Optionally, you can add icons to the links -->
  <li class="">
    <a href="/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>

  <!-- guardians -->
  <li><a href="/guardians"><i class="fa fa-user"></i> <span>Guardians</span></a></li>

  <!-- Settings -->
  <li class="treeview">
    <a href="#"><i class="fa fa-cogs"></i> <span>Settings</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="/institution"><i class="fa fa-edit"></i>Institution</a></li>
      <li><a href="/academics"><i class="fa fa-edit"></i>Academic</a></li>
      <li><a href="/subjects"><i class="fa fa-edit"></i>Subjects</a></li>
      <li><a href="/grades"><i class="fa fa-edit"></i>Grades</a></li>
      <li><a href="/divisions"><i class="fa fa-edit"></i>Divisions</a></li>
      <li><a href="/semesters"><i class="fa fa-edit"></i>Semesters</a></li>
      <li><a href="/terms"><i class="fa fa-edit"></i>Terms</a></li>
    </ul>
  </li>

  <!-- student -->
  <li class="treeview">
    <a href="#">
      <i class="fa fa-users"></i><span>Students</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="/students"><i class="glyphicon glyphicon-list-alt"></i>Student List</a></li>
      <li><a href="/students/create"><i class="fa fa-pencil"></i>Student Admission</a></li>
    </ul>
  </li>

  <!-- users -->
  <li class="treeview">
    <a href="#">
      <i class="glyphicon glyphicon-user"></i><span>Users</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="/users"><i class="glyphicon glyphicon-list-alt"></i>User List</a></li>
      <li><a href="/register"><i class="fa fa-pencil"></i>Register User</a></li>
    </ul>
  </li>

  <!-- score -->
  <li class="treeview">
    <a href="#">
      <i class="fa fa-fax"></i><span>Scores</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="/scores"><i class="glyphicon glyphicon-list-alt"></i>Score Tables</a></li>
      <li><a href="/scores/master"><i class="fa fa-pencil"></i>Enter Score</a></li>
    </ul>
  </li>

  <!-- reports -->
  <li class="active treeview">
    <a href="#">
      <i class="fa fa-folder-open-o"></i>
      <span>Scores Reports</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="/scores/report/terms"><i class="fa fa-file-text-o"></i>Term Report</a></li>
      <li class="active"><a href="/scores/report/semesters"><i class="fa fa-file-text-o"></i>Semester Report</a></li>
      <li><a href="#"><i class="fa fa-file-text-o"></i>Annual Report</a></li>
    </ul>
  </li>
</ul>
@endsection


@section('content')


	<div class="row">
		<div class="col-md-12">

			<!-- div to display errors returned by server-->
            <div class="errors alert hidden">
            </div>
            <!-- end of errors div -->

         	<div class="panel">
         		<div class="panel-body">
         			<div class="form-group">
         				<div class="input-group">
                        	<span class="input-group-addon">Student Code</span>
                        	<input class="form-control" type="text" maxlength="4" name="student_code" id="code" placeholder="Enter student code">

	                  		<span class="input-group-addon">Semester</span>
	                  		<select name="semester_id" class="form-control" id="semester">
                      			@foreach($semesters as $semester)
		                  			<option value="{{$semester->id}}">{{$semester->name}}</option>
		                  		@endforeach
	         				</select>
	         			</div>
	         		</div>
	         		<div id="result"></div>
	         	</div>
         	</div>
	    </div>
	</div>

@endsection

@section('page-scripts')
	<script type="text/javascript">

		$(document).ready(function() {

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			
			$("#code").keyup(function(event){
				event.preventDefault();

		        var code = $('#code').val();
		        var semester = $('#semester').val();

		        if (code != '' && code.length === 4) {
		          $.ajax({
		          	url:"/scores/report/semesters",
		            method:"POST",
		           	data:{"student_code":code, "semester_id":semester},
		           	success:function(data){
		            	$("#result").html(data);
		           	}
		          });
		        } else {
		          $("#result").html('');

		        }   
		    });  

			$('#semester').on('change', function(event) {
		      	event.preventDefault();

		      	/* Act on the event */
		        var code = $('#code').val();
		        var semester = $('#semester').val();

		        if (code != '' && code.length === 4) {
		          $.ajax({
		          	url:"/scores/report/semesters",
		            method:"POST",
		           	data:{"student_code":code, "semester_id":semester},
		           	success:function(data){
		            	$("#result").html(data);
		           	}
		          });
		        } else {
		          $("#result").html('');

		        }   

		    });
		});

	</script>
@endsection