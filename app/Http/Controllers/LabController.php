<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabRequest;
use App\Models\Lab;
use Illuminate\Http\Request;

class LabController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labs = Lab::all();
        return view('admin.lab.index',compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lab.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabRequest $request)
    {
        Lab::create($request->validated());
        return redirect()->route('lab.index')
                        ->with('success','Data lab berhasil ditambahkan');
    }


    public function show(Lab $lab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lab $lab)
    {
        return view('admin.lab.edit',compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabRequest $request, Lab $lab)
    {
        $lab->update($request->validated());
        return redirect()->route('lab.index')
                        ->with('success','Data lab berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lab $lab)
    {
        if ($lab->student()->exists()) {
            return redirect()->route('lab.index')
                             ->with('errors', 'Gagal dihapus: Lab ini masih memiliki siswa aktif.');
        }

        $lab->delete();
        return redirect()->route('lab.index')
                         ->with('success','Data lab berhasil dihapus');
    }
}
