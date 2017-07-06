<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tbl_status;
use App\http\Requests\StatusApiRequest;

/**
 * fb: Kim Chhoin
 * 0967676964
 * Feb/07/2017
 */
class StatusApiController extends Controller
{
    private $date, $status;

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
        $status = $this->status->get();
        return response()->json([
            'STATUS'    =>  true,
            'DATA'      =>  $status,
            'CODE'      =>  200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusApiRequest $request)
    {
        $this->status->status_title       = $request->txtName;
        $this->status->status_description = $request->txtDescription;
        $this->status->status_author      = "Admin";
        $this->status->created_at         = $this->date;
        $this->status->updated_at         = $this->date;

        $insert = $this->status->save();
        if($insert) {
            return response()->json([
                'STATUS'    =>  true,
                'MESSAGE'   =>  'Status was inserted',
                'CODE'      =>  200
            ], 200);
        }else{
            return response()->json([
                'STATUS'    => false ,
                'MESSAGE'   => 'Status not insert',
                'CODE'      => 400
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = preg_replace( '#[^0-9]#', '', $id );

        if ($id != "" && !empty($id)) {

            $status =$this->status->where('status_id', $id)->first();

            if($status){
                return response()->json([
                    'STATUS'    =>  true,
                    'MESSAGE'   =>  'Record found',
                    'DATA'      =>  $status
                ], 200);
            }
        }

        return response()->json([
            'STATUS'    => false ,
            'MESSAGE'   => 'Record Not Found',
            'CODE'      =>  400
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusApiRequest $request)
    {
        $id = preg_replace ( '#[^0-9]#', '', $request->id );

        if ( $id != "" && !empty($id)) {

            $update = $this->status->where('status_id',$id)->first();

            if($update) {

                $this->status->where ('status_id', $id )->update ( [
                    'status_title'          => $request->txtName,
                    'status_description'    => $request->txtDescription,
                    'status'                => '1',
                    'status_author'         => 'Admin',
                    'updated_at'            => $this->date
                ] );

                return response()->json([
                    'STATUS'    =>  true,
                    'MESSAGE'   =>  'Status was updated',
                    'CODE'      =>  200
                ], 200);

            }
        }

        return response()->json([
            'STATUS'    =>  false,
            'MESSAGE'   =>  'Status not found',
            'CODE'      =>   400
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = preg_replace ( '#[^0-9]#', '', $id );

        if(!empty($id)) {
            $delete = $this->status->where('status_id', $id)
                ->update(['status' => 0]);

            if($delete ) {
                return response()->json([
                    'STATUS'    =>  true,
                    'MESSAGE'   =>  'Status was deleted',
                    'CODE'      =>  200
                ], 200);
            }
        }
        return response()->json([
            'STATUS'    =>  false,
            'MESSAGE'   =>  'Status not delete',
            'CODE'      =>  400
        ], 200);
    }

    /**
     * search
     *
     * @param unknown $page
     * @param unknown $limit
     *
     */
    public function listAll($page, $limit, $keySearch)
    {
        $keySearch  = preg_replace ( '#[^0-9A-Za-z\s-_]#', '', $keySearch );
        $page       = preg_replace ( '#[^0-9]#', '', $page );
        $item       = preg_replace ( '#[^0-9]#', '', $limit );

        if (!empty($keySearch) && !empty($page) && !empty($page)) {

            $offset	= $page * $item - $item;
            $count	= 0;
            $status;

            if ($keySearch == "all") {
            	$count = $this->status->count();
            } else {
            	$count = $this->status->where ( 'status_title', 'like',  $keySearch . '%' )
            	->orwhere('status_id', '=', $keySearch )->count();
            }
           
            $totalpage = 0;

            if ($count % $item > 0 ){
                $totalpage = floor($count / $item) +1;
            }else {
                $totalpage = $count / $item ;
            }

            $pagination = [
                'TOTALPAGE'     => $totalpage ,
                'TOTALRECORD'   => $count ,
                'CURRENTPAGE'   => (int)$page,
                'SHOWITEM'      => (int)$item
            ];

            if ($keySearch == "all") {
            	$status = $this->status->skip($offset)
	            	->take($item)
	            	->orderBy('status_id', 'desc')
	            	->get();
            } else {
            	$status = $this->status->where ( 'status_title', 'like',  '%'.$keySearch . '%' )
	            	->orwhere('status_id', '=', $keySearch )
	            	->skip($offset)->take($item)
	            	->orderBy('status_id', 'desc')
	            	->get();
            }
            

            if ($status && $page <= $totalpage)  {
                return response()->json([
                    'STATUS'    => true ,
                    'MESSAGE'   =>'record found',
                    'DATA'      => $status,
                    'PAGINATION'=> $pagination,
                    'CODE'      => 200
                ], 200);
            }
        }

        return response()->json([
            'STATUS'    =>  false ,
            'MESSAGE'   => 'Not Found',
            'CODE'      => 400
        ], 200);
    }
}
