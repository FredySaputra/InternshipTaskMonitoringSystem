<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::all();
        return view('admin.school.index',compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.school.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolRequest $request)
    {
        School::create($request->validated());
        return redirect()->route('school')
                        ->with('success','Data sekolah berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        return view('admin.school.edit',compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolRequest $request, School $school)
    {
        $school->update($request->validated());
        return redirect()->route('school')
                        ->with('success','Data sekolah berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('school')
                         ->with('success','Data sekolah berhasil dihapus');
    }
}
