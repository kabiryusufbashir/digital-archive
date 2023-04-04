<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Category;
use App\Models\Document;
use App\Models\Documentimage;

class DocumentController extends Controller
{
    public function addDocument(){
        $categories = Category::orderby('name', 'asc')->get();
        return view('dashboard.add_document', compact('categories'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'category' => ['required'],
            'status' => ['required'],
            'doc_path.*' => ['required', 'mimes:pdf,doc,docx,txt,jpeg,jpg,png,'],
        ]);

        $name = $data['name'];
        $upload_by = Auth::user()->id;

        $check = Document::where('name', $name)->get();
        
        if(count($check) == 0){
            try{
                $document = new Document([
                    'name' => $data['name'],
                    'category_id' => $data['category'],
                    'status' => $data['status'],
                    'user_id' => $upload_by,
                ]);

                $document->save();
                $doc_id = $document->id;
                
                try{
                    // Upload Document Content 
                    foreach ($request->file('doc_path') as $file) {
                        $path = time().str_replace(' ', '', $file->getClientOriginalName());
                        $file->move('assets/documents/', $path);
    
                        // Add to Database 
                        $path_add = new Documentimage;
                        $path_add['document_id'] = $doc_id;
                        $path_add['doc_path'] = $path;
                        $path_add->save();
                    }
                    
                    return back()->with('success', $name.' added'); 
                
                }catch(Exception $e){
                    return back()->with('error', 'Please try again... '.$e);
                }
     
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
