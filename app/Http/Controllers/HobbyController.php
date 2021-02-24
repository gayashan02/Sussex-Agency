<?php

namespace App\Http\Controllers;

use App\Category;
use App\Hobby;
use App\Item;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HobbyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hobbies = Hobby::where('status','=',true)->get();

        return view('admin.hobby.index',compact('hobbies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ],[],
            [
                'name' => 'Hobby Name',

            ]);

        $hobby = new Hobby();

        $hobby->name = $request->name;

        $hobby->description = $request->description;

        $hobby->save();

        Alert::success('Success', 'Hobby Added Successfully');

        return redirect(route('hobby.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

        $hobby = hobby::findOrFail($request->hobby_id);

        $hobby->status = false;

        $hobby->update();

        Alert::success('Deleted', 'hobby Deleted Successfully');


        return redirect(route('hobby.index'));
    }
}
