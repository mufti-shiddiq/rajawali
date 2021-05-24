<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\DailyReport;
use Darryldecode\Cart\CartCollection;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Exceptions\InvalidConditionException;
use Darryldecode\Cart\Exceptions\InvalidItemException;
use Darryldecode\Cart\Helpers\Helpers;
use Darryldecode\Cart\Validators\CartItemValidator;
use Darryldecode\Cart\Exceptions\UnknownModelException;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use \Reportable\Traits\Reportable;

class TransactionController extends Controller
{
    public function index(Request $request)
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

        if ($request->ajax()) {
            $data = \Cart::getContent();
            // dd($data);
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('code', function ($data) {
                    return $data->attributes->code;
                })

                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('quantity', function ($data) {
                    return $data->quantity;
                })

                ->addColumn('unit', function ($data) {
                    return $data->attributes->unit;
                })

                ->addColumn('price', function ($data) {
                    return $data->price;
                })

                ->addColumn('conditions', function ($data) {
                    return $data->conditions->parsedRawValue;
                })

                ->addColumn('total', function ($data) {
                    return $data->getPriceSumWithConditions();
                })

                ->addColumn('action', function ($data) {

                    $btn = '
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateitem' . $data->id . '"><i class="fa fa-edit"></i></button>

                            <!-- Modal -->
                            <div class="modal fade" id="updateitem' . $data->id . '" tabindex="-1" role="dialog" aria-labelledby="UpdateItem" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Perbaharui Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="' . route('cart.update') . '" method="POST">
                                            ' . csrf_field() . '
                                            <div class="modal-body row">
                                                <div class="col-md-8 mx-auto">
                                                    <input type="hidden" value="' . $data->id . '" id="id" name="id">

                                                    <div class="form-group">
                                                        <label for="quantity' . $data->id . '">Quantity</label>
                                                        <input class="form-control" type="number" min="1" name="quantity" id="quantity' . $data->id . '" value="' . $data->quantity . '" />
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="' . route('cart.remove', [$data->id]) . '" class="d-inline" method="POST">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" value="' . $data->id . '" name="id" class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Yakin ingin menghapus?\')"><i class="fa fa-trash-alt"></i></a>

                            </form>
                            ';

                    return $btn;
                })
                // ->rawColumns('action')

                ->make(true);
        }

        return view('transactions.index', compact('customer', 'kasir'));
    }

    public function add(Request $request)
    {
        \Validator::make($request->all(), [
            "id" => "required",
            "name" => "required",
            "price" => "required",
            "quantity" => "required|min:1",
            "discount_items" => "nullable",
            "code" => "required",
            "unit" => "required",
            "buyprice" => "required",
        ])->validate();

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
                'unit' => $request->unit,
                'buyprice' => $request->buyprice
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

    public function generateInvoice()
    {

        $last_trx = Transaction::latest('id')->first();
        $conv_last_trx = (int)$last_trx->id;
        $new_inv = $conv_last_trx + 1;

        if ($conv_last_trx > 0) {
            return 'RJ-INV-' . $new_inv;
        }

        return 'RJ-INV-1';
    }

    public function updateProduct($key, $qty)
    {
        Product::where('id', $key)->decrement('stock', $qty);
        Product::where('id', $key)->increment('sold', $qty);
    }

    public function process(Request $request)
    {
        \Validator::make($request->all(), [
            "customer" => "required",
            "note" => "nullable",
            "cash" => "required",
            "grand_total" => "required",
            "changes" => "required",
        ])->validate();

        $customer = $request->get('customer');
        $note = $request->get('note');
        $cash = $request->get('cash');
        $grand_total = $request->get('grand_total');
        $change = $request->get('changes');
        $cart = \Cart::getContent();
        $datetime = Carbon::now()->format('d-m-Y H:i:s');
        $date = Carbon::now()->format('d-m-Y');

        // dd($datetime);

        // dd($note);
        // Store Data ke table transactions

        $new_transaction = new \App\Models\Transaction();

        $new_transaction->invoice = $this->generateInvoice();
        $new_transaction->customer_id = $customer;
        $new_transaction->note = $note;
        $new_transaction->cash = $cash;
        $new_transaction->grand_total = $grand_total;
        $new_transaction->change = $change;

        $new_transaction->user_id = \Auth::user()->id;

        $new_transaction->datetime = $datetime;

        // dd($datetime);

        $new_transaction->save();

        // Store Data ke table transaction_details

        $new_trxdetail = new \App\Models\TransactionDetail();

        foreach ($cart as $key => $row) {
            $new_trxdetail->create([
                'transaction_id' => $new_transaction->id,
                'product_id' => $key,
                'code' => $row->attributes->code,
                'product' => $row['name'],
                'quantity' => $row['quantity'],
                'unit' => $row->attributes->unit,
                'price' => $row['price'],
                'buy_price' => $row->attributes->buyprice,
                'discount_item' => $row->conditions->parsedRawValue,
                'sub_total' => $row->getPriceSumWithConditions(),
                'capital' => $row->attributes->buyprice * $row['quantity'],
                'profit' => (($row['price'] - $row->conditions->parsedRawValue) - $row->attributes->buyprice) * $row['quantity'],
            ]);
            $qty = $row['quantity'];
            $this->updateProduct($key, $qty);
        }
        // dd($new_trxdetail);
        $new_trxdetail->save();

        // Add Capital and Profit to Transaction Table
        $transaction = Transaction::findOrFail($new_transaction->id);
        $profit_trx = TransactionDetail::where('transaction_id', $new_transaction->id)->sum('profit');
        $capital = TransactionDetail::where('transaction_id', $new_transaction->id)->sum('capital');

        $transaction->capital = $capital;
        $transaction->profit = $profit_trx;
        $transaction->save();

        // Add Report
        $trx = DailyReport::where('date', $date)->first();

        $qty_trx = TransactionDetail::where('transaction_id', $new_transaction->id)->sum('quantity');

        if ($trx !== null) {
            $trx->increment('transaction', 1);
            $trx->increment('product', $qty_trx);
            $trx->increment('value', $new_transaction->grand_total);
            $trx->increment('capital', $capital);
            $trx->increment('profit', $profit_trx);
        } else {
            $trx = DailyReport::create([
                'date' => $date,
                'transaction' => 1,
                'product' => $qty_trx,
                'value' => $new_transaction->grand_total,
                'capital' => $capital,
                'profit' => $profit_trx,
            ]);
        }

        // Delete TRX with TRX_ID = 0
        $trxnol = \App\Models\TransactionDetail::where('transaction_id', 0);
        $trxnol->delete();

        \Cart::clear();
        return redirect()->route('transaction.success');
    }

    public function success()
    {
        $last_trx = Transaction::latest('created_at')->first();
        $last_inv = $last_trx->invoice;
        $last_id = $last_trx->id;
        // dd($last_inv->invoice);
        return view('transactions.success', compact('last_inv', 'last_id'));
    }

    public function print($id)
    {
        $transaction = \App\Models\Transaction::findOrFail($id);

        $trx_detail = \App\Models\TransactionDetail::where('transaction_id', $id)->get();

        return view('transactions.print', ['transaction' => $transaction, 'trx_detail' => $trx_detail]);
        // $produk = TransactionDetail::all($id);

        // $tanggal = new DateTime($produk->tanggal);
        // $barcode = explode(',', $produk->barcode);
        // $qty = explode(',', $produk->qty);

        // $produk->tanggal = $tanggal->format('d m Y H:i:s');

        // $dataProduk = $this->transaksi_model->getName($barcode);
        // foreach ($dataProduk as $key => $value) {
        //     $value->total = $qty[$key];
        //     $value->harga = $value->harga * $qty[$key];
        // }

        // $data = array(
        //     'nota' => $produk->nota,
        //     'tanggal' => $produk->tanggal,
        //     'produk' => $dataProduk,
        //     'total' => $produk->total_bayar,
        //     'bayar' => $produk->jumlah_uang,
        //     'kembalian' => $produk->jumlah_uang - $produk->total_bayar,
        //     'kasir' => $produk->kasir
        // );
        // $this->load->view('cetak', $data);
    }
}
