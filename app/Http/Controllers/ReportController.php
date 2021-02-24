<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Expense;
use App\Inventory;
use App\Investment;
use App\Loan;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
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
        $month = 9;
        $year = 2020;
        $incomes = Bill::whereYear('date',$year)->whereMonth('date',$month)->get();



        return view('reports.monthly_download', compact('incomes','month','year'));
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
        //
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

    public function monthly_download(Request $request)
    {
        $incomes = Bill::whereYear('date',(int)$request->year)->whereMonth('date',(int)$request->month)->get();
        $count = Bill::whereYear('date',(int)$request->year)->whereMonth('date',(int)$request->month)->count();


        if($count == 0) {
            Alert::error('Error', 'No Records');
            return redirect(route('reports.monthly_report'));
        }else{
            $month = (int)$request->month;
            $year = (int)$request->year;

            $pdf = PDF::loadView('reports.monthly_download', compact('incomes', 'month', 'year'));

            $dateObj = \DateTime::createFromFormat('!m', now()->format('m'));
            $monthName = $dateObj->format('F'); // March

            //$pdf->stream( 'file.pdf' , array( 'Attachment'=>0 ) );
            return $pdf->download('Monthly-Income-report-of-' . $monthName . '.pdf');
        }
    }
    public function monthly_report()
    {

        $incomes = Bill::whereYear('date',(int)date('Y'))->whereMonth('date',(int)date('m'))->get();

        return view('reports.monthly_report',compact('incomes'));

    }
}
