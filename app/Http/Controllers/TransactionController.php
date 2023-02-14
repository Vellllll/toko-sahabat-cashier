<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\CheckOut;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Payment;

class TransactionController extends Controller
{
    public function transactionsHistoryPage(){
        $transactions = Transaction::orderBy('id', 'desc')->get();

        return view('transactions.transactions_history')->with([
            'transactions' => $transactions
        ]);
    }

    public function addTransactionPage(){
        $stock = Item::orderBy('id', 'desc')->get();

        $transaction_number = 'TRSK0000-00-00';
        $checkouts = CheckOut::where('transaction_number', '=', $transaction_number)->get();

        $transaction = Transaction::all();
        $latest_transaction = Transaction::orderBy('id', 'desc')->first();

        $customers = Customer::all();

        $date = date('Y-m-d');

        return view('transactions.add_transaction')->with([
            'stock' => $stock,
            'checkouts' => $checkouts,
            'transaction' => $transaction,
            'latest_transaction' => $latest_transaction,
            'date' => $date,
            'customers' => $customers
        ]);
    }

    public function addTransactionItem(Request $request){
        $item_id = $request->id;

        $request->validate([
            'item_count' => 'required|min:1'
        ],[
            'item_count.required' => 'Item count must more than 0!'
        ]);

        $item_count = $request->item_count;

        $stock = Item::findOrFail($item_id);

        $stock_left = $stock->stock_left;
        $stock_left_updated = $stock_left - $item_count;

        $total_price = $item_count * $stock->price;

        $item_sold = $stock->stock_sold + $item_count;

        $stock->update([
            'stock_left' => $stock_left_updated,
            'stock_sold' => $item_sold,
        ]);

        $transaction_number = 'TRSK0000-00-00';

        CheckOut::insert([
            'item_id' => $item_id,
            'transaction_number' => $transaction_number,
            'item_name' => $stock->item_name,
            'count' => $item_count,
            'unit_id' => $stock->unit_id,
            'price' => $stock->price,
            'total_price' => $total_price
        ]);

        $checkout = CheckOut::all();



        return redirect()->back()->with([
            'stock' => $stock,
            'checkout' => $checkout
        ]);
    }

    public function deleteTransactionItem($id){
        $checkout = CheckOut::find($id);
        $count = $checkout->count;
        $item_id = $checkout->item_id;

        $checkout->delete();

        $stock = Item::find($item_id);
        $stock_count_updated = $stock->stock_left + $count;

        $item_sold = $stock->stock_sold - $count;

        $stock->update([
            'stock_left' => $stock_count_updated,
            'stock_sold' => $item_sold
        ]);

        return redirect()->back()->with([
            'stock' => $stock,
            'checkout' => $checkout
        ]);


    }

    public function makeTransaction(Request $request){
        if($request->checkout_id == null){
            $notification = array(
                'message' => 'There is no check out!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $request->validate([
                'customer_name' => 'required',
                'payment' => 'required',
                'shipping_cost' => 'required'
            ],[
                'customer_name.required' => 'Customer name is required!',
                'payment.required' => 'Payment method is required!',
                'shipping_cost.required' => 'Shipping cost is required!'
            ]);

            $transaction_number = 'TRSK0000-00-00';
            $transaction_number_fix = 'TRSK' . $request->transaction_date . $request->transaction_number;



            if($request->customer_name == '0'){
                $request->validate([
                    'new_customer' => 'required|unique:customers,customer_name',
                ],[
                    'new_customer.required' => 'Please input the new customer!',
                    'new_customer.unique' => 'Customer has already added!'
                ]);

                Customer::insert([
                    'customer_name' => $request->new_customer,
                    'created_at' => Carbon::now()
                ]);

                Transaction::insert([
                    'transaction_number' => $transaction_number_fix,
                    'transaction_date' => $request->transaction_date,
                    'customer_name' => $request->new_customer,
                    'total_price' => $request->total_price,
                    'payment_method' => $request->payment,
                    'shipping_costs' => $request->shipping_cost,
                    'shipper' => $request->shipper,
                    'status' => '0',
                ]);
            } else {
                Transaction::insert([
                    'transaction_number' => $transaction_number_fix,
                    'transaction_date' => $request->transaction_date,
                    'customer_name' => $request->customer_name,
                    'total_price' => $request->total_price,
                    'payment_method' => $request->payment,
                    'shipping_costs' => $request->shipping_cost,
                    'shipper' => $request->shipper,
                    'status' => '0',
                ]);


            }

            CheckOut::where('transaction_number', '=', $transaction_number)->update([
                'transaction_number' => $transaction_number_fix
            ]);

            $notification = array(
                'message' => 'Transaction inputted!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }


    }

    public function editTransactionPage($id){
        $transaction = Transaction::findOrFail($id);
        $checkouts = CheckOut::where('transaction_number', $transaction->transaction_number)->get();
        $payments = Payment::all();
        $customers = Customer::all();
        $stock = Item::orderBy('id', 'desc')->get();

        return view('transactions.edit_transaction')->with([
            'transaction' => $transaction,
            'checkouts' => $checkouts,
            'payments' => $payments,
            'customers' => $customers,
            'stock' => $stock
        ]);

    }

    public function editTransaction(Request $request, $id){
        $transaction = Transaction::find($id);

        if($request->customer_name == '0'){
            $transaction->update([
                'shipping_costs' => $request->shipping_cost,
                'payment_method' => $request->payment,
                'customer_name' => $request->new_customer,
                'transaction_date' => $request->transaction_date,
                'total_price' => $request->total_price,
            ]);
        } else {
            $transaction->update([
                'shipping_costs' => $request->shipping_cost,
                'payment_method' => $request->payment,
                'customer_name' => $request->customer_name,
                'transaction_date' => $request->transaction_date,
                'total_price' => $request->total_price,
            ]);
        }

        $notification = array(
            'message' => 'Transaction updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('approval.transaction.page')->with($notification);

    }

    public function updateTransactionItem(Request $request, $id){

        $request->validate([
            'item_count' => 'required|min:1'
        ],[
            'item_count.required' => 'Item count must more than 0!'
        ]);

        $item_count = $request->item_count;

        $stock = Item::findOrFail($id);

        $stock_left = $stock->stock_left;
        $stock_left_updated = $stock_left - $item_count;

        $total_price = $item_count * $stock->price;

        $item_sold = $stock->stock_sold + $item_count;

        $stock->update([
            'stock_left' => $stock_left_updated,
            'stock_sold' => $item_sold,
        ]);



        $transaction_number = $request->item_transaction_number;

        CheckOut::insert([
            'item_id' => $id,
            'transaction_number' => $transaction_number,
            'item_name' => $stock->item_name,
            'count' => $item_count,
            'unit_id' => $stock->unit_id,
            'price' => $stock->price,
            'total_price' => $total_price
        ]);

        $checkout = CheckOut::all();



        return redirect()->back()->with([
            'stock' => $stock,
            'checkout' => $checkout
        ]);
    }

    public function deleteTransaction($id){
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        $notification = array(
            'message' => 'Transaction deleted!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function transactionDetails($transaction_number){
        $transaction = Transaction::findOrFail($transaction_number);
        $checkouts = CheckOut::where('transaction_number', $transaction_number)->get();

        return view('transactions.transaction_details')->with([
            'transaction' => $transaction,
            'checkouts' => $checkouts
        ]);
    }

    public function approvalTransactionPage(){
        $pending_transactions = Transaction::where('status', '0')->orderBy('id', 'desc')->get();
        return view('transactions.transaction_approval')->with([
            'pending_transactions' => $pending_transactions
        ]);
    }

    public function approveTransaction($id){
        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'status' => '1',
        ]);

        $notification = array(
            'message' => 'Transaction approved!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function transactionDataPage($id){
        $transaction = Transaction::with('items')->findOrFail($id);
        $checkouts = CheckOut::where('transaction_number', $transaction->transaction_number);

        return view('transactions.transaction_data')->with([
            'transaction' => $transaction,
            'checkouts' => $checkouts
        ]);
    }

}
