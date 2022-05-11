<?php

namespace App\Http\Controllers\Configs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate('5');
        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.roles.create');
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
            'name' => 'required|string|max:255|unique:roles,name'
        ]);

        $createRole = Role::create([
            'name' => $request->name,
            'created_by' => Auth::user()->name,
        ]);
        if (!$createRole) {
            session()->flash('error', 'Gagal Menyimpan Data ! <br>Silahkan Hubungi Administrator.');
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', 'Data Berhasil di-Tambahkan.');
        return to_route('roles.index');
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
        // return view('backend.roles.edit', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('backend.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$role->id
        ]);

        $updateRole = $role->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->name
        ]);
        if (!$updateRole) {
            session()->flash('error', 'Gagal Menyimpan Perubahan Data ! <br>Silahkan Hubungi Administrator.');
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', 'Perubahan Data di-Simpan.');
        return to_route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $deleteRole = $role->delete();
        if (!$deleteRole) {
            session()->flash('error', 'Gagal Menghapus Data ! <br>Silahkan Hubungi Administrator.');
            return redirect()->back();
        }

        session()->flash('warning', 'Data di-Hapus.');
        return to_route('roles.index');
    }
}
