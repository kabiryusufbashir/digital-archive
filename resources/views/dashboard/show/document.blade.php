@extends('layouts.template')

@section('page-title')
    <title>Archive - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Documents  -->
    <div class="w-full p-6 rounded-lg">
        <div class="pb-3 px-24">
            <h2 class="text-center text-2xl">{{ $document->name}} </h2>
            <h2 class="text-center text-2xl">Total Files: {{ count($document_contents) }}</h2>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach($document_contents as $x => $doc)
                <div class="bg-white p-10">
                    <a target="_blank" href="{{ asset($doc->doc_path) }}">{{ $x + 1 }}) {{ $document->name }}</a> 
                </div>
            @endforeach
        </div>
    </div>
@endsection