<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tbl_status;

class StatusMainController extends Controller
{
    private $author, $date, $status, $limit = 5;

    /*
     *construct is used to inject data source, time and get Auth
     */
    public function __construct(Tbl_status $status){
        $this->status   = $status;

        date_default_timezone_set ( 'Asia/Phnom_Penh' );
        $this->date = date ( "Y-m-d H:i:s" );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $status = $this->status->orderBy( 'status_id', 'dsc' )->paginate( $this->limit );

        return view('home/status', compact('status'));
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
}
