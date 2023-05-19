@extends('layouts.template')

@section('page-title')
    <title>Document - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Add Form  -->
    <div class="w-1/2 bg-white p-6 rounded-lg">
        
        <div class="pb-3 px-24">
            <h2 class="text-center text-2xl">Update {{ $document->name }}</h2>
        </div>
        <div class="text-lg text-black">
            @include('layouts.messages')
        </div>
        <form action="{{ route('document-update', $document->id) }}" method="POST" class="px-6 lg:px-8 py-8">
            @csrf
            @method('PATCH')
            <div>
                <label for="name">Name</label><br>
                <input type="text" name="name" value="{{ $document->name }}" placeholder="Document Name" class="border-gray-300 rounded py-2 px-6 w-full my-2 border-2 border-b focus:outline-none">
                @error('name')
                {{$message}}
                @enderror
            </div>     
            <div>
                <label for="category">Category</label><br>
                <select name="category" value="{{old('category')}}" class="border-gray-300 rounded py-2 px-6 w-full my-2 border-2 border-b focus:outline-none">
                    <option value="{{ $document->category_id }}">{{ $document->docCategory($document->category_id) }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach    
                </select>
                @error('status')
                {{$message}}
                @enderror
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="hospital_code">Hospital Code</label><br>
                    <input type="text" name="hospital_code" value="{{ $document->hospital_code }}" placeholder="Hospital Code" class="border-gray-300 rounded py-2 px-6 w-full my-2 border-2 border-b focus:outline-none">
                    @error('hospital_code')
                    {{$message}}
                    @enderror
                </div>
                <div>
                    <label for="hcp_state">HCP State</label><br>
                    <input type="text" name="hcp_state" value="{{ $document->hcp_state }}" placeholder="HCP State" class="border-gray-300 rounded py-2 px-6 w-full my-2 border-2 border-b focus:outline-none">
                    @error('hcp_state')
                    {{$message}}
                    @enderror
                </div>
                <div>
                    <label for="no_of_claims">No of Claims</label><br>
                    <input type="text" name="no_of_claims" value="{{ $document->no_of_claims }}" placeholder="No of Claims" class="border-gray-300 rounded py-2 px-6 w-full my-2 border-2 border-b focus:outline-none">
                    @error('no_of_claims')
                    {{$message}}
                    @enderror
                </div>
            </div>     
            <div>
                <label for="status">Status</label><br>
                <select type="text" name="status" value="{{old('status')}}" class="border-gray-300 rounded py-2 px-6 w-full my-2 border-2 border-b focus:outline-none">
                    @if($document->status == 'Active')
                        <option value="Active">Active</option>
                        <option value="Not Active">Not Active</option>
                    @else
                        <option value="Not Active">Not Active</option>
                        <option value="Active">Active</option>
                    @endif    
                </select>
                @error('status')
                {{$message}}
                @enderror
            </div>     
            <input type="text" value="{{ $document->name }}" name="old_name" class="hidden">
            <input type="text" value="{{ $document->status }}" name="old_status" class="hidden">
            <input type="text" value="{{ $document->category_id }}" name="old_category" class="hidden">
            <div class="text-center">
                <button class="mx-auto bg-green-800 rounded w-full py-3 text-white tracking-wider">Update Document</button>
            </div>
        </form>
    </div>
@endsection