<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation</title>
    <style>
        
        .quotation-form-wrap {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .inspection-content-wrapper {
    margin-top: 20px; /* Space above the section */
}

.inspection-item {
    border: 1px solid #ddd; /* Optional border for each item */
    border-radius: 5px; /* Rounded corners */
    padding: 10px; /* Padding around content */
    background-color: #f9f9f9; /* Light background color */
}

        /* .form-label {
            color: #555;
        }
        .displayDate {
            font-weight: bold;
        } */
   
@font-face {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: normal;
    font-style: normal;
    src: url(<?php asset('frontend-assets/fonts/PlusJakartaSans-Regular.ttf'); ?>) format('truetype');
}
/* @font-face {
    font-family: 'Plus Jakarta Sans';
    src: url('/frontend-assets/fonts/PlusJakartaSans-Regular.eot');
    src: url('/frontend-assets/fonts/PlusJakartaSans-Regular.eot?#iefix') format('embedded-opentype'),
        url('/frontend-assets/fonts/PlusJakartaSans-Regular.woff') format('woff'),
        url('PlusJakartaSans-Regular.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
} */
    body {font-family: 'Plus Jakarta Sans', sans-serif;}
    .quotation-form-wrap.logo-wrap img {width: auto; height: auto; max-height: 70px; max-width: 220px;}
    .navbar-brand {
        display: none;
    }
    @media print {
        .btn-print {
            display: none;
        }
        .btn-send {
            display: none;
        }
    }
    @media print {
        .navbar {
            display: none;
        }
    }
    @media print {
        .breadcrumb-title-wrap {
            display: none;
        }
    }
    @media print {
        .quotation-aboveprint-btn-sec {
            display: none;
        }
    }
    .quotation-sec .row {
        display: block;
        width:100%;
        
    }
    .row > div.col-6 {
        display: inline-block;
        width: 49%;
    }
    .row > div.col-12 {
        display: inline-block;
        width: 100%;
    }
    .quotation-sec label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 16px;
        font-weight: 600;
        line-height: 1.3;
        color: #2C2C2E;
    }
    .billto-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 20px;
        font-weight: 700;
        margin: 10px 0;
        line-height: 1.3;
        color: #2C2C2E;
    }
    .mb-1 {margin-bottom: .25rem !important;}
    table {margin-bottom:16px;}
    table th {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #E0E0E0;
        border: none;
        white-space: nowrap;
        font-size: 16px;
        font-weight: 600;
        color: #000;
        padding: 15px 20px;
        text-align: left;
        border-left: 0;
        border-right: 0;
    }
    table td {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 16px;
        font-weight: 400;
        color: #2C2C2E;
        padding: 15px 20px;
        border-bottom:1px solid #dee2e6;
    }
    
    .total-title-wrap, 
    .subtotal-title-wrap {
        display:table;
        width: 300px;
    }
    .total-title-wrap > div, 
    .subtotal-title-wrap > div {
        display:table-cell;
        vertical-align: middle;
        width: 50%;
        padding-left: 20px;
        padding-right: 20px;
    }

    .total-title-wrap > div:last-child {text-align: right;} 
    .subtotal-title-wrap > div:last-child {text-align: right;}

    .quotation-sec .subtotal-title-wrap {
        margin-bottom: 10px;
        max-width: 300px;
        margin-left: auto;
    }
    .quotation-sec .subtotal-title {
        font-size: 16px;
        font-weight: 500;
        line-height: 1.3;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #2C2C2E;
        margin-right: 20px;
    }
    .quotation-form-wrap h2, .quotation-form-wrap h3, .quotation-form-wrap h4 {
        color: #2C2C2E !important;
    }
    .quotation-sec .subtotal-detail {
        font-size: 16px;
        font-weight: 400;
        line-height: 1.3;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0A84FF;
        margin-right: 20px;
    }
    .quotation-sec .total-title-wrap {
        padding-top: 20px;
        border-top: 1px solid #E0E0E0;
        max-width: 300px;
        margin-left: auto;
        margin-top: 20px;
    }
    .page-break {
        page-break-after: always;
    }
    @page {
        size: A4;
        margin: 0mm 0mm 0mm 0mm;
    }
    /* .quotation-form-wrap img{
        max-height: 350px;
    } */
    /* .content-wrap{
        max-width: 250px;
        margin-left: auto;
    } */

</style>


<style>
   

    .inspection img {
        border: 1px solid #ddd;
        padding: 5px;
        background-color: #f9f9f9;
    }

    .content-wrap .content {
        /* background-color: #f8f9fa; */

        
    }

    .container #inspection{
        /* padding: 20px;  */
        padding-top: 20px !important;
        padding-left:50px;
        padding-right:50px;
        padding-bottom: 50px;
    }
    .content-wrap .inspectioncontent{
        margin-bottom: 10px !important;
        padding: 0%;
    }
    .inspectioncontent #display-content{
        /* margin-bottom: 10%; */
    }
</style>
</head>
<body>
@php


$primary_color = '#53B746';
$cuserId = auth()->guard('contractor')->user();

if(isset($cuserId['primary_color'])){
$primary_color = $cuserId['primary_color'];
}


$reportSections = $reportSections->sortBy('order');
$sectionTitles = [
1 => 'Title ', 
2 => 'Introduction Title',
3 => 'Inspection Title',
4 => 'Terms and Conditions',
5 => 'Quotation',
6 => 'Warranty',
16 => 'Thank You Page', 
];

    @endphp
@if(isset($reportSections) && $reportSections->count() > 0)


@foreach ($reportSections as $section)
@php
$content = json_decode($section->content, true);
@endphp
        
@if (array_key_exists($section->section_type_id, $sectionTitles))
@if(isset($section->status) && $section->status == 'active')

<section class="quotation-sec" style="height: 1120px; background-repeat: no-repeat; background-position: bottom right; background-image: url(data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path('frontend-assets/images/pdf-bg.png'))) }});">
<div class="container-fluid" style="border-bottom: 4px solid {{$primary_color}}; padding: 30px 50px;">
    <div class="row">
        <div class="col-12">
            <div class="quotation-form-wrap logo-wrap">
                <div class="row">

                    <div class="col-12">
                        {{-- @php
                            $logoPath = $quoteData->contractor->company_logo ?? 'frontend-assets/images/logo.png';
                        @endphp
                        <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path($logoPath))) }}" style="height:auto" width="{{ isset($quoteData->contractor->company_logo) ? 120 : 220 }}">
                    --}}@php 
                    if(isset($section->section_type_id)){
                        $logoPath = $content['company_logo']?? 'frontend-assets/images/logo.png';
                    }

                    @endphp
                <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path($logoPath))) }}" width="{{ isset($logoPath) ? 120 : 220 }}">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



 <div class="container">
    <div class="row">
        <div class="col-12">
                @switch($section->section_type_id)

                
               @case(1)
                        @if(isset($section->status) && $section->status == 'active')
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quotation-form-wrap">
                                        <div class="row">
                                            <div class="col-12">
                                                @php 
                                                    if(isset($content['banner_image'])){
                                                        $banner_image_Path = base64_encode(file_get_contents(public_path($content['banner_image'])));
                                                    }else{
                                                        $banner_image_Path = base64_encode(file_get_contents(base_path('public/frontend-assets/images/page1.png')));
                                                    }
                                                @endphp
                                                <img src="data:image/svg+xml;base64,<?php echo  $banner_image_Path; ?>" width="596" height="443" style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quotation-form-wrap" style="padding:50px;">
                                        <form id="quotation-form">
                                            <div class="row">
                                                <div class="col-6" style="width: 46%;vertical-align: top;">
                                                    <div class="billto-title" style="font-size:30px;">@if(isset($content['title'])){{$content['title']}}@endif</div>
                                                    <div class="row" style="margin-top:10px;">
                                                        <div style="width: 30px; display:inline-block;">
                                                            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/calendar.svg'))); ?>" width="18" height="18">
                                                        </div>
                                                        <div style="width: calc(100% - 30px); display:inline-block; color:##53B746;">{{ \Carbon\Carbon::parse($content['date']??'')->format('M d , Y') }}</div>
                                                    </div>
                
                                                    <div class="row" style="margin-top:10px;">
                                                        <div style="width: 30px; display:inline-block;">
                                                                <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/Vector.svg'))); ?>" width="18" height="18">
                                                        </div>
                                                        <div style="width: calc(100% - 30px); display:inline-block; color:#53B746;">{{$content['company_name']??''}}</div>
                                                    </div>
                                                </div>
                
                                                
                                                <div class="col-6" style="border-left:4px solid {{$primary_color}};padding-left:30px;width: 46%;vertical-align: top;">
                                                    <div class="billto-title" style="margin-bottom:10px;">{{ $content['first_name'] ?? '' }}  {{ $content['last_name'] ?? '' }}</div>
                                                    <div class="row" style="margin-top:10px;display: table; width: 100%;">
                                                        <div style="width: 30px; display:table-cell;padding-top:10px;vertical-align: top;">
                                                            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/location.svg'))); ?>" width="16" height="18">
                                                        </div>
                                                        <div style="width: calc(100% - 40px); display:table-cell; display:inline-block;padding-top:10px;vertical-align: top;font-family: 'Plus Jakarta Sans', sans-serif;">{{$content['address']??""}}</div>
                                                    </div>
                                                    @php 
                                                    $cuserId = auth()->guard('contractor')->user();
                                                    @endphp
                                                    <div class="row" style="display: table;width: 100%;">
                                                        <div style="width: 30px; display:table-cell;padding-top:10px;vertical-align: top;">
                                                            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/phone.svg'))); ?>" width="15" height="16">
                                                        </div>
                                                        <div style="width: 100%; display:table-cell; padding-top:10px;vertical-align: top;font-family: 'Plus Jakarta Sans', sans-serif;"><a style="font-family: 'Plus Jakarta Sans', sans-serif;text-decoration: none;" href=""> {{$cuserId->contact_number??""}}</div>
                                                    </div>
                                                    <div class="row" style="display: table;width: 100%;">
                                                        <div style="width: 30px; display:table-cell;padding-top:10px;vertical-align: top;">
                                                            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/email.svg'))); ?>" width="16" height="14">
                                                        </div>
                                                        <div style="width: 100%; display:table-cell; padding-top:10px;vertical-align: top;"><a style="text-decoration: none;font-family: 'Plus Jakarta Sans', sans-serif;" href=""> {{$cuserId->email??""}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @break

                        @case(2)
    @if(isset($section->status) && $section->status == 'active')

        @if(isset($content['introduction_title']) || isset($content['content']))
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="quotation-form-wrap" style="padding:50px;">
                            @php
                                $reportId = $section->report_id;
                                $reportData = \App\Models\Report::where('id', $reportId)->first();
                                $data = \App\Models\Project::where('id',$reportData['project_id'])->first();
                                $customerName = \App\Models\User::find($data['user_id']); 

                                $salesData = auth()->guard('contractor')->user();

                                $content = str_replace('{{CUSTOMER_FULL_NAME}}', $customerName['name'] ?? '', $content);
                                $content = str_replace('{{SALES_PERSON_FULL_NAME}}', $salesData['name'] ?? '', $content);
                                $content = str_replace('{{SALES_PERSON_PHONE}}', $salesData['contact_number'] ?? '', $content);
                                $content = str_replace('{{SALES_PERSON_EMAIL}}', $salesData['email'] ?? '', $content);
                                $content = str_replace('{{COMPANY_NAME}}', $salesData['company_name'] ?? '', $content);
                            @endphp

                            @if(isset($content['introduction_title']) && !empty($content['introduction_title']))
                                <div class="textLayer">
                                    <b>
                                        <span style="left: 38.4px; top: 91.7115px; color: {{$primary_color}}; font-size: 20.6px; font-family: sans-serif; transform: scaleX(1.00323);">
                                            {{ $content['introduction_title'] }}
                                        </span>
                                    </b>
                                    <div class="endOfContent"></div>
                                </div>
                                <br/><br/>
                            @endif

                            @if(isset($content['content']) && !empty($content['content']))
                                <form id="quotation-form" style="font-size:16px; color:#777777; padding-top:10px;">
                                    {!! $content['content'] !!}
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endif
    @break

                    {{-- @case(2)
                        
                        @if(isset($section->status) && $section->status == 'active')

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="quotation-form-wrap" style="padding:50px;">
                                    @php
                                    $reportId = $section->report_id;
                                        $reportData = \App\Models\Report::where('id', $reportId)->first();
                                        $data = \App\Models\Project::where('id',$reportData['project_id'])->first();
                                        $customerName = \App\Models\User::find($data['user_id']); 

                                        $salesData =  auth()->guard('contractor')->user();
                                        // Prepare content
                                        $contentData = "{{CUSTOMER_FULL_NAME}}"; 
                                        $content = str_replace('{{CUSTOMER_FULL_NAME}}', $customerName['name']??'', $content);
                                        $contentData = "{{SALES_PERSON_FULL_NAME}}";
                                        $content = str_replace('{{SALES_PERSON_FULL_NAME}}', $salesData['name']??'', $content);
                                        $contentData = "{{SALES_PERSON_PHONE}}";
                                        $content = str_replace('{{SALES_PERSON_PHONE}}', $salesData['contact_number']??'', $content);
                                        $contentData = "{{SALES_PERSON_EMAIL}}";
                                        $content = str_replace('{{SALES_PERSON_EMAIL}}', $salesData['email']??'', $content);
                                        $contentData = "{{COMPANY_NAME}}";
                                        $content = str_replace('{{COMPANY_NAME}}', $salesData['company_name']??'', $content);
                                    @endphp

                                    @if(isset($content['introduction_title'])) 
                                    <div class="textLayer" style=""><b><span style="left: 38.4px; top: 91.7115px;color:{{$primary_color}};font-size: 20.6px; font-family: sans-serif; transform: scaleX(1.00323);">{{ $content['introduction_title'] }}</span></b><div class="endOfContent" style=""></div></div>
                                        <br/><br/>
                                       @if(isset($content['content']))
                                        <form id="quotation-form" style="font-size:16px; color:#777777; padding-top:10px;">
                                            {!! $content['content'] !!}
                                        </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @break --}}

                {{-- @case(3)
                <div class="container" id="inspection">
                    @if(isset($content['inspection_title']))
                        <div class="row" style="display: block; width: 100%;">
                            <div class="col-12" style="width: 92%; vertical-align: top; display: block; margin-bottom: 20px;">
                                <h3 class="text-primary" style="color: {{$primary_color}};">{{ $content['inspection_title'] }}</h3>
                            </div>
                        </div>
                    @endif
                
                    @if(isset($section->status) && $section->status == 'active')
                        <div class="row" style="display: block;">
                            <div class="col-6" style="width: 46%; vertical-align: middle; display: inline-block;">
                                @if (isset($content['inspection_image']) && !empty($content['inspection_image']))
                                    <div class="inspection mb-4">
                                        @php
                                        $imagePath = public_path($content['inspection_image']);
                                        $imageData = base64_encode(file_get_contents($imagePath));
                                        $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                                    @endphp
                                    <img src="data:image/{{ $imageType }};base64,{{ $imageData }}" width="300" height="250" alt="Inspection Image">
                                    </div>
                                @endif
                            </div>
                
                            <div class="col-6 pl-5" style="width: 46%; vertical-align: middle; display: inline-block; padding-left: 20px;">
                                <div class="content-wrap inspectioncontent">
                                    @if(isset($content['inspection_content']))
                                        <div class="content border rounded" id="display-content">
                                            {!! $content['inspection_content'] !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @break --}}

                @case(3)
                @if(isset($content['inspection_title']) || (isset($content['inspection_image']) && !empty($content['inspection_image'])) || isset($content['inspection_content']))
                    <div class="container" id="inspection">
                        @if(isset($content['inspection_title']) && !empty($content['inspection_title']))
                            <div class="row" style="display: block; width: 100%;">
                                <div class="col-12" style="width: 92%; vertical-align: top; display: block; margin-bottom: 20px;">
                                    <h3 class="text-primary" style="color: {{$primary_color}};">{{ $content['inspection_title'] }}</h3>
                                </div>
                            </div>
                        @endif
            
                        @if(isset($section->status) && $section->status == 'active')
                            <div class="row" style="display: block;">
                                <div class="col-6" style="width: 46%; vertical-align: middle; display: inline-block;">
                                    @if (isset($content['inspection_image']) && !empty($content['inspection_image']))
                                        <div class="inspection mb-4">
                                            @php
                                                $imagePath = public_path($content['inspection_image']);
                                                $imageExists = file_exists($imagePath);
                                            @endphp
                                            
                                            @if($imageExists)
                                                @php
                                                    $imageData = base64_encode(file_get_contents($imagePath));
                                                    $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                                                @endphp
                                                <img src="data:image/{{ $imageType }};base64,{{ $imageData }}" width="300" height="250" alt="Inspection Image">
                                            @else
                                                <p>Image not found.</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
            
                                <div class="col-6 pl-5" style="width: 46%; vertical-align: middle; display: inline-block; padding-left: 20px;">
                                    <div class="content-wrap inspectioncontent">
                                        @if(isset($content['inspection_content']) && !empty($content['inspection_content']))
                                            <div class="content border rounded" id="display-content">
                                                {!! $content['inspection_content'] !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                @break
            



                
                {{-- working code --}}
                {{-- <div class="container" id="inspection">
                    @if(isset($content['inspection_title']))
                    <div class="row" style="display: block; width:100%;">
                        <div class="col-12" style="width: 92%; vertical-align: top; display:block; margin-bottom:20px;">
                            <h3 class="text-primary" style="color:{{$primary_color}}">{{$content['inspection_title']??''}}</h3>
                        </div>
                    </div>
                    @endif
                    @if(isset($section->status) && $section->status == 'active')
                    
                    <div class="row" style="display: block;">
                        <div class="col-6" style="width: 46%; vertical-align: middle; display:inline-block;">
                            @foreach ($reportSections as $section)
                                @php
                                    $content_image = json_decode($section->content_image, true);
                                @endphp
                                @if (isset($content_image['images']) && is_array($content_image['images'])  ) 
                                
                                    @foreach ($content_image['images'] as $editorKey => $imagePath)
                                        <div class="inspection mb-4">
                                            <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path($imagePath))) }}"  width="300" height="250">

                                        </div>
                                    
                                    @endforeach
                                @endif
                                
                            @endforeach
                        </div>
                
                            <div class="col-6 pl-5" style="width:46%; vertical-align: middle; display:inline-block; padding-left:20px;">
                                <div class="content-wrap inspectioncontent">
                                    @foreach ($reportSections as $section)
                                        @php
                                            $content_image = json_decode($section->content_image, true);
                                        @endphp
                                        @if(isset($content['content']) && is_array($content['content']))
                                            @foreach ($content['content'] as $editorKey => $content)
                                                <div class="content border rounded" id="display-content">
                                                    {!! $content ?? '' !!}
                                                </div>
                                            @endforeach
                                        @endif
                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    
                    @endif
                </div> --}}
                 {{-- working code --}}

            
                {{-- @break --}}
                    
                        
                @case(4)
    @if(isset($section->status) && $section->status == 'active')
        @if(!empty($content['term_page_title']) || !empty($content['content']))
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="quotation-form-wrap" style="padding:50px;">
                            @if(!empty($content['term_page_title']))
                                <div class="textLayer" style="">
                                    <b>
                                        <span style="left: 38.4px; top: 91.7115px; color: {{$primary_color}}; font-size: 20.6px; font-family: sans-serif; transform: scaleX(1.00323);">
                                            {{ $content['term_page_title'] }}
                                        </span>
                                    </b>
                                    <div class="endOfContent" style=""></div>
                                </div>
                            @endif

                            @if(!empty($content['content']))
                                <form id="quotation-form" style="font-size:16px; color:#777777; padding-top:20px;">
                                    {!! $content['content'] !!}
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
    @break


                    {{-- @case(4)
                    @if(isset($section->status) && $section->status == 'active')
                    <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quotation-form-wrap" style="padding:50px;">
                                        <div class="textLayer" style=""><b><span style="left: 38.4px; top: 91.7115px;color:{{$primary_color}};font-size: 20.6px; font-family: sans-serif; transform: scaleX(1.00323);">{{ $content['term_page_title'] }}</span></b><div class="endOfContent" style=""></div></div>

                                                <form id="quotation-form" style="font-size:16px; color:#777777; padding-top:20px;">
                                                    {!! $content['content']??'' !!}
                                                </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                        @break --}}



                        {{-- @case(5)
                    @if(isset($section->status) && $section->status == 'active')

                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quotation-form-wrap" style="padding:50px;">
                                        <form id="quotation-form" style="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="textLayer" style=""><b><span style="left: 38.4px; top: 91.7115px;color:{{$primary_color}};font-size: 20.6px; font-family: sans-serif; transform: scaleX(1.00323);">{{ $content['quote_details_title']??'' }}</span></b><div class="endOfContent" style=""></div></div>

                                                    @php
                                                    $cuserId = auth()->guard('contractor')->user();
                                                    @endphp 
                                                    
                                                    @if(isset($cuserId->company_name))
                                                    <div class="field-wrap mb-1">
                                                        <div class="form-element">
                                                            <span style="font-family: 'Plus Jakarta Sans', sans-serif;"><h3><b>{{$cuserId->company_name??""}}</b></h3></span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    
                                                    @if(isset($cuserId->name))
                                                    <div class="field-wrap mb-1">
                                                        <div class="form-element">
                                                            <span style="font-family: 'Plus Jakarta Sans', sans-serif;">{{$cuserId->name??''}}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    
                                                    @if(isset($cuserId->email))
                                                    <div class="field-wrap mb-1">
                                                        <div class="form-element">
                                                            <span style="font-family: 'Plus Jakarta Sans', sans-serif;">{{$cuserId->email??""}}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    @if(isset($section->report_id))
                                                    <div class="field-wrap mb-1" style="width: 250px; margin-left:auto;">
                                                        <div class="form-element duedate-inputs d-flex align-items-center" style="font-family: 'Plus Jakarta Sans', sans-serif; max-width:200px; width:100%; display:table;">
                                                            <label for="quotationno" class="form-label" style="font-family: 'Plus Jakarta Sans', sans-serif;display: table-cell; width:50%;"> Quotation No:</label> <span style="display: table-cell; width:50%;text-align:right;">{{$section->report_id??''}}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                        
                                                    @if(isset($content['date']))
                                                    <div class="field-wrap mb-1" style="width: 250px; margin-left:auto;">
                                                        <div class="form-element duedate-inputs d-flex align-items-center" style="font-family: 'Plus Jakarta Sans', sans-serif; max-width:200px; width:100%; display:table;">
                                                            <label for="duedate" class="form-label" style="font-family: 'Plus Jakarta Sans', sans-serif;display: table-cell; width:50%;">Due date:</label>
                                                            <span style="display: table-cell; width:50%; text-align:right;">{{ \Carbon\Carbon::parse($content['date']??'')->format('m /d /Y') }}</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-12"><hr style="background-color: #E0E0E0;margin: 20px 0;height: 1px;border: 0;opacity: .25;"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <div class="billto-title">Bill To:</div>
                                                </div>
                                            </div>
                                            @php
                                            $reportId = $section->report_id;
                                            $reportData = \App\Models\Report::where('id', $reportId)->first();
                                            $data = \App\Models\Project::where('id',$reportData['project_id'])->first();
                                            $customer = \App\Models\User::find($data['user_id']);
                                            @endphp
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="field-wrap mb-1" >
                                                        <div class="form-element d-flex align-items-center">
                                                            {{$customer['name']??''}}
                                                        </div>
                                                    </div>
                                                    <div class="field-wrap mb-1">
                                                        <div class="form-element d-flex align-items-center justify-content-between">
                                                            {{$customer['address']??''}}
                
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                
                
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table" width="100%" style="border-collapse: collapse; margin-top:30px;">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th width="40%" style="background-color:#E0E0E0; border-color:red;font-family: 'Plus Jakarta Sans', sans-serif;">Description</th>
                                                                    <th width="15%" style="background-color:#E0E0E0;font-family: 'Plus Jakarta Sans', sans-serif;">Qty</th>
                                                                    <th width="15%" style="background-color:#E0E0E0;font-family: 'Plus Jakarta Sans', sans-serif;">Unit Price</th>
                                                                    <th width="15%" style="background-color:#E0E0E0;font-family: 'Plus Jakarta Sans', sans-serif;text-align:right;">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                                    @if (isset($content['quote_details_title']))
                                                                        @php
                                                                            $subtotal = 0; 
                                                                        @endphp
                                                                        @foreach ($content['items'] as $item)
                                                                            <tr>
                                                                                <td>{{ $item['description'] }}</td>
                
                                                                                <td>{{ $item['qty'] }}</td>
                                                                                <td>${{ $item['price'] }}</td>
                                                                                <td>${{ $item['qty'] * $item['price'] }}</td>
                                                                            </tr>
                                                                            @php
                                                                                $subtotal += $item['qty'] * $item['price'];
                                                                            @endphp
                                                                        @endforeach
                                                                        @endif
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:16px;">
                                                <div class="col-6" style="vertical-align: top;">
                                                    @if(isset($content['message']) && $content['message'] !== '')
                
                                                    <div class="field-wrap">
                                                        <div class="form-label">
                                                            <label for="address">Message to customer</label>
                                                        </div>
                                                        <div class="form-element mt-4">
                                                            {{$content['message']??''}}
                                                        </div>
                                                    </div>
                                                    @endif
                
                                                </div>
                                                <div class="col-6">
                                                    <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
                                                        <div class="subtotal-title" style="font-weight:100">Quote Subtotal:</div>
                                                        <div class="subtotal-detail">${{ number_format($subtotal??'', 2) }}</div>
                                                    </div>
                                                </div>
                                                    <div class="total-title-wrap d-flex align-items-center justify-content-end" style="padding-left:385px; ">
                                                        <div class="subtotal-title">Total:</div>
                                                        <div class="subtotal-detail" style="font-size: 24px;font-weight: 800;">${{ number_format($subtotal??'', 2) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @break --}}
    @case(5)
    @if(isset($section->status) && $section->status == 'active')
        @php
            $reportId = $section->report_id ?? null;
            $reportData = $reportId ? \App\Models\Report::find($reportId) : null;
            $projectId = $reportData->project_id ?? null;
            $data = $projectId ? \App\Models\Project::find($projectId) : null;
            $customerId = $data->user_id ?? null;
            $customer = $customerId ? \App\Models\User::find($customerId) : null;

            $cuserId = auth()->guard('contractor')->user();
        @endphp

        @if(isset($content) && $content && !empty($content['quote_details_title']) && $customer && $cuserId)
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="quotation-form-wrap" style="padding:50px;">
                            <form id="quotation-form" style="">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="textLayer" style="">
                                            <b>
                                                <span style="left: 38.4px; top: 91.7115px; color:{{ $primary_color }}; font-size: 20.6px; font-family: sans-serif; transform: scaleX(1.00323);">
                                                    {{ $content['quote_details_title'] }}
                                                </span>
                                            </b>
                                            <div class="endOfContent" style=""></div>
                                        </div>

                                        @if(isset($cuserId->company_name))
                                            <div class="field-wrap mb-1">
                                                <div class="form-element">
                                                    <h3><b>{{ $cuserId->company_name }}</b></h3>
                                                </div>
                                            </div>
                                        @endif

                                        @if(isset($cuserId->name))
                                            <div class="field-wrap mb-1">
                                                <div class="form-element">{{ $cuserId->name }}</div>
                                            </div>
                                        @endif

                                        @if(isset($cuserId->email))
                                            <div class="field-wrap mb-1">
                                                <div class="form-element">{{ $cuserId->email }}</div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        @if(isset($section->report_id))
                                            <div class="field-wrap mb-1" style="width: 250px; margin-left:auto;">
                                                <div class="form-element duedate-inputs d-flex align-items-center" style="font-family: 'Plus Jakarta Sans', sans-serif; max-width:200px; width:100%; display:table;">
                                                    <label for="quotationno" class="form-label" style="display: table-cell; width:50%;">Quotation No:</label>
                                                    <span style="display: table-cell; width:50%;text-align:right;">{{ $section->report_id }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if(isset($content['date']) && !empty($content['date']))
                                            <div class="field-wrap mb-1" style="width: 250px; margin-left:auto;">
                                                <div class="form-element duedate-inputs d-flex align-items-center" style="font-family: 'Plus Jakarta Sans', sans-serif; max-width:200px; width:100%; display:table;">
                                                    <label for="duedate" class="form-label" style="display: table-cell; width:50%;">Due date:</label>
                                                    <span style="display: table-cell; width:50%; text-align:right;">{{ \Carbon\Carbon::parse($content['date'])->format('m/d/Y') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <hr style="background-color: #E0E0E0;margin: 20px 0;height: 1px;border: 0;opacity: .25;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="billto-title">Bill To:</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="field-wrap mb-1">
                                            <div class="form-element d-flex align-items-center">
                                                {{ $customer->name ?? '' }}
                                            </div>
                                        </div>
                                        <div class="field-wrap mb-1">
                                            <div class="form-element d-flex align-items-center justify-content-between">
                                                {{ $customer->address ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table" width="100%" style="border-collapse: collapse; margin-top:30px;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th width="40%" style="background-color:#E0E0E0; font-family: 'Plus Jakarta Sans', sans-serif;">Description</th>
                                                        <th width="15%" style="background-color:#E0E0E0; font-family: 'Plus Jakarta Sans', sans-serif;">Qty</th>
                                                        <th width="15%" style="background-color:#E0E0E0; font-family: 'Plus Jakarta Sans', sans-serif;">Unit Price</th>
                                                        <th width="15%" style="background-color:#E0E0E0; font-family: 'Plus Jakarta Sans', sans-serif; text-align:right;">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $subtotal = 0; @endphp
                                                    @if (isset($content['quote_details_title']))
                                                        @foreach ($content['items'] as $item)
                                                            <tr>
                                                                <td>{{ $item['description'] }}</td>
                                                                <td>{{ $item['qty'] }}</td>
                                                                <td>${{ $item['price'] }}</td>
                                                                <td>${{ $item['qty'] * $item['price'] }}</td>
                                                            </tr>
                                                            @php $subtotal += $item['qty'] * $item['price']; @endphp
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:16px;">
                                    <div class="col-6" style="vertical-align: top;">
                                        @if(isset($content['message']) && $content['message'] !== '')
                                            <div class="field-wrap">
                                                <div class="form-label">
                                                    <label for="address">Message to customer</label>
                                                </div>
                                                <div class="form-element mt-4">{{ $content['message'] }}</div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
                                            <div class="subtotal-title" style="font-weight:100">Quote Subtotal:</div>
                                            <div class="subtotal-detail">${{ number_format($subtotal, 2) }}</div>
                                        </div>
                                    </div>
                                    <div class="total-title-wrap d-flex align-items-center justify-content-end" style="padding-left:385px;">
                                        <div class="subtotal-title">Total:</div>
                                        <div class="subtotal-detail" style="font-size: 24px; font-weight: 800;">${{ number_format($subtotal, 2) }}</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
    @break

                    {{-- @case(6) --}}
                    {{-- @php
                    $reportId = $section->report_id;
                    $reportData = \App\Models\Report::where('id', $reportId)->first();
                    $data = \App\Models\Project::where('id',$reportData['project_id'])->first();
                    $customer = \App\Models\User::find($data['user_id']);
                    @endphp
                    @if(isset($section->status) && $section->status == 'active')
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quotation-form-wrap" style="padding: 50px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px;">
                                            @if (isset($content['title']))
                                                <div class="textLayer" style=""><b><span style="left: 38.4px; top: 91.7115px;color:{{$primary_color}};font-size: 20.6px; font-family: sans-serif; transform: scaleX(1.00323);">{{ $content['title']??'' }}</span></b><div class="endOfContent" style=""></div></div>

                        
                                                <div class="mt-4">
                                                    <div class=""><strong>Customer Name:</strong></div>
                                                    <p>{{ $customer['name'] ?? '' }}</p>
                        
                                                    <div class="mb-3"><strong>Address:</strong></div>
                                                    <p>{{ $customer['address'] ?? '' }}</p>
                        
                                                    @if (isset($content['date']))
                                                        <div class="mb-3"><strong>Date Project Completed:</strong></div>
                                                        <p class="displayDate">{{ \Carbon\Carbon::parse($content['date'] ?? '')->format('M d, Y') }}</p>
                                                    @endif
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @break --}}

                        @case(6)
                                @php
                                    $reportId = $section->report_id;
                                    $reportData = \App\Models\Report::where('id', $reportId)->first();
                                    $data = $reportData ? \App\Models\Project::where('id', $reportData->project_id)->first() : null;
                                    $customer = $data ? \App\Models\User::find($data->user_id) : null;
                                @endphp

                    @if (isset($section->status) && $section->status == 'active' && $content && !empty($content['title']) && $customer)
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quotation-form-wrap" style="padding: 50px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px;">
                                        @if (isset($content['title']))
                                            <div class="textLayer" style="">
                                                <b>
                                                    <span style="left: 38.4px; top: 91.7115px; color:{{ $primary_color }}; font-size: 20.6px; font-family: sans-serif; transform: scaleX(1.00323);">
                                                        {{ $content['title'] }}
                                                    </span>
                                                </b>
                                                <div class="endOfContent" style=""></div>
                                            </div>

                                            <div class="mt-4">
                                                @if (isset($customer->name))
                                                    <div class=""><strong>Customer Name:</strong></div>
                                                    <p>{{ $customer->name }}</p>
                                                @endif

                                                @if (isset($customer->address))
                                                    <div class="mb-3"><strong>Address:</strong></div>
                                                    <p>{{ $customer->address }}</p>
                                                @endif

                                                @if (isset($content['date']) && !empty($content['date']))
                                                    <div class="mb-3"><strong>Date Project Completed:</strong></div>
                                                    <p class="displayDate">{{ \Carbon\Carbon::parse($content['date'] ?? '')->format('M d, Y') }}</p>
                                                    @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @break

                        @case(16)

                        @if(isset($section->status) && $section->status == 'active')
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quotation-form-wrap" style="padding:50px;">
                                        <form id="quotation-form">
                                            <div class="row">
                                                @if(!empty($content['thankyou_logo']) && file_exists(public_path($content['thankyou_logo'])))
                                                <div class="col-12" style="text-align: center;">
                                                    <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path($content['thankyou_logo']))) }}"  width="91" height="85">
                                                </div>
                                                @endif

                                                @if(!empty($content['thankyou_title']))
                                                <div class="col-12">
                                                    <div class="field-wrap mb-1" style="text-align:center;">
                                                        @php
                                                            $title = explode(' ', $content['thankyou_title']);
                                                        @endphp
                                                        <div class="form-element" style="font-size:36px; font-weight: 700; color:#2c2c2e; padding-top:10px; font-family: 'Plus Jakarta Sans', sans-serif;">
                                                            {{ $title[0] ?? '' }}<span style="color:#53B746;">{{ $title[1] ?? '' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                

                                                @if(!empty($content['thankyou-content']))
                                            
                                                <div class="col-12">
                                                    <div class="field-wrap mb-1" style="text-align:center;">
                                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">
                                                            {!! $content['thankyou-content'] !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @break

                        {{-- @if(isset($section->status) && $section->status == 'active')

                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quotation-form-wrap" style="padding:50px;">
                                        <form id="quotation-form" style="">
                                            <div class="row">
                                                <div class="col-12" style="text-align: center;">
                                                    <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path($content['thankyou_logo']))) }}"  width="91" height="85">
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-wrap mb-1" style="text-align:center;">
                                                    @php
                                                        $title = explode(' ', $content['thankyou_title']);  
                                                    @endphp
                                                    <div class="form-element" style="font-size:36px; font-weight: 700; color:#2c2c2e; padding-top:10px; font-family: 'Plus Jakarta Sans', sans-serif;">
                                                        {{ $title[0] ?? '' }}<span style="color:#53B746;">{{ $title[1] ?? '' }}</span>
                                                    </div>
                                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">{!!$content['thankyou-content']??''!!}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        @endif
                        @break --}}
                @endswitch
        </div>
    </div>
</div>
</section>
@endif
@endif
@endforeach

@else
<p>No report sections available.</p>

@endif

</body>

</html>