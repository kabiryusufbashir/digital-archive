@extends('layouts.template')

@section('page-title')
    <title>Archive - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Documents  -->
    <div class="w-full p-6 rounded-lg">
        <div class="py-3 px-24 bg-white mb-4">
            <h2 class="text-center text-2xl py-2">{{ $document->name}} </h2>
            <div class="text-center text-xl py-2 grid grid-cols-3 gap-4">
                <div>
                    Hospital Code: {{ $document->hospital_code }}
                </div>
                <div>
                    HCP State: {{ $document->hcp_state }}
                </div>
                <div>
                    No of Claims: {{ $document->no_of_claims }}
                </div>
                
            </div>
            <h2 class="text-center py-2 text-xl">Total File(s): {{ count($document_contents) }}</h2>
            <h2 class="text-center py-2 text-lg">Upload By: {{ $document->user_id }}</h2>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach($document_contents as $x => $doc)
                <div class="bg-white p-10">
                    <a target="_blank" href="{{ asset($doc->doc_path) }}">{{ $x + 1 }}) {{ $document->name }} (File {{ $x + 1 }})</a> 
                </div>
            @endforeach
        </div>
    </div>
@endsection