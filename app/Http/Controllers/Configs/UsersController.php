<?php

namespace App\Http\Controllers\Configs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->trashed) {
            $users = User::onlyTrashed()->paginate('1');
        } else {
            $users = User::paginate('5');
        }
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $createUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_by' => Auth::user()->name,
        ]);
        if (!$createUser) {
            session()->flash('error', 'Gagal Menyimpan Data ! <br>Silahkan Hubungi Administrator.');
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', 'Data Berhasil di-Tambahkan.');
        return to_route('users.index');
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
        // return view('backend.users.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);

        $password = $user->password;

        if ($request->password) {
            $request->validate([
                'password' => 'required|string|confirmed'
            ]);

            $password = Hash::make($request->password);
        }

        $updateUser = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'updated_by' => Auth::user()->name
        ]);
        if (!$updateUser) {
            session()->flash('error', 'Gagal Menyimpan Perubahan Data ! <br>Silahkan Hubungi Administrator.');
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', 'Perubahan Data di-Simpan.');
        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleteUser = $user->delete();
        if (!$deleteUser) {
            session()->flash('error', 'Gagal Menghapus Data ! <br>Silahkan Hubungi Administrator.');
            return redirect()->back();
        }

        session()->flash('warning', 'Data di-Hapus.');
        return to_route('users.index');
    }

    public function restore(Request $request, $id)
    {
        $user = User::onlyTrashed()->where('id', '=', $id)->first();
        if ($user != null) {
            $restoreUser = $user->restore();
            if (!$restoreUser) {
                session()->flash('error', 'Gagal Memulihkan Data ! <br>Silahkan Hubungi Administrator.');
                return redirect()->back();
            }
            session()->flash('warning', 'Data di-Aktifkan Kembali.');
        }

        return to_route('users.index');
    }
}
