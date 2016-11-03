<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\UserType;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function get_client_type_id(){
        $result = UserType::where('type','client')->get()->first();
        return $result->id;
   }

    public function index()
    {
        //return all clients
        $clients = User::where('user_type_id',$this->get_client_type_id())->get();
        return response()->json($clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //use request->only([keys],)
        // $user = User::insert($request->only('lname','fname','oname','email'));

        // return response()->json($user);
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
        
         //use request->only([keys],)
        $arr = $request->only('lname','fname','oname','email');
        $password= substr(bcrypt(sprintf('min%suto',rand())), 9,9); //limit bcrypt of rand to 9 
       
        
        $arr['user_type_id'] = $this->get_client_type_id();//set user type
        
        $user = User::create($arr);//create new client user

        //set password
        $user->password = bcrypt($password);

        //save change
        $user->save();

        //convert user to json and add passowrd
        $user = $user->toArray();

        $user['password'] = $password;


        // $user = $user->to_json();
        // $user->password = $password;

        return response()->json($user);
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
        return response()->json(User::with('accounts')->where('id',$id)->get()->first());
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
        $user =User::find($id)->update($request->except('id'));
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $options = ['1'=>'delete','2'=>'restore','3'=>'forceDelete'];
        $client = User::find($id);
        //check that input contains delete_option_code
        if($request->has('delete_option_code')){
            //perform action acordingly
            // $delete_option = ;
            $client->$options[$request->input('delete_option_code')]();
        }
        return response()->json($client);
    }
}
