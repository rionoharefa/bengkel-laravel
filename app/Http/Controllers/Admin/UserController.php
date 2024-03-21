<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//utk menangkap url slug
use Illuminate\Support\Str;

//validasi utk form request
use App\Http\Requests\Admin\UserRequest;

//file data tabels yg dari github
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = User::query();

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
                                    <a class="dropdown-item" href="'. route('user.edit', $item->id) .'">
                                    Sunting
                                    </a>
                                    <form action="'. route('user.destroy', $item->id) .'" method="POST">
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
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    //  store('assets/user','public') jangan lupa di link di php artisan storage:link
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    //  findOrFail digunakan jika data tdk ada maka 404
    public function edit(string $id)
    {
        $item = User::findOrFail($id);

        return view('pages.admin.user.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->all();

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        else
        {
            unset($data['password']);
        }

        $item = User::findOrFail($id);

        $item->update($data);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}
