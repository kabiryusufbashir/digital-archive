<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Category;
use App\Models\Document;
use App\Models\Documentimage;
use App\Models\ActivityOnDocument;

class DocumentController extends Controller
{
    public function addDocument(){
        $categories = Category::orderby('name', 'asc')->get();
        return view('dashboard.add_document', compact('categories'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'hospital_code' => ['required'],
            'hcp_state' => ['required'],
            'no_of_claims' => ['required'],
            'category' => ['required'],
            'billing_month' => ['required'],
            'received_date' => ['required'],
            'amount_billed' => ['required'],
            'amount_paid' => ['required'],
            'status' => ['required'],
            'doc_path.*' => ['required', 'mimes:pdf,doc,docx,txt,jpeg,jpg,png,'],
        ]);

        $name = $data['name'];
        $upload_by = Auth::user()->name;

        $check = Document::where('name', $name)->get();
        
        if(count($check) == 0){
            try{
                $document = new Document([
                    'name' => $data['name'],
                    'hospital_code' => $data['hospital_code'],
                    'hcp_state' => $data['hcp_state'],
                    'no_of_claims' => $data['no_of_claims'],
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
        $documents = Document::orderby('created_at', 'desc')->paginate(15);
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
            'hospital_code' => ['required'],
            'hcp_state' => ['required'],
            'no_of_claims' => ['required'],
            'status' => ['required'],
            'category' => ['required'],
        ]);

        $name = $data['name'];
        $status = $data['status'];
        $hospital_code = $data['hospital_code'];
        $hcp_state = $data['hcp_state'];
        $no_of_claims = $data['no_of_claims'];
        $category = $data['category'];
        $upload_by = Auth::user()->id;

        $old_name = $request->old_name;
        $old_hospital_code = $request->old_hospital_code;
        $old_hcp_state = $request->old_hcp_state;
        $old_no_of_claims = $request->old_no_of_claims;
        $old_status = $request->old_status;
        $old_category = $request->old_category;

        $activity_on_document = '
            Former name: '.$old_name.',
            new name: '.$name.',
            Former Hospital Code: '.$old_hospital_code.', 
            new Hosiptal Code: '.$hospital_code.',
            Former HCP State: '.$old_hcp_state.', 
            new HCP state: '.$hcp_state.',
            Former No of Claims: '.$old_no_of_claims.', 
            No of Claims: '.$no_of_claims.',
            Former status: '.$old_status.',
            new status '.$status.', 
            Former Category: '.$old_category.', 
            New Category: '.$category;

        
        try{
            Document::where('id', $id)->update([
                'name' => $data['name'],
                'hospital_code' => $data['hospital_code'],
                'hcp_state' => $data['hcp_state'],
                'no_of_claims' => $data['no_of_claims'],
                'status' => $data['status'],
                'category_id' => $data['category'],
            ]);

            try{
                $stamp = new ActivityOnDocument([
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

    }
}
