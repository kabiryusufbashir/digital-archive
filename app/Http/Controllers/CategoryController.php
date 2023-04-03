<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('dashboard.add_category');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'status' => ['required'],
        ]);

        $name = $data['name'];

        $check = Category::where('name', $name)->get();
        
        if(count($check) == 0){
            try{
                Category::create([
                    'name' => $data['name'],
                    'status' => $data['status'],
                ]);
    
                return redirect()->route('categories')->with('success', $data['name'].' added'); 
                
            }catch(Expection $e){
                return back()->with(['error' => 'Please try again later! ('.$e.')']);
            }
        }else{
            return back()->with(['error' => $name. ' already exists']);
        }

    }


    public function categories(){
        $categories = Category::orderby('name', 'asc')->paginate(15);
        return view('dashboard.categories', compact('categories'));
    }
}
