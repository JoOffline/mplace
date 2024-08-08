<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class AdminController extends Controller
{
    public function view_kategori(){
        $data = array(
            'title' => 'Data Jenis Barang',
            'category' => Category::all(),
        );
        return view('admin.jenisbarang',$data);
    }
    public function add_kategori(Request $request){
        $validator = Validator::make($request->all(),[
            'kategori'=>'required|unique:categories,kategori,id',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        Category::create($validatedData);
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function hapus_kategori($id){
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('sucess','Data Berhasil Dihapus');
    }

    public function edit_kategori(Request $request,$id){

        if (!$request->all()) {
            return redirect()->back()->with('error', 'Tidak ada data yang dikirimkan');
        }

        $data = Category::find($id);
        $validator = Validator::make($request->all(),[
            'kategori'=>'required|unique:categories,kategori,id',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($data) {
            $validatedData = $validator->validated();
            $data->update($validatedData);
            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        }
        return redirect()->back()->with('error', 'Data Tidak Ditemukan');
    }

    public function add_produk(){
        $data = array(
        'data_jenis' => Category::all(),
        'product' => Product::join('categories','categories.id','=','products.category_id')
                                    ->select('products.*','categories.kategori')
                                    ->get(),);
        return view('admin.add_produk',$data);
    }

    public function upload_produk(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar jika ada
    ]);

    // Buat instance produk baru
    $data = new Product;
    $data->title = $validatedData['title'];
    $data->description = $validatedData['description'];
    $data->price = $validatedData['price'];
    $data->quantity = $validatedData['quantity'];
    $data->category_id = $validatedData['category_id'];

    $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imagename);
            $data->image = $imagename;
        }

    // Simpan data produk
    $data->save();

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
}


    public function hapus_produk($id){
        $data = Product::find($id);

        $image_path = public_path('products/'.$data->image);

        if(file_exists($image_path)){
            unlink($image_path);
        }

        $data->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }

    public function update_produk(Request $request, $id){
        $data = Product::find($id);
        $category = Category::all();

        if ($data) {
            // Validasi input
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:0',
                'category' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar jika ada
            ]);

            // Update data produk
            $data->title = $validatedData['title'];
            $data->description = $validatedData['description'];
            $data->price = $validatedData['price'];
            $data->quantity = $validatedData['quantity'];
            $data->category_id = $validatedData['category'];

            // Penanganan gambar
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products'), $imagename);
                $data->image = $imagename;
            }

            $data->save();

            return redirect()->back()->with('success','Data Berhasil Diperbarui');
        } else {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }
    }

    public function view_order(){
        $data = Order::all();
        return view('admin.order',compact('data'));
    }

    public function otw($id){
        $data = Order::find($id);
        $data->status = 'On The Way';
        $data->save();
        return redirect()->back()->with('success','Status Order Berhasil Diubah');
    }

    public function delivered($id){
        $data = Order::find($id);
        $data->status = 'Delivered';
        $data->save();
        return redirect()->back()->with('success','Status Order Berhasil Diubah');
    }



}
