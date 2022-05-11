<?php

namespace App\Http\Controllers\Configs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate('5');
        return view('backend.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name'
        ]);

        $createPermission = permission::create([
            'name' => $request->name,
            'created_by' => Auth::user()->name,
        ]);
        if (!$createPermission) {
            session()->flash('error', 'Gagal Menyimpan Data ! <br>Silahkan Hubungi Administrator.');
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', 'Data Berhasil di-Tambahkan.');
        return to_route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
        // return view('backend.permissions.edit', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('backend.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,'.$permission->id
        ]);

        $updatePermission = $permission->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->name
        ]);
        if (!$updatePermission) {
            session()->flash('error', 'Gagal Menyimpan Perubahan Data ! <br>Silahkan Hubungi Administrator.');
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', 'Perubahan Data di-Simpan.');
        return to_route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(permission $permission)
    {
        $deletePermission = $permission->delete();
        if (!$deletePermission) {
            session()->flash('error', 'Gagal Menghapus Data ! <br>Silahkan Hubungi Administrator.');
            return redirect()->back();
        }

        session()->flash('warning', 'Data di-Hapus.');
        return to_route('permissions.index');
    }
}
