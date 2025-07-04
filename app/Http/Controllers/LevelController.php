<?php

namespace App\Http\Controllers;

use App\Models\levels;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $datas = levels::all();
        $datas = levels::orderBy('id', 'desc')->get();
        $title = "Data Level";
        return view('level.index', compact('datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add Level";
        return view('level.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        levels::create($request->all());
        return redirect()->to('level')->with('success','Data berhasil ditambahkan');
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

        // $levels = levels::find($id);
        $level = levels::findOrFail($id);
        $title = "Edit Level";
        // $levels = levels::where('id', $id)->first();
        return view('level.edit', compact('level', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $level = levels::findOrFail($id);
        $level->level_name = $request->level_name;
        $level->save();
        return redirect()->to('level')->with('success','Data berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level = levels::findOrFail($id);
        $level->delete();
        return redirect()->to('level')->with('success','Data berhasil di hapus');
    }
}
