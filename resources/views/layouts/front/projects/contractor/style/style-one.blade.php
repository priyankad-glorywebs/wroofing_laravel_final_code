<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Quotation</title>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .quotation-form-wrap.logo-wrap img {
            width: auto;
            height: auto;
            max-height: 270px;
            max-width: 520px;
        }

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
            width: 100%;

        }

        .row>div.col-6 {
            display: inline-block;
            width: 49%;
        }

        .row>div.col-12 {
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

        .mb-1 {
            margin-bottom: .25rem !important;
        }

        table {
            margin-bottom: 16px;
        }

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
            border-bottom: 1px solid #dee2e6;
        }

        .total-title-wrap,
        .subtotal-title-wrap {
            display: table;
            width: 300px;
        }

        .total-title-wrap>div,
        .subtotal-title-wrap>div {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
            padding-left: 20px;
            padding-right: 20px;
        }

        .total-title-wrap>div:last-child {
            text-align: right;
        }

        .subtotal-title-wrap>div:last-child {
            text-align: right;
        }

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

        .quotation-form-wrap h2,
        .quotation-form-wrap h3,
        .quotation-form-wrap h4 {
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
    </style>
</head>

<body>
    @php
        $primary_color = '#53B746';
        if(isset($contractors->primary_color)){
            $primary_color = $contractors->primary_color;
        }
    @endphp
    <section class="quotation-sec">
        <div class="container-fluid" style="border-bottom: 4px solid {{$primary_color}}; padding: 30px 50px;">
            <div class="row">
                <div class="col-12">
                    <div class="quotation-form-wrap logo-wrap">
                        <div class="row">
                            <div class="col-12">
                                <h1>Demo PDF Style - 1</h1>
                                <div class="quotation-form-wrap logo-wrap">
                                    <div class="row">
                                        <div class="col-12">
                                            @if ($contractors->company_logo != '' && file_exists (public_path ($contractors->company_logo)) && isset($contractors->company_logo))
                                                <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/'.$contractors->company_logo))); ?>"  width="320px" height="200px">
                                            @else
                                                <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/frontend-assets/images/logo.png'))); ?>" width="320px" height="200px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>

</html>
