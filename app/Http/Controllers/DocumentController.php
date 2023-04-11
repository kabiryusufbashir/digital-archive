<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Category;
use App\Models\Document;
use App\Models\Documentimage;
use App\Models\Activityondocument;

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
            'billing_month' => ['required'],
            'received_date' => ['required'],
            'amount_billed' => ['required'],
            'amount_paid' => ['required'],
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
                    'billing_month' => $data['billing_month'],
                    'received_date' => $data['received_date'],
                    'amount_billed' => $data['amount_billed'],
                    'amount_paid' => $data['amount_paid'],
                    'status' => $data['status'],
                    'user_id' => $upload_by,
                ]);

                $document->save();
                $doc_id = $document->id;
                
                try{
                    // Upload Document Content 
                    foreach ($request->file('doc_path') as $file) {
                        $path = '/assets/documents/'.time().str_replace(' ', '', $file->getClientOriginalName());
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

    public function search(Request $request)
    {

        $res = Document::where("name","LIKE","%{$request->term}%")->get();
        
        if(count($res) > 0){
            return response()->json($res);
        }else{
            $jsonString = '{"name": "Document Not Found"}';
            $data = json_decode($jsonString, true);
            return response()->json($data);
        }

    
    }

    public function searchDocument(Request $request)
    {
        $doc = $request->name;
        
        $check_doc = Document::where('name', $doc)->first();

        if(!empty($check_doc)){
            // dd($check_doc->id);
            return redirect()->route('document-show', $check_doc->id);
        }else{
            return back()->with('error', ' Document not Found');
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
        $categories = Category::orderby('name', 'asc')->get();
        return view('dashboard.edit.document', compact('document', 'categories'));
    }

    public function show($id){
        $document = Document::findOrFail($id);
        $document_contents = Documentimage::where('document_id', $id)->get();
        return view('dashboard.show.document', compact('document', 'document_contents'));
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
        $upload_by = Auth::user()->id;

        $old_name = $request->old_name;
        $old_status = $request->old_status;
        $old_category = $request->old_category;

        $activity_on_document = 'Former name: '.$old_name.', new name: '.$name.'. Former status: '.$old_status.', new status '.$status.' Former Category: '.$old_category.', New Category: '.$category;

        $check = Document::where('name', $name)->where('status', $status)->get();
        
        if(count($check) == 0){
            try{
                Document::where('id', $id)->update([
                    'name' => $data['name'],
                    'status' => $data['status'],
                    'category_id' => $data['category'],
                ]);

                try{
                    $stamp = new Activityondocument([
                        'user_id' => $upload_by,
                        'document_id' => $id,
                        'activity_carried' => $activity_on_document,
                    ]);
    
                    $stamp->save();

                    return redirect()->route('documents')->with('success', 'Document Updated');
                }catch(Exception $e){
                    return back()->with('error', 'Please try again... '.$e);
                }

            }catch(Exception $e){
                return back()->with('error', 'Please try again... '.$e);
            }
        }else{
            return back()->with('error', $name.' already exists...');
        }

    }
}
