<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){
        $user = User::all()->count();
        return view('admin.homepag',[
            'title' => 'Admin Page',
        ],$user
    );

    }

    public function home(){
        $product = array(
            'data_jenis' => Category::all(),
            'product' => Product::join('categories','categories.id','=','products.category_id')
                                        ->select('products.*','categories.kategori')
                                        ->get(),);
        return view('home.index',$product);
    }

    public function admin_home(){
        $user = User::where('usertype','user')->get()->count();
        $barang = Product::all()->count();
        $order = Order::all()->count();
        $data = array(
            'data_jenis' => Category::all(),
            'product' => Product::join('categories','categories.id','=','products.category_id')
                                        ->select('products.*','categories.kategori')
                                        ->get(),);

            return view('admin.homepage',$data,compact('user','barang','order'));

    }

    public function login_home(){
        $product = Product::all();
        $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id',$userid)->count();
        return view('home.index',compact('product','count'));
    }

    public function details($id){
        $data = Product::find($id);
        return view('home.index',compact('data'));
    }

    public function add_cart($id){

        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;

        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save();
        return redirect()->back()->with('Berhasil Ditambahkan');

    }

    public function mycart(){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
            $cart = Cart::where('user_id',$userid)->get();
        } else {
            $count = 0;
            $cart = collect();
        }
        return view('home.mycart',compact('count','cart'));
    }

    public function del_cart($id){
        if(Auth::id()) {
            $userId = Auth::id();
            $cartItem = Cart::where('user_id', $userId)->where('id', $id)->first();
            if ($cartItem) {
                $cartItem->delete();
                return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
            } else {
                return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang Anda.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
    }

    public function confirm_order(Request $request){
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id',$userid)->get();

        foreach ($cart as $carts) {
            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->save();
        }
        $cart_remove = Cart::where('user_id',$userid)->get();

        foreach ($cart_remove as $remove) {
            $data = Cart::find($remove->id);
            $data->delete();
        }

        return redirect()->back();
    }

    public function myorders(){
        $user = Auth::user()->id;

        $count = Cart::where('user_id',$user)->get()->count();
        $beli = Order::where('user_id',$user)->get();

        return view('home.myorder',compact('count','beli'));
    }
}
