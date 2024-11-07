@extends('layouts.front.master')
@section('title', 'Complete Payment for Quotation - Fast & Secure Payment')
@section('css')
    <style>
        .billto-title,.card-info-box .form-group,.table-responsive{margin-bottom:20px}.breadcrumb a{color:#007bff;font-weight:500;text-decoration:none}.total-detail{font-size:24px;font-weight:800;color:#0a84ff}.total-title{font-weight:500;margin-right:20px}.quotation-form-wrap{background-color:#fff;border:1px solid #e0e0e0;box-shadow:0 4px 8px rgba(0,0,0,.1);padding:30px;border-radius:10px}.quotation-table td,.quotation-table th{padding:10px 15px;font-size:15px;color:#333}.billto-title{font-size:20px;font-weight:600}.field-wrap .form-element{font-size:16px;font-weight:500}.table th{background-color:#f1f1f1;font-weight:600}.table td{font-size:14px}.subtotal-title-wrap,.total-title-wrap{margin-bottom:15px}.subtotal-detail,.subtotal-title{font-size:18px;font-weight:600;color:#333}.payment-box-wrap{position: relative;background-color:#f8f8f8;padding:20px;border:1px solid #ddd;border-radius:8px}.payment-title{font-size:18px;font-weight:600;color:#007bff;margin-left:10px}.card-info-box{margin-top:20px}.card-info-box .title{font-size:16px;font-weight:600;margin-bottom:15px}.form-control{height:45px;font-size:16px;border:1px solid #ddd;border-radius:5px;box-shadow:none;padding-left:15px}.form-control:focus{border-color:#007bff}.paynow-box button[type=submit]{background-color:#007bff;color:#fff;font-size:18px;font-weight:600;padding:12px 30px;border-radius:50px;border:none;transition:background-color .3s}.paynow-box button[type=submit]:hover{background-color:#0056b3}.error-message{margin-top:10px}.payment-error-message{margin-bottom: 20px;font-size:14px;color:#e74c3c}.quotation-sec .quotation-form-wrap input{max-width:100%}.quotation-sec hr{margin:30px 0}
        .col-7.pr-0.form-group.required { padding-right: 0px;} .col-5.pl-0.form-group.required {padding-left: 0px;}input#expiration {border-radius: none;}
        #paynowloading-bar-spinner.spinner{display:none;height:1em;width:1em;position:absolute;top:50%;left:50%;margin-left:-.5em;margin-top:-.5em;content:"";animation:1s ease-in-out infinite spin;background:url("{{ asset('frontend-assets/images/loader.svg') }}") center center/cover;line-height:1;text-align:center;font-size:2em;z-index:99999999}@-moz-keyframes spin{100%{-moz-transform:rotate(360deg)}}@-webkit-keyframes spin{100%{-webkit-transform:rotate(360deg)}}@keyframes spin{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}
    </style>
@endsection

@php 
$quoteData      = $quotationData['quoteData'];
$quotationitem  = $quotationData['quotationitem'];
$userDetails    = $quotationData['userDetails'];
$customer_id    = $quotationData['customer_id'];
@endphp

@section('content')
    <script>
        function callfundata(obj) {
            var noimg = '{{ asset('frontend-assets/images/logo.png') }}';
            obj.src = noimg;
        }
    </script>
    <div class="breadcrumb-title-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title mb-4">Review and Pay for Your Proposal</div>
                </div>
            </div>
        </div>
    </div>
    <section class="quotation-sec payment-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="quotation-form-wrap">
                        <div class="row">
                            <div class="col-md-6">
                                @if (file_exists(public_path($quoteData->contractor->company_logo)))
                                    <img src="{{ asset($quoteData->contractor->company_logo) }}"
                                         style="max-width:230px;max-height:57px;" onerror="this.onerror=null;callfundata(this);">
                                @else
                                    <img src="{{ asset('frontend-assets/images/logo.png') }}" width="220">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="quotation-table">
                                    <table>
                                        <tr>
                                            <th>Quotation No:</th>
                                            <td>{{ $quoteData->id ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contractor name:</th>
                                            <td>{{ $quoteData->contractor->name ?? '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="billto-title">Bill To:</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="field-wrap mb-1">
                                    <div class="form-element d-flex align-items-center">
                                        {{ $userDetails->name ?? '' }}
                                    </div>
                                </div>
                                <div class="field-wrap mb-1">
                                    <div class="form-element d-flex align-items-center justify-content-between">
                                        {{ $userDetails->address ?? '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="40%">Description</th>
                                                <th width="15%">Qty</th>
                                                <th width="15%">Unit Price</th>
                                                <th width="15%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quotationitem as $item)
                                                <tr>
                                                    <td>{{ $item->description ?? '' }}</td>
                                                    <td class="qtywrap">{{ $item->quantity }}</td>
                                                    <td class="unitprice">${{ $item->unit_price }}</td>
                                                    <td class="unittotal">${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="payment-box-wrap">
                                    <div id="paynowloading-bar-spinner" class="spinner"></div>
                                    <div class="paynow-box require-validation">
                                        <div class="title-wrap d-flex justify-content-center align-items-center mb-3">
                                            <img src="{{ asset('frontend-assets/images/right.png') }}" width="17" height="20" alt="">
                                            <div class="payment-title">Pay with Credit or Debit Card:</div>
                                        </div>
                                        <div class="card-info-box">
                                            <div class="title">Card Information:</div>
                                            <div class="row">
                                                <div class="col-12 form-group required">
                                                    <input type="text" class="form-control card-num" id="cardNumber" name="cardNumber" placeholder="1234 1234 1234 1234">
                                                </div>
                                                <div class="col-7 pr-0 form-group required">
                                                    <input type="text" class="form-control expiry" id="expiration" name="expiration" placeholder="MM / YYYY">
                                                </div>
                                                <div class="col-5 pl-0 form-group required">
                                                    <input type="text" class="form-control card-cvc cvc" id="cvv" name="cvv" placeholder="CVV" maxlength="4">
                                                </div>
                                                <div class="col-12 form-group required">
                                                    <input type="text" class="form-control card-name" id="nameoncard" name="nameoncard" placeholder="Cardholder Name" maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="error-message d-none">
                                            <div id="stripe-error-msg" class="payment-error-message text-danger">Your card details are incorrect. Please try again.</div>
                                        </div>
                                        <div class="paynow-box">
                                            <button class="btn" type="submit">Pay Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="total-price-wrap">
                                    <div class="subtotal-title-wrap d-flex justify-content-between align-items-center">
                                        <div class="subtotal-title">Subtotal:</div>
                                        <div class="subtotal-detail">${{ $quoteData->final_price ?? '' }}</div>
                                    </div>
                                    <div class="total-title-wrap d-flex justify-content-between align-items-center">
                                        <div class="total-title">Total:</div>
                                        <div class="total-detail">${{ $quoteData->final_price ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js?v={{ now()->format('Y-m-d H:i:s') }}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/additional-methods.js?v={{ now()->format('Y-m-d H:i:s') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.3.2/jquery.payment.min.js?v={{ now()->format('Y-m-d H:i:s') }}"></script>

    <script>
        jQuery(window).bind("pageshow", function($) {
            jQuery('#cardNumber').val('');
            jQuery('#expiration').val('');
            jQuery('#cvv').val('');
            jQuery('#nameoncard').val('');
        });
    </script>
    <!-- START PAYMENT MODULE -->
    <script type="text/javascript">
        /**
         * paymentForm
         *
         * A plugin that validates a group of payment fields.  See jquery.payment.js
         * Adapted from https://gist.github.com/Air-Craft/1300890
         */
  
        // if (!window.L) { window.L = function () { console.log(arguments);} } // optional EZ quick logging for debugging
  
        (function ($) {
          /**
           * The plugin namespace, ie for $('.selector').paymentForm(options)
           *
           * Also the id for storing the object state via $('.selector').data()
           */
          var PLUGIN_NS = 'paymentForm';
  
          var Plugin = function (target, options) {
            this.$T = $(target);
            this._init(target, options);
  
            /** #### OPTIONS #### */
            this.options = $.extend(
              true,               // deep extend
              {
                DEBUG: false
              },
              options
            );
  
            return this;
          }
  
          /** #### INITIALISER #### */
          Plugin.prototype._init = function (target, options) {
            var base = this;
  
            base.number = this.$T.find("[name='cardNumber']");
            base.exp = this.$T.find("[name='expiration']");
            base.cvc = this.$T.find("[name='cvv']");
  
            // Set up all payment fields inside the payment form
            base.number.payment('formatCardNumber').data('payment-error-message', 'Please enter a valid credit card number.');
            base.exp.payment('formatCardExpiry').data('payment-error-message', 'Please enter a valid expiration date.');
            base.cvc.payment('formatCardCVC').data('payment-error-message', 'Please enter a valid CVV.');
  
            // Update card type on input
            base.number.on('input', function () {
              base.cardType = $.payment.cardType(base.number.val());
              var fg = base.number.closest('.form-group');
              fg.toggleClass('has-feedback', true);
              fg.find('.form-control-feedback').remove();
            });
  
            // Validate card number on change
            base.number.on('change', function () {
              base._setValidationState($(this), !$.payment.validateCardNumber($(this).val()));
            });
  
            // Validate card expiry on change
            base.exp.on('change', function () {
              base._setValidationState($(this), !$.payment.validateCardExpiry($(this).payment('cardExpiryVal')));
            });
            // Validate card cvc on change
            base.cvc.on('change', function () {
              base._setValidationState($(this), !$.payment.validateCardCVC($(this).val(), base.cardType));
            });
          };
  
          /** #### PUBLIC API (see notes) #### */
          Plugin.prototype.valid = function () {
            var base = this;
  
            var num_valid = $.payment.validateCardNumber(base.number.val());
            var exp_valid = $.payment.validateCardExpiry(base.exp.payment('cardExpiryVal'));
            var cvc_valid = $.payment.validateCardCVC(base.cvc.val(), base.cardType);
  
            base._setValidationState(base.number, !num_valid);
            base._setValidationState(base.exp, !exp_valid);
            base._setValidationState(base.cvc, !cvc_valid);
  
            return num_valid && exp_valid && cvc_valid;
          }
          /** #### PRIVATE METHODS #### */
          Plugin.prototype._setValidationState = function (el, erred) {
            var fg = el.closest('.form-group');
            fg.toggleClass('has-error', erred).toggleClass('has-success', !erred);
            fg.find('.payment-error-message').remove();
            if (erred) {
              fg.append("<span class='text-danger payment-error-message'>" + el.data('payment-error-message') + "</span>");
            }
            return this;
          }
          /**
           * EZ Logging/Warning (technically private but saving an '_' is worth it imo)
           */
          Plugin.prototype.DLOG = function () {
            if (!this.DEBUG) return;
            for (var i in arguments) {
              console.log(PLUGIN_NS + ': ', arguments[i]);
            }
          }
          Plugin.prototype.DWARN = function () {
            this.DEBUG && console.warn(arguments);
          }
  
          /*###################################################################################
           * JQUERY HOOK
           ###################################################################################*/
  
          /**
           * Generic jQuery plugin instantiation method call logic
           *
           * Method options are stored via jQuery's data() method in the relevant element(s)
           * Notice, myActionMethod mustn't start with an underscore (_) as this is used to
           * indicate private methods on the PLUGIN class.
           */
          $.fn[PLUGIN_NS] = function (methodOrOptions) {
            if (!$(this).length) {
              return $(this);
            }
            var instance = $(this).data(PLUGIN_NS);
  
            // CASE: action method (public method on PLUGIN class)
            if (instance
              && methodOrOptions.indexOf('_') != 0
              && instance[methodOrOptions]
              && typeof (instance[methodOrOptions]) == 'function') {
  
              return instance[methodOrOptions](Array.prototype.slice.call(arguments, 1));
              // CASE: argument is options object or empty = initialise
            } else if (typeof methodOrOptions === 'object' || !methodOrOptions) {
  
              instance = new Plugin($(this), methodOrOptions);    // ok to overwrite if this is a re-init
              $(this).data(PLUGIN_NS, instance);
              return $(this);
  
              // CASE: method called before init
            } else if (!instance) {
              $.error('Plugin must be initialised before using method: ' + methodOrOptions);
  
              // CASE: invalid method
            } else if (methodOrOptions.indexOf('_') == 0) {
              $.error('Method ' + methodOrOptions + ' is private!');
            } else {
              $.error('Method ' + methodOrOptions + ' does not exist.');
            }
          };
        })(jQuery);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
          }
        });
        /* Initialize validation */
        var payment_form = $('.require-validation').paymentForm();
        $('.paynow-box button[type="submit"]').on('click', function () {
          jQuery('#stripe-error-msg').text('');
          var valid = $('.require-validation').paymentForm('valid');
          /* ************* Payment Details ***************************** */
          var nameoncard  = $('#nameoncard').val();
          var cardnumber  = $('#cardNumber').val();
          var expiration  = $('#expiration').val();
          var cvv         = $('#cvv').val();
          var mpprice     = $('#attendees-form input[name="mpprice"]').val();
          var fullname    = $('#attendees-form input[name="fullname"]').val();
          var email       = $('#attendees-form input[name="email"]').val();
            
          if (valid) {
            $('.paynow-box .paynow-box button').addClass('disabled');
            $('#paynowloading-bar-spinner').show();
            $('.paynow-box').css('opacity', '0.6');
            $('.paynow-box').css('pointer-events', 'none');
            
            $.ajax({
              url: "{{route('quote.stripe.pay')}}",
              type: 'POST',
              data: {
                "csrf_token"      : '{{csrf_token()}}',
                'nameoncard': nameoncard,
                'cardnumber': cardnumber,
                'expiration': expiration,
                'mpprice': mpprice,
                'email': email,
                'cvv': cvv,
                'stripe_acc_id': 'acct_1EpTmnFr7XHfZYnE',
                'quote_id': '{{$quoteData->id}}',
                'project_id': '{{$quoteData->project_id}}',
                'quote_total': '{{ $quoteData->final_price ?? '' }}',
                'customer_id': '{{ $customer_id ?? '' }}',
              },
              beforeSend: function () {
              },
              complete: function () {
            },
            success: function (response) {
                if (response.success == true) {
                        setTimeout(function() {
                            $('.paynow-box .paynow-box button').addClass('disabled');
                            $('#paynowloading-bar-spinner').hide();
                            $('.paynow-box').css('opacity', '1');
                            $('.paynow-box').css('pointer-events', 'all');
                        }, 1000); // 100 milliseconds delay, adjust as needed
                        console.log(response);
                        if(response.success == true){
                            jQuery('.error-message').removeClass('d-none');
                            jQuery('#stripe-error-msg').removeClass('text-danger').addClass('text-success').css('font-weight', '900');
                            jQuery('#stripe-error-msg').text(response.message);
                            $('.paynow-box .paynow-box button').addClass('disabled');

                            $('.require-validation').find('input[type="text"]').val(''); // Clears text-based inputs
                        }else {
                            jQuery('.error-message').removeClass('d-none');
                            jQuery('#stripe-error-msg').text(response.message);
                        }
                        if (response && response.success == false) {
                            jQuery('.error-message').removeClass('d-none');
                            jQuery('#stripe-error-msg').text(response.message);
                        }
                    } else {
                        jQuery('.error-message').removeClass('d-none');
                        jQuery('#stripe-error-msg').text(response.message);
                        $('.paynow-box .paynow-box button').removeClass('disabled');
                    }
                    if (response && response.success == false) {
                        jQuery('.error-message').removeClass('d-none');
                        jQuery('#stripe-error-msg').text(response.message);
                    } 
              },
              error: function (jqXHR, exception) {
                if(jqXHR.responseJSON.success == false){
                  setTimeout(function() {
                    jQuery(document).find('.paynow-box .paynow-box button').removeClass('disabled');
                  }, 900);
                  jQuery('#stripe-error-msg').text(jqXHR.responseJSON.message);
                }
              }
            });

          }
          /* ************* Payment Details ***************************** */
          // else
          //     alert('Badman Cardfaker');
        });
      </script>
      <script type="text/javascript">
          function disableBack() { window.history.forward(); }
          setTimeout("disableBack()", 0);
          window.onunload = function () { null };
      </script>
      <!-- END PAYMENT MODULE -->
@endsection
