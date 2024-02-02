<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    


    public function index()
    {
        $transactions = Transaction::all();
        return TransactionResource::collection($transactions);
    }

    public function show($id)
    {
        $transactions = Transaction::findOrFail($id);
        return new TransactionResource($transactions);
    }

    public function updateStatus(Request $request, $id)
     {
        //ADMIN
        $isAdmin = Auth::user()->isAdmin;

        $user_id = Auth::user()->id;
        $transaction_user_id = Transaction::where('id', $id)->value('user_id');

        if ($transaction_user_id != $user_id && !$isAdmin) {
            return response()->json(['error' => 'Unauthorized: User ID does not match'], 403);
        }
        
         $request->validate([
             'status' => 'required'
         ]);

         $transaction = Transaction::findOrFail($id);

         $transaction->update(['status' => $request->input('status')]);

         return response()->json(['message' => 'Transaction status successfully altered.', new TransactionResource($transaction)]);
     }

     public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'status' => 'required',
        'rental_agent_id' => 'required',
        'car_id' => 'required',
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors();

        if ($errors->has('rental_agent_id') && $errors->first('rental_agent_id') === 'The selected rental agent id is invalid.') {
            return response()->json(['The rental agent that you have entered doesent exist in the database!']);
        }

        if ($errors->has('car_id') && $errors->first('car_id') === 'The selected car id is invalid.') {
            return response()->json(['The car that you have entered doesent exist in the database!']);
        }

        return response()->json($errors);
    }

    $transaction = new Transaction();

    $user_id = Auth::user()->id;

    $transaction->date = Carbon::now()->format('Y-m-d');
    $transaction->status = $request->status;
    $transaction->user_id = $user_id;
    $transaction->rental_agent_id = $request->rental_agent_id;
    $transaction->car_id = $request->car_id;


    $transaction->save();

    return response()->json(['You have successfuly created a new transaction!',
         new TransactionResource($transaction)]);
    }

    public function update(Request $request, $id)
    {
         //ADMIN
         $isAdmin = Auth::user()->isAdmin;

        $user_id = Auth::user()->id;
        $transaction_user_id = Transaction::where('id', $id)->value('user_id');


        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'rental_agent_id' => 'required',
            'car_id' => 'required',
        ]);

        if ($transaction_user_id != $user_id && !$isAdmin) {
            return response()->json(['error' => 'Unauthorized: User ID does not match'], 403);
        }

        if ($validator->fails()) {
            $errors = $validator->errors();
    
            if ($errors->has('rental_agent_id') && $errors->first('rental_agent_id') === 'The selected rental agent id is invalid.') {
                return response()->json(['The rental agent that you have entered doesent exist in the database!']);
            }
    
            if ($errors->has('car_id') && $errors->first('car_id') === 'The selected car id is invalid.') {
                return response()->json(['The car that you have entered doesent exist in the database!']);
            }
    
            return response()->json($errors);
        }

        $transaction = Transaction::findOrFail($id);

        $transaction->date = Carbon::now()->format('Y-m-d');
        $transaction->status = $request->status;
        $transaction->user_id = $user_id;
        $transaction->rental_agent_id = $request->rental_agent_id;
        $transaction->car_id = $request->car_id;

        $transaction->save();

        return response()->json(['The specific transaction is successfuly altered!', new TransactionResource($transaction)]);
    }


    public function destroy($id)
    {
        //ADMIN
        $isAdmin = Auth::user()->isAdmin;

        $user_id = Auth::user()->id;
        $transaction_user_id = Transaction::where('id', $id)->value('user_id');

        if ($transaction_user_id != $user_id && !$isAdmin) {
            return response()->json(['error' => 'Unauthorized: User ID does not match'], 403);
        }
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return response()->json('You have successfuly deleted a transaction!');
    }



}
