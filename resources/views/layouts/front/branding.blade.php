@extends('layouts.front.master')
@section('title', 'Branding')
@section('content')
<style type="text/css">
    code {
        padding: 5px 8px;
        border-radius: 10px;
        background-color: #f8f9f9;
        color: #CC0066;
    }
    [type='color'] {
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        padding: 0;
        width: 15px;
        height: 15px;
        border: none;
    }
    [type='color']::-webkit-color-swatch-wrapper {
        padding: 0;
    }
    [type='color']::-webkit-color-swatch {
        border: none;
    }
    .color-picker {
        padding: 10px 15px;
        border-radius: 10px;
        border: 1px solid #ccc;
        background-color: #f8f9f9;
    }
    /* Reset some default form styles */
    form {
        max-width: 600px;
        /* Adjust as needed */
        margin: 0 auto;
        padding: 20px;
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        font-weight: bold;
    }
    .upload-img-wrap {
        position: relative;
        overflow: hidden;
        margin-top: 10px;
    }
    .color-picker {
        margin-top: 10px;
    }
    .color-picker input[type="color"] {
        vertical-align: middle;
    }
    .d-block {
        display: block;
    }
    .w-100 {
        width: 100%;
    }
    /* Center align elements */
    .center {
        text-align: center;
    }
</style>
    <div class="breadcrumb-title-wrap">
        <div class="container">
            <div class="row d-lg-none mt-4">
                <div class="col-12">
                    <div class="signin-notes">Home / Branding</div>
                </div>
            </div>
            <div class="row breadcrumb-title">
                <div class="col-12 col-lg-7">
                    <div class="section-title">Branding</div>
                    <p>Upload your logo and confirm your brand colours to create a stunning quote.<br>You can always change these later</p>
                </div>
            </div>
        </div>
    </div>
    @php
        $contractor = auth()->guard('contractor')->user();
    @endphp
    <section class="studio-stepform-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="studio-stepform-wrap">
                        <form id="updateprofile-contarctorform" action="{{ route('contractor.branding.add') }}"
                            method="post" enctype="multipart/form-data">
                            <input type="hidden" id="contarctorId" name="contarctorId"
                                value="{{ $contractor->id ?? '' }}" />
                            @csrf
                            <div class="form-group">
                                <label for="company_logo">Company logo</label>
                                <div class="upload-img-wrap">
                                    <input id="company_logo" type="file" name="company_logo"
                                        accept="image/jpg, image/jpeg, image/png">
                                    <label for="company_logo">
                                        <div class="upload-img-icon">
                                            <img src="{{ asset('frontend-assets/images/img-icon.svg') }}" alt="img-icon"
                                                width="30" height="30">
                                        </div>
                                        <div class="upload-img-text">
                                            @if (isset($contractor->company_logo) && $contractor->company_logo !== null && $contractor->company_logo !== '')
                                                {{ $contractor->company_logo }}
                                            @else
                                                Upload your Company Logo
                                            @endif
                                        </div>
                                        <div class="upload-img-formate">(PNG or JPEG file accepted)</div>
                                    </label>
                                </div>
                                @error('company_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label">Colors:</label>
                                <div class="color-picker">
                                    <label for="colorPicker">Primary:
                                        @if (isset($contractor->primary_color) && $contractor->primary_color !== null && $contractor->primary_color !== '')
                                        <input type="color" name="primary_color" value="{{$contractor->primary_color}}" id="colorPicker">
                                        @else
                                        <input type="color" name="primary_color" value="#1DB8CE" id="colorPicker">
                                        @endif
                                    </label>
                                </div>
                                @error('primary_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary d-block w-100">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        document.querySelectorAll('input[type=color]').forEach(function(picker) {
            var targetLabel = document.querySelector('label[for="' + picker.id + '"]'),
                codeArea = document.createElement('p');
            codeArea.innerHTML = picker.value;
            targetLabel.appendChild(codeArea);
            picker.addEventListener('change', function() {
                codeArea.innerHTML = picker.value;
                targetLabel.appendChild(codeArea);
                navigator.clipboard.writeText(picker.value);
                // alert("HEX code " + picker.value + " coppied!");
            });
        });
    </script>
@endsection