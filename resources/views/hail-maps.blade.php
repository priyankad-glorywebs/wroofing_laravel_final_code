@extends('layouts.front.master')
@section('title', 'Hail Map')
@section('content')
<div class="breadcrumb-title-wrap">
    <div class="container">
        <div class="row d-lg-none mt-4">
            <div class="col-12">
                <div class="signin-notes">Home / Hail Maps</div>
            </div>
        </div>
        <div class="row breadcrumb-title">
            <div class="col-12 col-lg-7">
                <div class="section-title">Hail Map</div>
            </div>
        </div>
    </div>
</div>
<section class="studio-stepform-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="studio-stepform-wrap">
                    <iframe style="width: 100%; height: 450px;"
                        src="https://maps.interactivehailmaps.com/plugin/hailheatmapwidget?initialdate=2012/4/28&zoomlevel=8&state=mo&city=saint+louis"
                        frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection