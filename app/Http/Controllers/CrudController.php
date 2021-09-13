<?php

namespace App\Http\Controllers;

use App\Crud;
use Illuminate\Http\Request;
use Log;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('We are in index() of CrudController');
        $sushant = Crud::get();
        Log::info($sushant);
        return view('crud.index',compact('sushant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info('We are in create() of CrudController');
        return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('We are in store() of CrudController');
        Log::info('$request');
        Log::info($request);
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        // Crud::create($request->all());
        $data = new Crud;
        $data->name = $request->name;
        $data->detail = $request->detail;
        $data->save();
        return redirect()->route('crud.index')->with('success','Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function show(Crud $crud)
    {
        Log::info('We are in show() of CrudController');
        Log::info('$crud');
        Log::info($crud);
        return view('crud.show',compact('crud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function edit(Crud $crud)
    {
        Log::info('We are in edit() of CrudController');
        Log::info('$crud');
        Log::info($crud);
        return view('crud.edit',compact('crud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crud $crud)
    {
        Log::info('We are in update() of CrudController');
        Log::info('$crud');
        Log::info($crud);
        Log::info('$request');
        Log::info($request);
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        $data = Crud::find($crud->id);
        Log::info('$data');
        Log::info($data);
        $data->name = $request->name;
        $data->detail = $request->detail;
        $data->save();
        return redirect()->route('crud.index')->with('success','Data Updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crud $crud)
    {
        Log::info('We are in destroy() of CrudController');
        Log::info('$crud');
        Log::info($crud);
        $crud->delete();
        return redirect()->route('crud.index')->with('success','Data Deleted successfully.');
    }
}