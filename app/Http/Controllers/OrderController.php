<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use PDF;
use Session;
use Alert;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 1) {
            $orders = Order::orderBy('id', 'DESC')->get();
            return view('admin.order.index', compact('orders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function current_year()
    {
        if (Auth::user()->type == 1) {
            $orders = Order::whereYear('created_at', Carbon::now()->year)->get();
            return view('admin.order.current-year', compact('orders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function current_month()
    {
        if (Auth::user()->type == 1) {
            $orders = Order::whereYear('created_at', Carbon::now()->year)->get();
            return view('admin.order.current-month', compact('orders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function today()
    {
        if (Auth::user()->type == 1) {
            $orders = Order::whereDate('created_at', Carbon::today())->get();
            return view('admin.order.current-month', compact('orders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function search(Request $request)
    {
        if (Auth::user()->type == 1) {
            if (!empty($request->order_status_id) && !empty($request->date_from) && !empty($request->date_to)) {
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_from.' 00:00:00');
                $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_to.' 23:59:59');
                $order_status_id = $request->order_status_id;

                $orders = Order::where('order_status_id', $order_status_id)
                ->whereBetween('created_at', [$start_date,$end_date])->orderBy('id', 'DESC')->get();
            }
            if ((!empty($request->order_status_id) && empty($request->date_from) && empty($request->date_to)) || (!empty($request->order_status_id) && !empty($request->date_from) && empty($request->date_to)) || (!empty($request->order_status_id) && empty($request->date_from) && !empty($request->date_to))) {

                $order_status_id = $request->order_status_id;

                $orders = Order::where('order_status_id', $order_status_id)->orderBy('id', 'DESC')->get();
            }
            if (empty($request->order_status_id) && !empty($request->date_from) && !empty($request->date_to)) {
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_from.' 00:00:00');
                $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_to.' 23:59:59');
                $order_status_id = $request->order_status_id;
                $orders = Order::whereBetween('created_at', [$start_date,$end_date])->orderBy('id', 'DESC')->get();
            }
            if (empty($request->order_status_id) && (empty($request->date_from) || empty($request->date_to))) {
                $orders = Order::orderBy('id', 'DESC')->get();
            }

            // 2nd step filter
            $district_id = $request->district_id;

            if (!empty($request->district_id) && !empty($request->area_id)) {

                $orders = $orders->where('district_id', $request->district_id)->where('area_id', $request->area_id);
            }
            if (!empty($request->district_id) && empty($request->area_id)) {
                $orders = $orders->where('district_id', $request->district_id);
            }

            return view('admin.order.index', compact('orders'));
        }
        else{
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->type == 1) {
            $order = Order::find($id);
            return view('admin.order.edit', compact('order'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->type == 1) {
            $order = Order::find($id);
            if (!is_null($order)) {
                foreach ($order->order_product as $product) {
                    $product->delete();
                }
                $order->delete();
                Alert::toast('Order deleted successfully!', 'success');
                return redirect()->route('order.index');
            }
            else{
                Alert::toast('Something went wrong !', 'error');
                return back();
            }
        }
        else{
            Alert::toast('Access Denied !', 'error');
            return back();
        }
    }

    public function change_status(Request $request, $id)
    {
        if (Auth::user()->type == 1) {
            $order = Order::find($id);
            if (!is_null($order)) {
                $order->order_status_id = $request->order_status_id;
                $order->save();
                Alert::toast('Status Updated !', 'success');
                return back();
            }
            else{
                Alert::toast('Something went wrong !', 'error');
                return back();
            }
        }
        else{
            Alert::toast('Access Denied !', 'error');
            return back();
        }
    }

    public function change_payment_status(Request $request, $id)
    {
        if (Auth::user()->type == 1) {
            $order = Order::find($id);
            if (!is_null($order)) {
                $order->payment_status = $request->payment_status;
                $order->save();
                Alert::toast('Status Updated !', 'success');
                return back();
            }
            else{
                Alert::toast('Something went wrong !', 'error');
                return back();
            }
        }
        else{
            Alert::toast('Access Denied !', 'error');
            return back();
        }
    }

    public function generate_invoice($id)
    {
        $order =Order::find($id);
        if (!is_null($order)) {
            $pdf = PDF::loadView('admin.invoice.generate', compact('order'));
            return $pdf->download($order->code.'.pdf');
        }
        else{
            Alert::toast('Invoice Not Found!', 'error');
            return back();
        }
    }

    public function orders_by_status($id)
    {
        if (Auth::user()->type == 1) {
            $orders = Order::where('order_status_id', $id)->orderBy('id', 'DESC')->get();
            return view('admin.order.index', compact('orders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }
    public function orders_by_ventor_status($id)
    {
        if (Auth::user()->type == 2) {
            $orders = Order::where('order_status_id', $id)->orderBy('id', 'DESC')->get();
            return view('admin.order.index', compact('orders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function todayOrder()
    {
        if (Auth::user()->type == 2) {
            $orders = Order::whereDate('created_at', Carbon::today())->get();
//            dd($orders);
            return view('admin.order.current-month', compact('orders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }

    public function thisWeek()
    {
        if (Auth::user()->type == 2) {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();

            $weekOrders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
            return view('pages.vendor.order.this-week-order', compact('weekOrders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }
    public function shipped()
    {
        if (Auth::user()->type == 2) {

            $shippedOrders = Order::where('order_status_id', 4)->get();
            return view('pages.vendor.order.shipped-order', compact('shippedOrders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }
    public function mostOrdered()
    {
        if (Auth::user()->type == 2) {

            $mostOrderedProducts = Product::join('order_products', 'products.id', '=', 'order_products.product_id')
//                ->select('product_id', DB::raw('count(*) as total'))
//                ->groupBy('product_id')
//                ->orderBy('order_products.qty', 'desc')
                ->where('order_products.qty', '>', 2)
                ->take(10)
                ->get();
//            dd($mostOrderedProducts);
            return view('pages.vendor.order.most-ordered', compact('mostOrderedProducts'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }
    public function orderedOverView()
    {
        if (Auth::user()->type == 2) {

            $shippedOrders = Order::get();
            return view('pages.vendor.order.order-overview', compact('shippedOrders'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }
}
