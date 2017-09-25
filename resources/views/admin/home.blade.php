@extends('layouts.master')

@section('page-title', 'Home')

@section('page-header', 'Home')

@section('page-description', 'Administrator Control Panel')

@section('page-css')
<!-- Animate css -->
  <link href="{{ asset("/bower_components/AdminLTE/plugins/animate/animate.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('user-logout')
  @component('components.user-logout')
      @slot('user_name')
          {{Auth::guard('admin')-> user()->user_name}}
      @endslot
      {{route('admin.logout')}}
  @endcomponent
@endsection

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
    <li class="active">Dashboard</li>
@endsection

@section('sidebar-navigation')
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu">
    <li class="header">ADMIN NAVIGATION</li>

    <li class="active">
      <a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>

    <!-- guardians -->
    <li class="treeview">
      <a href="#"><i class="fa fa-user"></i> <span>Guardians</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{route('guardians.home')}}"><i class="glyphicon glyphicon-th-list"></i> <span>Guardians</span></a></li>
        <li><a href="{{route('guardians.form')}}"><i class="fa fa-pencil"></i>New Guardian</a></li>
      </ul>
    </li>

    <!-- teachres -->
    <li class="treeview">
      <a href="#"><i class="glyphicon glyphicon-education"></i> <span>Teachers</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{route('teachers.home')}}"><i class="glyphicon glyphicon-th-list"></i> <span>Teachers</span></a></li>
        <li><a href="{{route('teachers.form')}}"><i class="fa fa-pencil"></i>New Teacher</a></li>
      </ul>
    </li>

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
        <li><a href="{{route('users.home')}}"><i class="glyphicon glyphicon-list-alt"></i>User List</a></li>
        <li><a href="{{route('users.form')}}"><i class="fa fa-pencil"></i>New User</a></li>
      </ul>
    </li>

     <!-- users roles-->
    <li class="treeview">
      <a href="#">
        <i class="glyphicon glyphicon-user"></i><span>Users Roles</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{route('roles.home')}}"><i class="glyphicon glyphicon-list-alt"></i>Roles</a></li>
        <li><a href="{{route('roles.form')}}"><i class="fa fa-pencil"></i>New Role</a></li>
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
    <li class="treeview">
      <a href="#">
        <i class="fa fa-folder-open-o"></i>
        <span>Scores Reports</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/scores/report/terms"><i class="fa fa-file-text-o"></i>Term Report</a></li>
        <li><a href="/scores/report/semesters"><i class="fa fa-file-text-o"></i>Semester Report</a></li>
        <li><a href="#"><i class="fa fa-file-text-o"></i>Annual Report</a></li>
      </ul>
    </li>
  </ul>
@endsection

@section('content')
    @include('layouts.partials.stats-bar')

    <!-- Left col -->
  <div class="row">
    <section class="col-lg-7 connectedSortable">
    <!-- grades stat bar chart -->
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Grade/Class Population</h3>

        </div>
        <div class="box-body">
           <canvas id="gradesBarChart"></canvas>
        </div>
      </div>
      <!-- /.grades stats bar chart -->
    </section>
    <!-- /.Left col -->
    <section class="col-lg-5 connectedSortable">
        <!-- Student gender chart -->
      <div class="box box-success">
        <div class="box-body">
           <canvas id="genderPieChart"></canvas>
        </div>
      </div>
      <!-- /.Close of Student gender chart -->
    </section>
    <!-- /.Left col -->
  </div>
   
@endsection


@section('page-scripts')

<script src="{{ asset ("/bower_components/AdminLTE/plugins/chartjs/Chart.min.js") }}"></script>
<script type="text/javascript">
  
  // student gender chart
  $.ajax({
    url: '/charts/gender',
    type: 'GET',
    dataType: 'JSON',
  })
  .done(function(data) {
    var gender = [];
    var sum = [];

    for(var index in data){
      gender.push(data[index].gender);
      sum.push(data[index].total);
    }

    var ctx = document.getElementById('genderPieChart').getContext('2d');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: {
            labels: gender,
            datasets: [{
                label: "Student Gender Chart",
                backgroundColor: ["#2ecc71","#3498db"],
                data: sum,
            }]
        },
        // Configuration options go here
        options: {
          title: {
              display: true,
              text: 'Student Gender Chart'
          }
        }
    }); 
  })
  .fail(function() {
    console.log("error");
  });

  // grades chart
  $.ajax({
    url: '/charts/grades',
    type: 'GET',
    dataType: 'JSON'
  })
  .done(function(data) {
    var name = [];
    var students = [];

    for(var index in data){
      name.push(data[index].name);
      students.push(data[index].students);
    }

    var ctx = document.getElementById('gradesBarChart').getContext('2d');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: name,
            datasets: [{
               backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
                data: students,
            }]
        },
        // Configuration options go here
        options: {
          scales: {
              yAxes: [{
                ticks: {
                    beginAtZero:true
                }
              }],
              xAxes: [{
                categoryPercentage: 0.9,
                barPercentage: 1.0
              }]
          },
          legend: {display: false }
        }
    }); 
  })
  .fail(function() {
    console.log("error");
  });
  
</script>
  @if($flash = session('welcome'))
      <script type="text/javascript">
          var message = "Welcome <b>{{$flash}}</b>!";
          welcome(message);
      </script>
  @endif
@endsection