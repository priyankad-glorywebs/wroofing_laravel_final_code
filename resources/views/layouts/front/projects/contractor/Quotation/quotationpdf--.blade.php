<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hello, world!</title>
  
    <style>

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
        display:block;
        text-align:right;
    }
    .total-title-wrap > div, 
    .subtotal-title-wrap > div {
        display:inline-block;
        vertical-align: middle;
    }
    .quotation-sec .subtotal-title-wrap {
        margin-bottom: 10px;
    }
    .quotation-sec .subtotal-title {
        font-size: 16px;
        font-weight: 500;
        line-height: 1.3;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #2C2C2E;
        margin-right: 20px;
    }
    .quotation-sec .subtotal-detail {
        font-size: 16px;
        font-weight: 400;
        line-height: 1.3;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0A84FF;
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
</style>
</head>
<body>
    <section class="quotation-sec" style="height: 1120px;background-repeat: no-repeat;background-position: bottom right;background-image:url(data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/pdf-bg.png'))); ?>);">
        <div class="container-fluid" style="border-bottom: 4px solid #53B746; padding: 30px 50px;">
            <div class="row">
                <div class="col-12">
                    <div class="quotation-form-wrap">
                        <div class="row">
                            <div class="col-12">
                                {{--<img src="data:image/svg+xml;base64,<?php //echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/forward-logo.png'))); ?>"  width="120">
                            --}}
                            @if (file_exists (public_path ($quoteData->contractor->company_logo)))
                            <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/'.$quoteData->contractor->company_logo))); ?>"  width="120">
                            {{-- onerror="this.onerror=null;callfundata(this);" --}}
                            @else
                            <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/logo.png'))); ?>"  width="220">
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="quotation-form-wrap">
                        <div class="row">
                            <div class="col-12">
                                @if (file_exists (public_path ($quoteData->contractor->banner_image??'')))
                                <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/'.$quoteData->contractor->banner_image??""))); ?>" width="596" height="443" style="width:100%;">

@endsection

@section('content')
    <section class="quotation-sec" style="height: 1120px;background-repeat: no-repeat;background-position: bottom right;background-image:url(data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/pdf-bg.png'))); ?>);">
		<div class="container-fluid" style="border-bottom: 4px solid #53B746; padding: 30px 50px;">
			<div class="row">
				<div class="col-12">
					<div class="quotation-form-wrap">
						<div class="row">
							<div class="col-12">
								<!-- <img src="{{asset('frontend-assets/images/forward-logo.png')}}" alt="forward-logo" width="230" height="57">
							    	<img src="{{public_path('frontend-assets/images/forward-logo.png')}}" alt="forward-logo" width="230" height="57"> -->
                                <!-- <img src="{{public_path('frontend-assets/images/forward-logo.png')}}" alt="Logo" width="230">  -->
                                @if (file_exists (public_path ($quoteData->contractor->company_logo)))
                                <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/'.$quoteData->contractor->company_logo))); ?>"  width="120">
                                {{-- onerror="this.onerror=null;callfundata(this);" --}}
                                @else
                                <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/logo.png'))); ?>"  width="220">
                                
                                @endif
                            </div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="quotation-form-wrap">
						<div class="row">
							<div class="col-12">
                                @if (file_exists (public_path ($quoteData->contractor->banner_image??'')))
                                <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/'.$quoteData->contractor->banner_image??""))); ?>" width="596" height="443" style="width:100%;">

                                @else
							  <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/page1.png'))); ?>" width="596" height="443" style="width:100%;">
                                @endif
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
                                    <div class="billto-title" style="font-size:30px;">Roofing Quote</div>
                                    <div class="row" style="margin-top:10px;">
                                        <div style="width: 30px; display:inline-block;">
                                            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/calendar.png'))); ?>" width="18" height="18">
                                        </div>
                                        <div style="width: calc(100% - 30px); display:inline-block; color:#53B746;">{{ \Carbon\Carbon::parse($quoteData->due_date??'')->format('M d , Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-6" style="border-left:4px solid #53B746;padding-left:30px;width: 46%;vertical-align: top;">
                                    <div class="billto-title" style="margin-bottom:10px;">{{$quoteData->contractor->name??""}}</div>
                                    <div class="row" style="margin-top:10px;display: table; width: 100%;">
                                        <div style="width: 30px; display:table-cell;padding-top:10px;vertical-align: top;">
                                            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/location.png'))); ?>" width="16" height="18">
                                        </div>
                                        <div style="width: calc(100% - 40px); display:table-cell; display:inline-block;padding-top:10px;vertical-align: top;font-family: 'Plus Jakarta Sans', sans-serif;">{{$quoteData->contractor->address??""}}</div>
                                    </div>
                                    <div class="row" style="display: table;width: 100%;">
                                        <div style="width: 30px; display:table-cell;padding-top:10px;vertical-align: top;">
                                            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/phone.png'))); ?>" width="15" height="16">
                                        </div>
                                        <div style="width: 100%; display:table-cell; padding-top:10px;vertical-align: top;font-family: 'Plus Jakarta Sans', sans-serif;"><a style="font-family: 'Plus Jakarta Sans', sans-serif;text-decoration: none;" href="tel:4108468072"> {{$quoteData->contractor->contact_number??""}}</div>
                                    </div>
                                    <div class="row" style="display: table;width: 100%;">
                                        <div style="width: 30px; display:table-cell;padding-top:10px;vertical-align: top;">
                                            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/sms.png'))); ?>" width="16" height="14">
                                        </div>
                                        <div style="width: 100%; display:table-cell; padding-top:10px;vertical-align: top;"><a style="text-decoration: none;font-family: 'Plus Jakarta Sans', sans-serif;" href="mailto: {{$quoteData->contractor->email??""}}"> {{$quoteData->contractor->email??""}}</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    <div class="page-break"></div>
    <section class="quotation-sec" style="height: 1120px;background-repeat: no-repeat;background-position: bottom right;background-image:url(data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/pdf-bg.png'))); ?>);">
        <div class="container-fluid" style="border-bottom: 4px solid #53B746; padding: 30px 50px;">
            <div class="row">
                <div class="col-12">
                    <div class="quotation-form-wrap">
                        <div class="row">
                            <div class="col-12">
                                @if (file_exists (public_path ($quoteData->contractor->company_logo)))
                            <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/'.$quoteData->contractor->company_logo))); ?>"  width="120">
                            {{-- onerror="this.onerror=null;callfundata(this);" --}}
                            @else
                            <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/logo.png'))); ?>"  width="220">
                            @endif
                               {{-- <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/logo.png'))); ?>"  width="220">--}}
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
                        <form id="quotation-form" style="">
                            <div class="row">
                                <div class="col-6">
                                   @if(isset($quoteData->contractor->company_name))
                                    <div class="field-wrap mb-1">
                                        <div class="form-element">
                                            <!-- <span>Forward Financial Company</span> -->
                                            <span style="font-family: 'Plus Jakarta Sans', sans-serif;">{{$quoteData->contractor->company_name??""}}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($quoteData->contractor->name))
                                    <div class="field-wrap mb-1">
                                        <div class="form-element">
                                            <!-- <span>John doe (your name here)</span> -->
                                            <span style="font-family: 'Plus Jakarta Sans', sans-serif;">{{$quoteData->contractor->name??""}}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($quoteData->contractor->email))
                                    <div class="field-wrap mb-1">
                                        <div class="form-element">
                                            <!-- <span>infoemail@gmail.com</span> -->
                                            <span style="font-family: 'Plus Jakarta Sans', sans-serif;">{{$quoteData->contractor->email??""}}</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    @if(isset($quoteData->id))

                                    <div class="field-wrap mb-1">
                                        <div class="form-element duedate-inputs d-flex align-items-center" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                                            <label for="quotationno" class="form-label" style="font-family: 'Plus Jakarta Sans', sans-serif;">Quotation No:</label> {{$quoteData->id??''}}
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset($quoteData->due_date))
                                    <div class="field-wrap mb-1">
                                        <div class="form-element duedate-inputs d-flex align-items-center" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                                            <label for="duedate" class="form-label" style="font-family: 'Plus Jakarta Sans', sans-serif;">Due date:</label>
                                            {{ \Carbon\Carbon::parse($quoteData->due_date??'')->format('m /d /Y') }}

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
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="field-wrap mb-1" >
                                        <div class="form-element d-flex align-items-center">
                                            <!-- Richard M.Rollins -->
                                            {{$userDetails->name??''}}
                                        </div>
                                    </div>
                                    <div class="field-wrap mb-1">
                                        <div class="form-element d-flex align-items-center justify-content-between">
                                            <!-- 1553 Woodhill Avenue Baltimore, MD 21202 -->
                                            {{$userDetails->address??''}}
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
                                                    <th width="15%" style="background-color:#E0E0E0;font-family: 'Plus Jakarta Sans', sans-serif;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($quotationitem as $item)   
                                                    <tr>
                                                        <td>{{$item->description??''}}</td>
                                                        <td class="qtywrap">{{$item->quantity}}</td>
                                                        <td class="unitprice">${{$item->unit_price}}</td>
                                                        @php
                                                            $unittotal = $item->quantity * $item->unit_price;

                                                      @endphp
                                                        <td class="unittotal">                                                   
                                                            ${{ number_format($unittotal, 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:16px;">
                                <div class="col-6" style="vertical-align: top;">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="address">Message to customer<span>*</span></label>
                                        </div>
                                        <div class="form-element">
                                            {{$quoteData->message??''}}
                                            <!-- High Profile Ridge Cap Add a beautiful aesthetic to your Home by accepting the ridge line -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
                                        <div class="subtotal-title">Quote Subtotal:</div>
                                        <!-- <div class="subtotal-detail">$13,671.15</div> -->
                                        <div class="subtotal-detail">${{$quoteData->final_price??''}}</div>
                                    </div>
                                    <div class="total-title-wrap d-flex align-items-center justify-content-end">
                                        <div class="subtotal-title">Total:</div>
                                        <!-- <div class="subtotal-detail">$13,671.15</div> -->
                                        <div class="subtotal-detail" style="font-size: 24px;font-weight: 800;">${{$quoteData->final_price??''}}</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-break"></div>

    <section class="quotation-sec" style="height: 1120px;background-repeat: no-repeat;background-position: bottom right;background-image:url(data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/pdf-bg.png'))); ?>);">
        <div class="container-fluid" style="border-bottom: 4px solid #53B746; padding: 30px 50px;">
            <div class="row">
                <div class="col-12">
                    <div class="quotation-form-wrap">
                        <div class="row">
                            <div class="col-12">
                                @if (file_exists (public_path ($quoteData->contractor->company_logo)))
                            <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/'.$quoteData->contractor->company_logo))); ?>"  width="120">
                            {{-- onerror="this.onerror=null;callfundata(this);" --}}
                            @else
                            <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/logo.png'))); ?>"  width="220">
                            @endif
                                {{--<img   src="data:image/svg+xml;base64,<?php //echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/logo.png'))); ?>"  width="220">--}}
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
                        <form id="quotation-form" style="">
                            <div class="row">
                                <div class="col-12">
                                    <div class="billto-title" style="font-size:26px;">We understand the importance of your home to you.</div>
                                </div>
                                <div class="col-12">
                                    <div class="field-wrap mb-1">
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">Hi {{$userDetails->name??''}},</div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type. It has survived not only five centuries.</div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">The following examples is for:</div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">
                                            <ol style="margin:0">
                                                <li>   It was popularized in the 1960s with the release of Letterset sheets containing</li>
                                                <li>   Lorem Ipsum passages, and more recently with desktop</li>
                                                <li>   Many desktop publishing packages and web page editors now</li>
                                                <li>   Various versions have evolved over the years</li>
                                            </ol>
                                        </div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type. It has survived not only five centuries.</div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type. It has survived.</div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type  versions have evolved over the years.</div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">Kind Regards,</div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">{{$quoteData->contractor->name??""}}   |    {{$quoteData->contractor->company_name??""}}  <br><a href="mailto:info@roofing.com" style="text-decoration: none;">{{$quoteData->contractor->email??""}}</a> <br><a style="text-decoration: none;" href="tel:4108468072">{{$quoteData->contractor->contact_number??""}}</a></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-break"></div>

    <section class="quotation-sec" style="height: 1120px;background-repeat: no-repeat;background-position: bottom right;background-image:url(data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/pdf-bg.png'))); ?>);">
        <div class="container-fluid" style="border-bottom: 4px solid #53B746; padding: 30px 50px;">
            <div class="row">
                <div class="col-12">
                    <div class="quotation-form-wrap">
                        <div class="row">
                            <div class="col-12">
                                {{--<img   src="data:image/svg+xml;base64,<?php //echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/logo.png'))); ?>"  width="220">--}}
                                @if (file_exists (public_path ($quoteData->contractor->company_logo)))
                            <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/'.$quoteData->contractor->company_logo))); ?>"  width="120">
                            {{-- onerror="this.onerror=null;callfundata(this);" --}}
                            @else
                            <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/logo.png'))); ?>"  width="220">
                            @endif
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
                        <form id="quotation-form" style="">
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <img   src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/thankyou.png'))); ?>"  width="91" height="85">
                                </div>
                                <div class="col-12">
                                    <div class="field-wrap mb-1" style="text-align:center;">
                                        <div class="form-element" style="font-size:36px; font-weight: 700; color:#777777; padding-top:10px;font-family: 'Plus Jakarta Sans', sans-serif;">Thank <span style="color: #4eac44;">you!</span></div>
                                        <div class="form-element" style="font-size:16px; color:#777777; padding-top:20px;font-family: 'Plus Jakarta Sans', sans-serif;">Thank you for downloading our quotation PDF. We appreciate your interest. <br>If you have any questions or need further assistance, feel free to <a href="{{route('contact-us')}}">contact us</a>.</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </body>
</html>
