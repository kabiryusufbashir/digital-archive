<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Document;

class DocumentController extends Controller
{
    public function addDocument(){
        $categories = Category::orderby('name', 'asc')->get();
        return view('dashboard.add_document', compact('categories'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'status' => ['required'],
        ]);

        $name = $data['name'];

        $check = Document::where('name', $name)->get();
        
        if(count($check) == 0){
            try{
                Document::create([
                    'name' => $data['name'],
                    'status' => $data['status'],
                ]);
    
                return redirect()->route('documents')->with('success', $data['name'].' added'); 
                
            }catch(Expection $e){
                return back()->with(['error' => 'Please try again later! ('.$e.')']);
            }
        }else{
            return back()->with(['error' => $name. ' already exists']);
        }

    }

    public function documents(){
        $documents = Document::orderby('name', 'asc')->paginate(15);
        return view('dashboard.documents', compact('documents'));
    }

    public function delete($id){
        try{
            Document::where('id', $id)->update([
                'status' => 'Not Active',
            ]);
            return redirect()->route('documents')->with('success', 'Document Deleted');
        }catch(Exception $e){
            return redirect()->route('documents')->with('error', 'Please try again... '.$e);
        }
    }

    public function edit($id){
        $document = Document::findOrFail($id);
        return view('dashboard.edit.document', compact('document'));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => ['required'],
            'status' => ['required'],
        ]);

        $name = $data['name'];
        $status = $data['status'];

        $check = Document::where('name', $name)->where('status', $status)->get();
        
        if(count($check) == 0){
            try{
                Document::where('id', $id)->update([
                    'name' => $data['name'],
                    'status' => $data['status'],
                ]);
                return redirect()->route('documents')->with('success', 'Document Updated');
            }catch(Exception $e){
                return back()->with('error', 'Please try again... '.$e);
            }
        }else{
            return back()->with('error', $name.' already exists...');
        }

    }
}
