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

    public function delete($id){
        try{
            Category::where('id', $id)->update([
                'status' => 'Not Active',
            ]);
            return redirect()->route('categories')->with('success', 'Manifest Deleted');
        }catch(Exception $e){
            return redirect()->route('categories')->with('error', 'Please try again... '.$e);
        }
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('dashboard.edit.category', compact('category'));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => ['required'],
            'status' => ['required'],
        ]);

        $name = $data['name'];
        $status = $data['status'];

        $check = Category::where('name', $name)->where('status', $status)->get();
        
        if(count($check) == 0){
            try{
                Category::where('id', $id)->update([
                    'name' => $data['name'],
                    'status' => $data['status'],
                ]);
                return redirect()->route('categories')->with('success', 'Manifest Updated');
            }catch(Exception $e){
                return back()->with('error', 'Please try again... '.$e);
            }
        }else{
            return back()->with('error', $name.' already exists...');
        }

    }
}
