<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientEvent;
use App\ClientHobby;
use App\Event;
use App\Hobby;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        return view('admin.event.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
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
            'description' => 'required',
            'name' => 'required',
            'venue' => 'required',
            'date' => 'required|date_format:Y-m-d|after:'.date('Y-m-d',strtotime("-1 days")),
            'time' => 'required',
            'fee' => 'required',
            'clients' => 'required',
        ],[],
            [
                'description' => 'Description',
                'name' => 'Event Name',
                'venue' => 'Venue',
                'date' => 'Date',
                'time' => 'Time',
                'fee' => 'Event Fee',
            ]);

        $array = $request->get('clients');

        if ($array == null || sizeof($array) == 0 ){

            Alert::warning('Warning', 'No Client Selected');

            return Redirect::back();

        }

        $event = new Event();

        $event->name = $request->name;

        $event->description = $request->description;

        $event->venue = $request->venue;

        $event->date = $request->date;

        $event->time = $request->time;

        $event->fee = $request->fee;

        $event->save();

        $id = $event->id;

        for ($i = 0; $i < sizeof($array); $i++){

            $item = new ClientEvent();

            $item->client_id = $array[$i];

            $item->event_id = $id;

            $item->save();


            $client = Client::findOrFail($array[$i]);

            $to_name = $client->first_name.' '.$client->last_name;

            $to_email = $client->email;

            $subject = $request->name;

            $by_whom = "Sussex Agency";

            $data = array('name'=>$to_name, "email" => $to_email, "subject" => $subject, "event" => $event);

            Mail::send('mail.new_event', $data, function($message) use ($subject,$to_name, $to_email, $by_whom) {

                $message->to($to_email, $to_name)

                    ->subject($subject);

                $message->from(env('MAIL_USERNAME'),$by_whom);

            });

        }

        Alert::success('Success', 'Event Added Successfully');

        return redirect(route('event.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        $clients = ClientEvent::where('event_id','=',$id)->get();

        return view('admin.event.edit',compact('event','clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    public function hobby_match(Request $request){

        $text = strtolower($request->input('text'));

        $selected_hobbies = array();

        $hobbies = Hobby::where('status','=',true)->get();

        foreach($hobbies as $hobby){

            if(str_contains($text,strtolower($hobby->name))){

                array_push($selected_hobbies,$hobby->id);

            }

        }

        $html = '';

        $client_hash = array();

        if( sizeof($selected_hobbies) != 0) {

            $percentage = 100 / sizeof($selected_hobbies);

            for ($i = 0; $i < sizeof($selected_hobbies); $i++) {

                $client_hobbies = ClientHobby::where('hobby_id', '=', $selected_hobbies[$i])->get();

                foreach ($client_hobbies as $client) {

                    if (key_exists($client->client_id, $client_hash)) {

                        $client_hash[$client->client_id] = $client_hash[$client->client_id] + $percentage;

                    } else {

                        $client_hash[$client->client_id] = $percentage;

                    }

                }

            }
            $i = 1;
            foreach($client_hash as $x=>$x_value)
            {


                $html .= "<tr>";
                $html .= "<td style='width: 320px' height='40px'><b>";
                $html .= "<input class='form-check-input' type='checkbox' name='clients[]' value='".$x."'>".'   '.Client::findOrFail($x)->first_name.' '.Client::findOrFail($x)->last_name;
                $html .= "</b></td>";
                $html .= "<td style='text-align: right'>";
                $html .= $x_value.' ';
                $html .= "<i class='fas fa-percentage' style='color: #00b44e'></i></td>";
                $html .= "</tr>";
            }

        }

        //dd($html);

        return response()->json(['html' => $html]);

    }

    public function accept($id){

        $item = ClientEvent::findOrFail($id);

        $item->confirmation = true;

        $item->update();

        Alert::success('Success', 'Accepted Successfully');

        return redirect(route('event.show',$item->event_id));

    }

    public function download($id){

        $event = Event::findOrFail($id);

        $clients = ClientEvent::where('event_id','=',$id)->get();

        $pdf = PDF::loadView('reports.event', compact('event', 'clients'));

        return $pdf->download($event->name . '.pdf');

    }
}
