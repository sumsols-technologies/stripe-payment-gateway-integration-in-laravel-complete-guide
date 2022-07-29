<?php

namespace App\Http\Controllers;
use Stripe\Charge;
use Stripe\Stripe;

use Illuminate\Http\Request;

class FrontendCheckoutController extends Controller
{
    public function stripeorder(Request $request)
{    
    if(isset($_POST['stipe_payment_btn']))
    {
        $stripetoken = $request->input('stripeToken');
        $STRIPE_SECRET = "sk_test_51LItE7CaxjdrnkwIvju5yegTqkfQg2W59iiK6TXe9UA5XWgn5nmQyf3dZQtwHcNlait0UkSskUHOPb4GSRBs19q300nikaAcW1";
        Stripe::setApiKey($STRIPE_SECRET);
        \Stripe\Charge::create([
            'amount' => 30 * 100,
            'currency' => 'usd',
            'description' => "Thank you for purchasing with Fabcart",
            'source' => $stripetoken,
            'shipping' => [
                'name' => "User Name",
                'phone' => "+1XXXXXXX",
                'address' => [
                    'line1' => "Address 1",
                    'line2' => "Address 2",
                    'postal_code' => "Zipcode",
                    'city' => "City",
                    'state' => "State",
                    'country' => 'US',
                ],
            ],
        ]);
        return redirect('/')->with('status','Order has been placed Successfully');
    }
}
}
