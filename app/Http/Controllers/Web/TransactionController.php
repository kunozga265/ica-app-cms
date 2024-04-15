<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{

    public function index($code)
    {
        $cell = Cell::where("code", $code)->first();
        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell not found');
        else {
            return view('pages.cells.transactions', compact('cell'));
        }
    }


    public function store(Request $request, $code)
    {

        $cell = Cell::where("code", $code)->first();
        if (!is_object($cell))
            return Redirect::back()->with('error', 'Cell not found');
        else {

            Validator::make($request->all(), [
                "amount" => "required",
                "description" => "required",
                "type" => "required",
            ])->validate();

            $current_balance = $cell->balance;

            if ($request->type == 0) {
                $new_balance = $current_balance + $request->amount;
            } else {
                $new_balance = $current_balance - $request->amount;
            }

            $cell->update([
                'balance' => $new_balance
            ]);

            $transaction = Transaction::create([
                "amount" => $request->amount,
                "type" => $request->type,
                "description" => $request->description,
                "cell_id" => $cell->id,
                'balance' => $new_balance
            ]);

            return Redirect::back()->with("success", "Transaction recorded!");
        }
    }
}
