<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $datas = User::all();
        $datas = User::orderBy('id', 'desc')->get();
        $title = "Data User";
        return view('user.index', compact('datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add User";
        return view('user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all());
        // toast('Data berhasil ditambahkan!','success');
        alert()->success('Title','Lorem Lorem Lorem');
        // Alert::success('Success Add', 'Data berhasil ditambahkan');
        return redirect()->to('user')->with('success','Data berhasil ditambahkan');
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
    public function edit(string $id)
    {

        // $User = User::find($id);
        $user = User::findOrFail($id);
        $title = "Edit User";
        // $User = User::where('id', $id)->first();
        return view('user.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->save();
        toast('Data berhasil terupdate!','success');
        return redirect()->to('user')->with('success','Data berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toast('Data berhasil di hapus!','success');
        return redirect()->to('user')->with('success','Data berhasil di hapus');
    }
}
