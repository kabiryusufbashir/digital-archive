<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Category;
use App\Models\Document;
use App\Models\User;

use DB;
use App\Charts\DocumentChart;

class DashboardController extends Controller
{
    public function index(){
        $category_count = Category::count();
        $document_count = Document::count();
        $user_count = User::count();

        $user_id = Auth::user()->name;
        $user_upload_count = Document::where('user_id', $user_id)->count();

        $dataset = DB::table('documents')
            ->select('documents.user_id', \DB::raw("COUNT(user_id) as total"))
            ->groupBy('documents.user_id')
            ->get();
        
        $chart = new DocumentChart;
        $chart->labels($dataset->pluck('user_id'));
        $chart->dataset('Documents Upload Chart', 'bar', $dataset->pluck('total'))->options(['backgroundColor' => 'green']);

        return view('dashboard.index', compact('category_count', 'document_count', 'user_count', 'user_upload_count', 'chart'));
    }

    public function password(){
        return view('dashboard.password');
    }

    public function passwordChange(Request $request){
        $data = $request->validate([
            'old_password' => ['required'],
            'new_password' => 'required|confirmed',
        ]);

        $user_id = Auth::user()->id;
        $user_password = Auth::user()->password;

        try{
            if(Hash::check($request->old_password, $user_password)){
                
                $new_password = Hash::make($request->new_password);
                
                $password = User::where('id', $user_id)->update([
                    'password'=> $new_password
                ]);

                return redirect()->route('dashboard')->with('success', 'Password Changed Successfully');
            }else{
                return redirect()->route('dashboard')->with('error', 'Old Password Doesn\'t Match!');
            }
        }catch(Exception $e){
            return redirect()->route('dashboard')->with('error', 'Please try again... '.$e);
        }
    }
}
