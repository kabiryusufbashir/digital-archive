<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\loginRecords;

class LoginController extends Controller
{
    public function front(){
        return view('welcome');
    }

    public function login(Request $request){
        $data = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        try{
            if(Auth::attempt(['name' => $request->username, 'password' => $request->password])){
                try{
                    $user_status = User::where('name', $request->username)->where('status', 1)->count();
                        if($user_status == 1){
                            $request->session()->regenerate();
                            $user_id = User::select('id')->where('name', $request->username)->first();
                            try{
                                loginRecords::create([
                                    'user_id' => $user_id->id,
                                ]);
                    
                                return redirect()->route('dashboard'); 
                                
                            }catch(Expection $e){
                                return back()->with(['error' => 'Please try again later! ('.$e.')']);
                            }
                        }else{
                            return back()->with('error', 'Inactive Account');
                        }
                }catch(Exception $e){
                    return redirect('/')->with('error', $e->getMessage());            
                }
            }else{
                return back()->with('error', 'Incorrect Username and Password Combination');
            }
        }catch(Exception $e){
            return redirect('/')->with('error', $e->getMessage());
        }
    }


    public function logout(Request $request)
    {   
        $user_id = Auth::user()->id;
        $user = loginRecords::where('user_id', $user_id)->orderby('id', 'desc')->first();
            
            try{
                
                loginRecords::where('id', $user->id)->update([
                    'time_logout' => date("Y-m-d H:i:s"),
                ]);
                
                Auth::guard('web')->logout();
                return redirect()->route('front');

            }catch(Expection $e){
                return back()->with(['error' => 'Please try again later! ('.$e.')']);
            }
    }
}
