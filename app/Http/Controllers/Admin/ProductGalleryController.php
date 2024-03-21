<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//pastikan memanggil model relasi utk create
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

//utk menangkap url slug
use Illuminate\Support\Str;

//validasi utk form request
use App\Http\Requests\Admin\ProductRequest;
use App\Models\ProductGallery;

//file data tabels yg dari github
use Yajra\DataTables\Facades\DataTables;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = ProductGallery::with(['product']);

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1"
                                type="button"
                                data-toggle="dropdown">
                                Aksi
                                </button>
                                <div class="dropdown-menu">
                                   
                                    <form action="'. route('product-gallery.destroy', $item->id) .'" method="POST">
                                        '. method_field('delete') . csrf_field() .'
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('photos', function($item){
                    return $item->photos ? '<img src="'. Storage::url($item->photos) .'" style="max-height:80px;" />' : '';
                })
                ->rawColumns(['action','photos'])
                ->make();
        }
        return view('pages.admin.product-gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        $products = Product::all();
        return view('pages.admin.product-gallery.create',[
            'products' => $products
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    //  store('assets/product','public') jangan lupa di link di php artisan storage:link
    public function store(GalleryRequest $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product','public');

        ProductGallery::create($data);

        return redirect()->route('product-gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //ProductGallery::create($data);
    }

    /**
     * Show the form for editing the specified resource.
     */

    //  findOrFail digunakan jika data tdk ada maka 404
    public function edit(string $id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('product-gallery.index');
    }
}
