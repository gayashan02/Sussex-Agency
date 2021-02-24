<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientEvent;
use App\Event;
use App\Payment;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();

        return  view('admin.payment.index',compact('payments'));
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
        if($request->type == "card"){

            $this->validate($request,[
                'card_name' => 'required',
                'card_no' => 'required|digits:16',
                'CVS' => 'required|digits:3',
                'expiry_date' => 'required|date_format:m/y|after:'.date('m/y'),

            ],[],
                [
                    'card_name' => 'Card Holder\'s name' ,
                    'card_no' => 'Card number',
                    'CVS' => 'CVS',
                    'expiry_date' => 'Expiry Date',
                ]);

        }

        $payment = new Payment();

        $payment->client = $request->id;

        $payment->date = date('Y-m-d');

        $payment->time = date('h:i');

        $payment->amount = $request->total;

        $payment->months = $request->months;

        $events = ClientEvent::where('client_id','=',$request->id)->where('confirmation','=',true)->where('payment','=',false)->get();

        foreach ($events as $event){

            $event->payment = true;

            $event->update();

        }

        $payment->save();

        Alert::success('Success', 'Payment Added Successfully');

        return redirect(route('client.edit',$request->id));
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
    public function destroy($id)
    {
        //
    }

    public function summary(){

        $last_date = date('Y-m-d', strtotime("-3 months", strtotime(date('Y-m-d'))));

        $events = Event::whereBetween('created_at', [$last_date." 00:00:00", date('Y-m-d')." 23:59:59"])->get();

        $pdf = PDF::loadView('reports.event_summary', compact('events','last_date'));

        return $pdf->download('Quarterly Event Payment Summery from '.$last_date.' to '.date('Y-m-d') . '.pdf');

    }
}
