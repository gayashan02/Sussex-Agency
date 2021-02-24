<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientHobby;
use App\Customer;
use App\Hobby;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::where('status','=',true)->get();

        return  view('admin.client.index',compact('clients'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'contact' => 'required|max:10',
            'email' => 'required|email|unique:clients,email',
            'address' => 'required',
        ],[],
            [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'contact' => 'Contact Number',
                'email' => 'Email',
                'address' => 'Address',
            ]);

        $customer = new Client();

        $customer->first_name = $request->first_name;

        $customer->last_name = $request->last_name;

        $customer->address = $request->address;

        $customer->contact = $request->contact;

        $customer->email = $request->email;

        $customer->status = true;

        $customer->save();

        Alert::success('Successful', 'Client Added Successfully');

        return redirect()->back();
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
        $client = Client::findOrFail($id);

        $hobbies = Hobby::where('status','=',true)->get();

        return view('admin.client.edit',compact('client','hobbies'));
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
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'contact' => 'required|max:10',
            'email' => 'required|email|unique:clients,email,'.$id,
            'address' => 'required',
        ],[],
            [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'contact' => 'Contact Number',
                'email' => 'Email',
                'address' => 'Address',
            ]);

        $customer = Client::findOrFail($id);

        $customer->first_name = $request->first_name;

        $customer->last_name = $request->last_name;

        $customer->address = $request->address;

        $customer->contact = $request->contact;

        $customer->email = $request->email;

        $customer->update();

        Alert::success('Successful', 'Client Updated Successfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

        $client = Client::findOrFail($request->client_id);

        $client->status = false;

        $client->update();

        Alert::success('Successful', 'Client Deleted Successfully');

        return redirect(route('client.index'));
    }

    public function assign_hobbies($id,Request $request){

        $array = $request->get('hobbies');

        for($i=0;$i<sizeof($array);$i++){

            $count = ClientHobby::where('hobby_id','=',$array[$i])->where('client_id','=',$id)->count();

            if($count == 0){

                $item = new ClientHobby();

                $item->hobby_id = $array[$i];

                $item->client_id = $id;

                $item->save();

            }

        }

        Alert::success('Successful', 'Hobbies Updated Successfully');

        return redirect()->back();
    }

    public function register(Request $request){

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'contact' => 'required|max:10',
            'email' => 'required|email|unique:clients,email',
            'address' => 'required',
        ],[],
            [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'contact' => 'Contact Number',
                'email' => 'Email',
                'address' => 'Address',
            ]);

        $customer = new Client();

        $customer->first_name = $request->first_name;

        $customer->last_name = $request->last_name;

        $customer->address = $request->address;

        $customer->contact = $request->contact;

        $customer->email = $request->email;

        $customer->status = true;

        $customer->type = "online";

        $customer->save();

        Alert::success('Successful', 'Client Registered Successfully');

        return redirect('login');
    }
}
