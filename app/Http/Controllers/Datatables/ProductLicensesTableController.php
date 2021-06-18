<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductLicense;

class ProductLicensesTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if (Request()->ajax()) {

            $query = ProductLicense::where('product_id', $req->product_id)->latest()->get();
          
            return datatables()->of($query)
            
            ->addColumn('license_id', function($data){

                $license_id = $data->id;

                return $license_id;
            })
            ->addColumn('license_key', function($data){

                $license_key = $data->key;

                return $license_key;
            })
            ->addColumn('created_at', function($data){

                $created_at = $data->created_at;

                return $created_at;
            })
            ->addColumn('updated_at', function($data){

                $updated_at = $data->updated_at;

                return $updated_at;
            })
            ->addColumn('status', function($data){

                if ($data->status == 'unused') {
                    $status = '<span class="text-success"><i class="fa fa-circle"></i> Unused </span>';
                } else if ($data->status == 'used') {
                    $status = '<span class="text-danger"><i class="fa fa-circle"></i> Used </span>';
                }
                return $status;

            })
            ->addColumn('action', function($data){

                if ($data->status == 'unused') {
                    $action = '
                        <button id="delete-key" data-key-id="'.$data->id.'" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    ';
                } else {
                    $action = '';
                }
                
                return $action;
            })

            ->rawColumns(['license_id', 'license_key', 'created_at', 'updated_at', 'status', 'action'])->make(true);

        }
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
    public function store(Request $req)
    {
        return $req;
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
        $ProductLicense = ProductLicense::where('id', $id)->where('status', 'unused')->first();
        $ProductLicense->delete();
        return [
            'license_key' => $ProductLicense->key,
        ];
    }
}
