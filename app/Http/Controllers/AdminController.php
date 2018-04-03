<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use DB;
class AdminController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware('auth');
    }
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * return response for the search.
     *
     * @return \Illuminate\Http\Response
     */
     public function showuserlist(Request $request)
     {
       // check wether the get request is ajax
       if($request->ajax())
       {
        //  Store the requested term in the search variable
         $srch = $request->search;
        //  return $user;
        // $user = User::all();
        // fire the query in the database and store it in the user variable
         $user = DB::select('select id,name,email,CASE WHEN role_id = 1
             THEN 0
             ELSE 1
        END AS role from users where name like "%'.$srch.'%" or email like "%'.$srch.'%"');
        
        //return the user response
        // return response($users);
        return view('admin.ajax.userlist',compact('user'));
       }

     }

    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showuserlist_backup()
    {





      // foreach ($user as $u)
      // {
      //     echo '<tr>
      //                       <td>'
      //         .$u->name
      //         .'</td> <td>'
      //         .$u->email
      //         .'</td><td>';
      //
      //
      //     if($u->role)
      //     {
      //         echo '<button type="button" class="btn btn-primary" onclick="makeadmin('.$u->id.')">Make New Admin</button>';
      //     }
      //     else
      //     {
      //         echo '<button type="button" class="btn btn-warning" onclick="removeadmin('.$u->id.')">Remove Admin</button>';
      //     }
      //     echo '</td>
      //                   </tr>';
      // }

    }

    /**
     * give user admin previleges
     *
     * @return \Illuminate\Http\Response
     */
     public function makeasadmin(Request $request)
     {
         $user = User::find($request->input('id'));
         $user->role_id =1;
         $user->save();
     }

     /**
      * remove users admin previleges
      *
      * @return \Illuminate\Http\Response
      */
     public function removeadmin(Request $request)
     {
         $user = User::find($request->input('id'));
         $user->role_id =3;
         $user->save();
     }



}
