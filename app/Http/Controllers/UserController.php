<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('backoffice.users.index')->with(compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.users.create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ], [
            'name.required' => 'Field nama wajib diisi!',
            'email.required' => 'Field email wajib diisi!',
            'email.email' => 'Email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Kata sandi wajib diisi!',
            'password.min' => 'Kata sandi minimal 8 karakter!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai!',

        ]);

        $user = new User;
        $user->name = strip_tags(strtolower($request->name));
        $user->email = strip_tags(strtolower($request->email));
        $user->password = Hash::make($request->password);
        $user->status = ($request->status);

        $user->save();

        return redirect()->route('backoffice.users.index')->with([
            'alert-type' => 'success',
            'message' => 'Data Admin Berhasil Ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backoffice.users.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backoffice.users.edit')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],

        ], [
            'name.required' => 'Field nama wajib diisi!',
            'email.required' => 'Field email wajib diisi!',
            'email.email' => 'Email tidak valid!',

        ]);

        $user = User::findOrFail($id);
        $user->name = strip_tags(strtolower($request->name));
        $user->email = strip_tags(strtolower($request->email));
        $user->status = ($request->status);
        $user->save();

        return redirect()->route('backoffice.users.edit', $user->id)->with([
            'status' => 'success',
            'message' => 'Data Admin Berhasil Diubah'
        ]);
    }

    /**
     * Show the form for editing the password of admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        return view('backoffice.users.edit-password')->with(compact('user'));
    }

    /**
     * Update the password of admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ], [
            'password.required' => 'Kata sandi wajib diisi!',
            'password.min' => 'Kata sandi minimal 8 karakter!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai!',
        ]);

        $input = $request->all();
        $user = User::findOrFail($id);
        if (!Hash::check($input['current_password'], $user->password))
        {
            return back()->with([
                'alert-type' => 'error',
                'message' => 'Kata Sandi Lama Tidak Sesuai'
            ]);
        }
        else{
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('backoffice.users.edit', $user->id)->with([
            'status' => 'success',
            'message' => 'Kata Sandi Berhasil Diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('backoffice.users.index');
    }
}
