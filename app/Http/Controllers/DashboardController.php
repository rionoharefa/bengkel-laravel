<?php

//INI DASHBOARD UNTUK USER CUSTOMER
namespace App\Http\Controllers;
use Illuminate\Http\Request;

//hubungkan dengan library Auth bawaan Laravel
use Illuminate\Support\Facades\Auth;

//hubungkan dengan Models 
use App\Models\TransactionDetail;
use App\Models\User;
use League\Fractal\Resource\Item;

//ini merupakan query utk dashboard customer
class DashboardController extends Controller
{
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //ini tampilan Transaction yg ada di halaman dasboard
        $transactions = TransactionDetail::with(['transaction.user', 'product.product_galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            });

        $revenue = $transactions->get()->reduce(function ($carry, $item) {
            return $carry + $item->price;
        });

        $customer = User::count();
                    
        return view('pages.dashboard',[
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'customer' => $customer
        ]);
    }
}
