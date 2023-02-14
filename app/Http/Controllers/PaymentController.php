<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function paymentListPage(){
        $payments = Payment::orderBy('id', 'desc')->get();
        return view('payment.payment_list')->with([
            'payments' => $payments,
        ]);
    }

    public function addPaymentPage(){
        return view('payment.add_payment');
    }

    public function addPayment(Request $request){
        Payment::insert([
            'payment_method' => $request->payment_method,
        ]);

        $notification = array(
            'message' => 'Payment Added!',
            'alert-type' => 'success',
        );

        return redirect()->route('payment.list.page')->with($notification);
    }

    public function editPaymentPage($id){
        $payment = Payment::findOrFail($id);
        return view('payment.edit_payment')->with([
            'payment' => $payment,
        ]);
    }

    public function editPayment(Request $request, $id){
        $payment = Payment::find($id);
        $payment->update([
            'payment_method' => $request->payment_method,
        ]);

        $notification = array(
            'message' => 'Payment Updated!',
            'alert-type' => 'success',
        );

        return redirect()->route('payment.list.page')->with($notification);
    }

    public function deletePayment($id){
        $payment = Payment::findOrFail($id);
        $payment->delete();

        $notification = array(
            'message' => 'Payment Deleted!',
            'alert-type' => 'success',
        );

        return redirect()->route('payment.list.page')->with($notification);
    }

}
