<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Exceptions\InvalidConditionException;
use Darryldecode\Cart\Exceptions\InvalidItemException;
use Darryldecode\Cart\Helpers\Helpers;
use Darryldecode\Cart\Validators\CartItemValidator;
use Darryldecode\Cart\Exceptions\UnknownModelException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $userId = \Auth::user()->id;
        $kasir = \Auth::user();
        $customer = customer::all();
        // $product = product::all();

        // date_default_timezone_set("Asia/Jakarta");
        // $waktu = date("d-m-Y / H:i:s");

        $cartCollection = \Cart::getContent();
        
        return view('transactions.index', compact('customer', 'kasir'))->with(['cartCollection' => $cartCollection]);
    }

    public function add(Request$request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'code' => $request->code,
                'unit' => $request->unit
            )
        ));
        return redirect()->route('transaction.index');
    }

    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('transaction.index');
    }

    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        return redirect()->route('transaction.index');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('transaction.index');
    }

}
