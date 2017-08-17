@extends('layouts.master')

@section('page-title', 'Home')

@section('page-header', 'Home')

@section('page-description', 'Guardian Control Panel')

@section('page-css')
<!-- Animate css -->
  <link href="{{ asset("/bower_components/AdminLTE/plugins/animate/animate.min.css") }}" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb')
    <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
    <li class="active">Dashboard</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>GUARDIAN WARD</h3>
        </div>

        <div class="panel-body">
          <div class="row">
            @foreach($guardians as $guardian)
              @foreach($guardian->student as $student)
                  <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-aqua-active">
                        <div class="widget-user-image">
                          <img class="img-circle" src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{$student->first_name}} {{$student->surname}}</h3>
                        <h5 class="widget-user-desc">{{$student->grade->name}}</h5>
                      </div>
                      <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                          <li><a href="javascript:void(0)">Age<span class="pull-right badge bg-yellow">{{$student->age()}}</span></a></li>

                          <li><a href="javascript:void(0)">Birth Date <span class="pull-right badge bg-aqua">{{$student->date_of_birth->toFormattedDateString()}}</span></a></li>
                          <li><a href="javascript:void(0)">Gender<span class="pull-right badge bg-green">{{$student->gender}}</span></a></li>
                          <li><a href="javascript:void(0)">Address<span class="pull-right badge bg-red">{{$student->address}}</span></a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.widget-user -->
                  </div>
                  <!-- /.col -->
              @endforeach
            @endforeach
          </div>
        </div>
      </div>
    </div>  
  </div>
@endsection


@section('page-scripts')

  @if($flash = session('welcome'))
      <script type="text/javascript">
          var message = "Welcome <b>{{$flash}}</b>!";
          welcome(message);
      </script>
  @endif
@endsection