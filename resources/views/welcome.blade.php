<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link id="callCss" rel="stylesheet" href="{{asset('themes/bootshop/bootstrap.min.css')}}" media="screen" />
  <link href="{{asset('themes/css/base.css')}}" rel="stylesheet" media="screen" />
  <link href="{{asset('dist/card.css')}}" rel="stylesheet" media="screen" />
  <link href="{{asset('themes/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
  <!-- Google-code-prettify -->
  <link href="{{asset('themes/js/google-code-prettify/prettify.css')}}" rel="stylesheet" />
     <script src="{{asset('themes/js/jquery.js')}}" type="text/javascript"></script>
  <script src="{{asset('themes/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('themes/js/google-code-prettify/prettify.js')}}"></script>
  <script src="{{asset('themes/js/bootshop.js')}}"></script>
  <script src="{{asset('themes/js/jquery.lightbox-0.5.js')}}"></script>
  <script src="{{asset('dist/card.js')}}"></script>
</head>
<style>
    .modal-header .close {
    margin-top: -26px;
}
.modal-body {
    max-height: 550px;
    padding: 15px;
    overflow-y: auto;
}
.modal.fade.in {
    top: 40%;
}
</style>
<body>
    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#StripeCardModal">Stripe - Pay Online</button>
 <!-- Modal -->
     <div class="modal fade" id="StripeCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pay with Stripe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="demo-container">
                    <div class="card-wrapper" style="margin-bottom: 30px;"></div>
                    <form role="form" action="{{ url('place-order-with-stripe') }}" method="POST"
                        class="require-validation" data-cc-on-file="false" id="payment-form">

                        {{ csrf_field() }}

                        <div class="row" style="margin-left: 0px;">
                            <div class="col-md-12">
                                <div><p class="stripe-error py-3 text-danger"></p></div>
                            </div>
                            <div class="col-md-12 required" style="margin-top: 10px;">
                                <div class="form-group">
                                    <label style="margin-top: 8px;     font-size: 16px;" class="control-label">Card Number</label>
                                    <input style="width: 96%;height: 24px;" type="text" autocomplete='off' class="form-control card-number" required size="20" name="number">
                                </div>
                            </div>

                            <div class="col-md-12 required">
                                <div class="form-group">
                                    <label style="margin-top: 8px;     font-size: 16px;" class="control-label">Name on Card</label>
                                    <input style="width: 96%;height: 24px;" type="text" class="form-control" required size="4" name="name">
                                </div>
                            </div>
<div class="for-setting" style="display: flex;">
                            <div class="col-md-4 required" style="width: 33%">
                                <div class="form-group">
                                    <label style="margin-top: 8px;     font-size: 16px;" class='control-label'>CVC</label>
                                    <input  type="text" autocomplete="off" class="form-control card-cvc" required placeholder="ex. 311" size="4" name="cvc" style="width: 73%; height: 24px">
                                </div>
                            </div>
                            <div class="col-md-4" style="width: 33%">
                                <div class="form-group">
                                    <label style="margin-top: 8px;     font-size: 16px;" class="control-label">Expiration Month</label>
                                    <input  type="text" class="form-control card-expiry-month" required placeholder="MM" size="2" name="expiry" style="width: 73%; height: 24px">
                                </div>
                            </div>
                            <div class="col-md-4" style="width: 33%">
                                <div class="form-group">
                                    <label style="margin-top: 8px;     font-size: 16px;" class='control-label'>Expiration Year</label>
                                    <input type="text" class="form-control card-expiry-year" required placeholder="YYYY" size="4" style="width: 73%; height: 24px">
                                </div>
                            </div>
</div>
                        </div>

                        <div class="row" style="margin-left: 0px;">
                            <div class="col-md-12">
                                <hr>
                                <input style="width: 96%;height: 24px;" type="hidden" name="stipe_payment_btn" value="1">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Pay Now with Stripe</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]',
                            'input[type=password]',
                            'input[type=text]',
                            'input[type=file]',
                            'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('.inp-error'),
            valid         = true;
            $errorMessage.addClass('d-none');
        $('.has-error').removeClass('has-error');

        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('d-none');
                e.preventDefault();
            }
        });

        if (!$form.data('cc-on-file')) {
            var StripeKey = "pk_test_51LItE7CaxjdrnkwIOOe67wEF4zfcsB3XSfukwWJ75PQp4j4hN5ui4hZc33Sf0wzgUpDmkX5yTjFi5p7gZPqJYfQ100ZdY2uSgd";

            e.preventDefault();
            Stripe.setPublishableKey(StripeKey);
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }

    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.stripe-error').text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
<script>
        var c = new Card({
            form: document.querySelector('form'),
            container: '.card-wrapper'
        });
    </script>
</body>
</html>