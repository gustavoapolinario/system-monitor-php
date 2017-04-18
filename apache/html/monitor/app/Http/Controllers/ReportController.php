<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apenas logado
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {

        //$data = \App\ServerLog::getLatest($id);

        if( !\App\ServerLog::canAccess($request, $id) ) {
            return redirect('home');
        }

        return view('report', [
            'id'=>$id
        ]);
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request, $id)
    {
        if( !\App\ServerLog::canAccess($request, $id) ) {
            return \Response::json(array(
                'success' => false,
            ));
        }


        $data = \App\ServerLog::getLatest($id);

        return \Response::json(array(
            'success' => true,
            'data'   => $data
        )); 
    }


}
