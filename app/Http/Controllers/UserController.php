<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    public function addUser(){
        return view('dashboard.add_user');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'category' => ['required'],
            'status' => ['required'],
        ]);

        $name = $data['name'];
        $password = Hash::make('1234567890');

        $check = User::where('name', $name)->get();
        
        if(count($check) == 0){
            try{
                User::create([
                    'name' => $data['name'],
                    'category' => $data['category'],
                    'status' => $data['status'],
                    'password' => $password,
                ]);
    
                return redirect()->route('users')->with('success', $data['name'].' added'); 
                
            }catch(Expection $e){
                return back()->with(['error' => 'Please try again later! ('.$e.')']);
            }
        }else{
            return back()->with(['error' => $name. ' already exists']);
        }

    }

    public function users(){
        $users = User::orderby('name', 'asc')->paginate(15);
        return view('dashboard.users', compact('users'));
    }

    public function delete($id){
        try{
            User::where('id', $id)->update([
                'status' => 'Not Active',
            ]);
            return redirect()->route('users')->with('success', 'User Deleted');
        }catch(Exception $e){
            return redirect()->route('users')->with('error', 'Please try again... '.$e);
        }
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('dashboard.edit.user', compact('user'));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => ['required'],
            'status' => ['required'],
            'category' => ['required'],
        ]);

        $name = $data['name'];
        $status = $data['status'];
        $category = $data['category'];

        $check = User::where('name', $name)->where('status', $status)->get();
        
        if(count($check) == 0){
            try{
                User::where('id', $id)->update([
                    'name' => $data['name'],
                    'status' => $data['status'],
                    'category' => $data['category'],
                ]);
                return redirect()->route('users')->with('success', 'User Updated');
            }catch(Exception $e){
                return back()->with('error', 'Please try again... '.$e);
            }
        }else{
            return back()->with('error', $name.' already exists...');
        }

    }
}
