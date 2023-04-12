@extends('layouts.template')

@section('page-title')
    <title>User - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Add Form  -->
    <div class="w-1/2 bg-white p-6 rounded-lg">
        
        <div class="pb-3 px-24">
            <h2 class="text-center text-2xl">Add User</h2>
        </div>
        <div class="text-lg text-black">
            @include('layouts.messages')
        </div>
        <form action="{{ route('add-user') }}" method="POST" class="px-6 lg:px-8 py-2">
            @csrf
            <div>
                <label for="name" class="text-lg font-medium">Name</label><br>
                <input type="text" name="name" value="{{old('name')}}" placeholder="Username" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                @error('name')
                {{$message}}
                @enderror
            </div>     
            <div>
                <label for="password" class="text-lg font-medium">Password</label><br>
                <input type="password" name="password" value="{{old('password')}}" placeholder="Password" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                @error('password')
                {{$message}}
                @enderror
            </div>     
            <div>
                <label for="status" class="text-lg font-medium">Category</label><br>
                <select type="text" name="category" value="{{old('category')}}" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                    <option></option>
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
                @error('status')
                {{$message}}
                @enderror
            </div>     
            <div>
                <label for="status" class="text-lg font-medium">Status</label><br>
                <select type="text" name="status" value="{{old('status')}}" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                    <option></option>
                    <option value="Active">Active</option>
                    <option value="Not Active">Not Active</option>
                </select>
                @error('status')
                {{$message}}
                @enderror
            </div>     
            <div class="text-center">
                <button class="mx-auto bg-green-800 rounded w-full py-3 text-white tracking-wider">Add User</button>
            </div>
        </form>
    </div>
@endsection