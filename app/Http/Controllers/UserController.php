<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
  
class UserController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm">View</a>';
                            $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
          
        return view('users.index');
    }
}