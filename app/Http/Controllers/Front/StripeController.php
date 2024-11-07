<?php

namespace App\Http\Controllers\Front;

use Stripe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Services\StripeService;
use Mail;
use App\Models\Quotation;
use App\Models\Contractor;
use App\Models\Project;

class StripeController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }
    /**
     * Summary of stripequotePost
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     * LOGIN CUSTOMER
     */
    public function stripequotePost(Request $request)
    {
        try {
            $user = Auth::user(); // Gets the authenticated user
            $userId = Auth::id();
            $custName = $user->name;
            $custEmail = $user->email;
            if (isset($request->quote_id) && isset($request->project_id) && isset($request->quote_total)) {
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
                $quote_id       = (int) $request->quote_id ? $request->quote_id : "";
                $quote_total    = (int) $request->quote_total ? $request->quote_total : 0;
                $method         = $this->createPaymentMethod($request);
                $payment_intent = $this->createPaymentIntent($method->id, $quote_id, $quote_total, $custName, $custEmail, $request);
                
                if (isset($payment_intent) && $payment_intent->status == 'succeeded') {
                    $transaction = $this->saveTransaction($userId, $quote_id, $quote_total, $request->project_id, $payment_intent->id);
                    if (is_object($transaction)) { // Ensure it's an object
                        $transactionId = $transaction->id; // Access the ID
                        $this->sendPaymentReceiptEmails($userId, $quote_id, $request->project_id, $quote_total, $custEmail, $transactionId);
                    } else {
                        // Handle the failure case, like logging an error or returning a failure response
                        return response()->json(['success' => false, 'message' => 'Failed to save the transaction.'], 500);
                    }
                    return $this->paymentSuccessResponse($quote_id);
                }else{
                    return response()->json(['success' => false, 'message' => 'Payment fail please try again !!']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Something is wrong']);
            }
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()]);
        }
    }
    /**
     * Summary of publicstripePay
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     * LOGIN CUSTOMER
     */
    public function publicstripePay(Request $request)
    {
        try {
            $user = User::where('id', (int)$request->customer_id)->first(); // Gets the authenticated user
            $userId          = $user->id;
            $custName        = $user->name;
            $custEmail       = $user->email;
            if(isset($request->quote_id) && isset($request->project_id) && isset($request->quote_total)){
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
                $quote_id       = (int)$request->quote_id ? $request->quote_id : "";
                $quote_total    = (int)$request->quote_total ? $request->quote_total : 0;
                $method         = $this->createPaymentMethod($request);
                $payment_intent = $this->createPaymentIntent($method->id, $quote_id, $quote_total, $custName, $custEmail, $request);
                
                if (isset($payment_intent) && $payment_intent->status == 'succeeded') {
                    $transaction = $this->saveTransaction($userId, $quote_id, $quote_total, $request->project_id, $payment_intent->id);
                    if (is_object($transaction)) { // Ensure it's an object
                        $transactionId = $transaction->id; // Access the ID
                        $this->sendPaymentReceiptEmails($userId, $quote_id, $request->project_id, $quote_total, $custEmail, $transactionId);
                    } else {
                        // Handle the failure case, like logging an error or returning a failure response
                        return response()->json(['success' => false, 'message' => 'Failed to save the transaction.'], 500);
                    }
                    return response()->json(['success' => true, 'message' => 'Thank you for your payment! Your proposal is now confirmed.']);
                }else{
                    return response()->json(['success' => false, 'message' => 'Payment fail please try again !!']);
                }
            }else{
                    return response()->json(['success' => false, 'message' => 'Something is wrong']);
            } 
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()]);
        }
    }
    /* 23-10-2024 */
    
    /**
     * Summary of createPaymentMethod
     * @param mixed $request
     * @return Stripe\PaymentMethod
     */
    private function createPaymentMethod($request)
    {   
        $splitExpiration = preg_split('#/#', $request->expiration);
        $month           = isset($splitExpiration) && !empty($splitExpiration) ? $splitExpiration[0] : '';
        $year            = isset($splitExpiration) && !empty($splitExpiration) ? $splitExpiration[1] : '';

        return \Stripe\PaymentMethod::create([
            'type' => 'card',
            'card' => [
                'number'    => $request->cardnumber,
                'exp_month' => (int)$month,
                'exp_year'  => (int)$year,
                'cvc'       => $request->cvv,
            ],
        ]);
    }

    /**
     * Summary of createPaymentIntent
     * @param mixed $paymentMethodId
     * @param mixed $quote_id
     * @param mixed $quote_total
     * @param mixed $custName
     * @param mixed $custEmail
     * @param mixed $request
     * @return Stripe\PaymentIntent
     */
    private function createPaymentIntent($paymentMethodId, $quote_id, $quote_total, $custName, $custEmail, $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        return \Stripe\PaymentIntent::create([
            'payment_method' => $paymentMethodId,
            'amount' => $quote_total * 100,
            'currency' => 'usd',
            'description' => 'Quotation no ' . $quote_id . ' pay',
            'metadata' => [
                'Customer Name' => $custName,
                'Email' => $custEmail,
            ],
            'statement_descriptor' => $request->nameoncard ?? 'No card name added',
            'confirm' => true,
            'automatic_payment_methods' => ['enabled' => true,  'allow_redirects' => 'never'],
        ]);
    }
    /**
     * Summary of saveTransaction
     * @param mixed $userId
     * @param mixed $quote_id
     * @param mixed $quote_total
     * @param mixed $project_id
     * @param mixed $transaction_number
     * @return bool
     */
    private function saveTransaction($userId, $quote_id, $quote_total, $project_id, $transaction_number)
    {
        $transaction = new Transaction();
        $transaction->fill([
            'customer_id'        => $userId,
            'quote_id'           => $quote_id,
            'project_id'         => $project_id,
            'amount'             => $quote_total,
            'discount'           => 0,
            'total'              => $quote_total,
            'transaction_number' => $transaction_number,
            'payment_status'     => 'Completed',
        ]);
        
        $this->stripeService->updateStatus($quote_id, 'approved');
        $quotation                  = Quotation::find($quote_id);
        $transaction->contractor_id = $quotation->contractor_id;

        if ($transaction->save()) {
            return $transaction; // Return the saved transaction object
        }
        return false; // Return false or null on failure
    }

    /**
     * Summary of sendPaymentReceiptEmails
     * @param mixed $userId
     * @param mixed $quote_id
     * @param mixed $project_id
     * @param mixed $quote_total
     * @param mixed $custEmail
     * @param mixed $transactionId
     * @return void
     */
    private function sendPaymentReceiptEmails($userId, $quote_id, $project_id, $quote_total, $custEmail, $transactionId)
    {
        $quotation  = Quotation::find($quote_id);
        $contractor = Contractor::find($quotation->contractor_id);
        $project    = Project::find($project_id);

        $paymentData = [
            'customer_name'     => $project->customer_name,
            'customer_email'    => $custEmail,
            'contractor_name'   => $contractor->name,
            'project_name'      => $project->title,
            'amount'            => $quote_total,
            'payment_method'    => 'Cards',
            'discount'          => 0,
            'total'             => $quote_total,
            'transaction_date'  => now()->format('Y-m-d H:i:s'),
            'transaction_id'    => $transactionId,
        ];

        Mail::send('emails.payment_receipt_cust', ['paymentData' => $paymentData], function ($message) use ($custEmail) {
            $message->to($custEmail)
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                ->subject('Payment Confirmation for Your Roofing Project');
        });

        Mail::send('emails.payment_receipt_cont', ['paymentData' => $paymentData], function ($message) use ($contractor, $project) {
            $message->to($contractor->email)
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                ->subject('Payment Received for ' . $project->title);
        });
    }
    /**
     * Summary of paymentSuccessResponse
     * @param mixed $quote_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    private function paymentSuccessResponse($quote_id)
    {
        $paymentResponse = [
            'redirectURL' => route('view.quote', ['quote_id' => base64_encode($quote_id)]),
        ];
        return response()->json(['success' => true, 'data' => $paymentResponse, 'message' => 'Payment successful']);
    }
}
