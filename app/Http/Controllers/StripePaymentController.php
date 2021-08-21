<?php
   
namespace App\Http\Controllers;
   
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Session;
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public static function stripePost($stripe_data)
    {   
        //dd($stripe_data['stripeToken']);
       
        Stripe::setApiKey(config('services')['stripe']['secret'] );

        $customer = Customer::create([
            'name' => $stripe_data['name'],
            'email' => $stripe_data['email'],
            'address' => [
                'line1' => '510 Townsend St',
                'postal_code' => '98140',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'US',
            ],
        ]);

        $source = Customer::createSource(
            $customer->id,
            ['source' => $stripe_data['stripeToken']]
        );
        $charge = Charge::create ([
            "customer" => $customer->id,
            "amount" => $stripe_data['price'] * 100,
            "currency" => "usd",
            "description" => "Course Booking Payment." , 
        ]);

        $payment = array($customer,$charge,$source);
        return($payment);
   
         
    }
}