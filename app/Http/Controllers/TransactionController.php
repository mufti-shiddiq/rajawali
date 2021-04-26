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

        // dd($cartCollection);
        // dd($discount_item);

        return view('transactions.index', compact('customer', 'kasir'))->with(['cartCollection' => $cartCollection]);
    }

    public function add(Request $request)
    {
        $discount_items = new CartCondition(array(
            'name' => 'Diskon Item',
            'type' => 'promo',
            'value' => '-' . $request->discount_item,
        ));

        // dd($discount_items);

        $cart = \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'conditions' => $discount_items,
            'attributes' => array(
                'code' => $request->code,
                'unit' => $request->unit
            ),
        ));

        // dd($cart);

        return redirect()->route('transaction.index');
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->route('transaction.index');
    }

    public function update(Request $request)
    {

        \Cart::update(
            $request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            )
        );
        return redirect()->route('transaction.index');
    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->route('transaction.index');
    }

    public function process(Request $request)
    {
    }

    public function success()
    {
    }
}
