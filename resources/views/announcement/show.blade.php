@extends('layouts.main')

@section('content')

    <div class="box">
    <div class="box-header with-border">
    <h3 class="box-title"></h3><a class="badge bg-orange pull-right" href="{{ route('announcement') }}"><span class="fa fa-arrow-left"> </span> Back</a>
    </div>

    <div class="box-body">
        <!-- Apply any bg-* class to to the info-box to color it -->
        <div class="info-box bg-blue">
        <span class="info-box-icon"><i class="fa fa-bell"></i></span>
        <div class="info-box-content">
            <span class="info-box-number">{{ $announcement->note }}</span>
            <span class="info-box-text">{{ $announcement->user->name }}</span>
            <!-- The progress section is optional -->
            <span class="progress-description">
            {{ $announcement->created_at->diffForHumans() }}
            </span>
        </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>


    </div>

@endsection