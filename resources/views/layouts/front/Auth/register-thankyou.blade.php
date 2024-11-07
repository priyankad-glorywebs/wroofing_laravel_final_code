@extends('layouts.front.master')
@section('title', 'Home Page')
 
@section('content')
<section class="stepform-sec thank-you-sec">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="thank-you-wrap">
                    <img src="{{asset('frontend-assets/images/thankyou.png')}}" class="mb-2" alt="thank you" width="91" height="85">
                    <div class="section-title mb-3">Thank <span>you!</span></div>
                    <div class="section-subtitle text-center">You have registered successfully with 360 innovations. You will receive a confirmation notification shortly on your registered email address.</div>
                    @if($usertype === "customer")
                    <a href="{{route('login')}}" class="btn btn-sm btn-primary">Back</a>
                    @elseif($usertype === "contractor")
                    <a href="{{route('contractor.login')}}" class="btn btn-sm btn-primary">Back</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection