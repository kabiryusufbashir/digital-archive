@extends('layouts.template')

@section('page-title')
    <title>Category - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Add Form  -->
    <div class="w-1/2 bg-white p-6 rounded-lg">
        
        <div class="pb-3 px-24">
            <h2 class="text-center text-2xl">Update {{ $category->name }}</h2>
        </div>
        <div class="text-lg text-black">
            @include('layouts.messages')
        </div>
        <form action="{{ route('category-update', $category->id) }}" method="POST" class="px-6 lg:px-8 py-8">
            @csrf
            @method('PATCH')
            <div>
                <label for="name" class="text-lg font-medium">Category Name</label><br>
                <input type="text" name="name" value="{{ $category->name }}" placeholder="Category Name" class="border-gray-300 rounded py-4 px-6 w-full my-2 border-2 border-b focus:outline-none">
                @error('name')
                {{$message}}
                @enderror
            </div>     
            <div>
                <label for="status" class="text-lg font-medium">Category Status</label><br>
                <select type="text" name="status" value="{{old('status')}}" class="border-gray-300 rounded py-4 px-6 w-full my-2 border-2 border-b focus:outline-none">
                    @if($category->status == 'Active')
                        <option value="Active">Active</option>
                        <option value="Not Active">Not Active</option>
                    @else
                        <option value="Active">Active</option>
                        <option value="Not Active">Not Active</option>
                    @endif    
                </select>
                @error('status')
                {{$message}}
                @enderror
            </div>     
            <div class="text-center">
                <button class="mx-auto bg-green-800 rounded w-full py-3 text-white tracking-wider">Update Category</button>
            </div>
        </form>
    </div>
@endsection