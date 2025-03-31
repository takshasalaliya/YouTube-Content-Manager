<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Useremail;
use App\Imports\UserExcel;
use App\Imports\ManuallyUser;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon; 
use Illuminate\Support\Facades\Auth;
use App\Exports\ExportUser;
use Excel;

class UserController extends Controller
{
    //
    function login(Request $request){
      $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    // return $request;
    if(Auth::attempt($credentials)){
      if(Auth::user()->role=='admin'){
        
       return redirect('/');
      }
      if(Auth::user()->role=='volunteer'){
        return redirect('/scan');
       }
    }
    else{
      return redirect()->back()->with('message','Login detail in valid');
    }
    }

   

    function logout(){
      Auth::logout();
      return redirect('login')->with('message','Logout Successfully');
    }

  function dowload(){
    return Excel::download(new ExportUser, 'avd.xlsx');
  }

  function excel(Request $request){
    Excel::import(new ManuallyUser,$request->file('excel'));
    return redirect()->back()->with('message','Successfully Excel Uplaod');
  }

 function manually_form(Request $request){
  // return $request; 
  $file=$request->file;
  $data=new Channel();
  if($file){
  $filename = Carbon::now()->format('YmdHis').'-'.Auth::user()->id . '.' . $file->getClientOriginalExtension();
$data->file=$filename;
$request->file->move('assets',$filename);
  }
 
   $data->date=$request->date;
   $data->topic=$request->topic;
   $data->link=$request->link;
   $data->category=$request->category;
   $data->speaker=$request->speaker;
   $data->experience_sharing=$request->sharing_person;
   $data->prabodh_swami=$request->prabodh_swami;
   if($data->save()){
   return redirect()->back()->with('message','Successfully Add');
   }
   return redirect()->back()->with('message','Try again Later');
 }

 function list(){
  $datas=Channel::all();
  $count=Channel::count();
  return view('list',[
    'datas' => $datas,
    'count' => $count,
  ]);
 }
function file(Request $request,$id){
      $file=$request->file;
      $data=Channel::where('id',$id)->first();

      $filename = Carbon::now()->format('YmdHis').'-'.Auth::user()->id . '.' . $file->getClientOriginalExtension();
    $data->file=$filename;
    $request->file->move('assets',$filename);
    if($data->save()){
      return redirect()->back()->with('message','Successfully Add');
      }
      return redirect()->back()->with('message','Try again Later');
}

function share(Request $request,$id){
  $datavalue=Channel::where('id',$id)->first();
  $profile=Http::withHeaders([
    'Authorization' => 'Fonnte_Your_Account_Api_Key'
])->post('https://api.fonnte.com/get-devices',[

]);
$token=0;
$datas=$profile->json('data');
foreach($datas as $data){
    if($data['quota']>100){
        $token=$data['token'];
        break;
    }
    
} 
if($token==0){
    return redirect()->back()->with('error','Message Limit Is Completed Contant To Admin');

}
    $response = Http::withHeaders([
        'Authorization' => $token,
    ])->post('https://api.fonnte.com/send',[
         'countryCode' => '91',
        'target' => $request->phone,
        'message' => 'Youtube Channel Link'.$datavalue->link.'  Thank You 😊',
    ]);
    if($response->json('status') ===true){
        return redirect()->back()->with('success','message send successfully');
    }
    return redirect()->back()->with('error','message will not send');
}

}
