@extends('layouts.template')

@section('page-title')
    <title>User - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Add Form  -->
    <div class="w-1/2 bg-white p-6 rounded-lg">
        
        <div class="pb-3 px-24">
            <h2 class="text-center text-2xl">Change Password</h2>
        </div>
        <div class="text-lg text-black">
            @include('layouts.messages')
        </div>
        <form action="{{ route('change-password') }}" method="POST" class="px-6 lg:px-8 py-8">
            @csrf
            <div>
                <label for="password" class="font-medium">Old Password</label><br>
                <input type="password" name="old_password" placeholder="Password" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                @error('password')
                    {{$message}}
                @enderror
            </div>     
            <div class="my-2">
                <label for="new_password" class="font-medium">New Password</label><br>
                <input type="password" name="new_password" placeholder="Password" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                @error('new_password')
                    {{$message}}
                @enderror
            </div>
            <div class="my-2">
                <label for="new_password_confirmation" class="font-medium">Confirm Password</label><br>
                <input type="password" name="new_password_confirmation" placeholder="Password" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                @error('new_password_confirmation')
                    {{$message}}
                @enderror
            </div>
            <div class="text-center my-4">
                <button class="mx-auto bg-green-800 rounded w-full py-3 text-white tracking-wider">UPDATE PASSWORD</button>
            </div>
        </form>
    </div>
@endsection