<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Digital Archive - Login</title>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        @vite('resources/css/app.css')
    </head>
    <body>
        <div id="loginContainer">
            <!-- Login Div  -->
            <div class="sm:w-1/3 sm:mx-auto relative top-24 py-24 px-5 bg-white rounded shadow-md">
                
                <div class="pb-3 px-24">
                    <h2 class="border-b border-green-400 text-center text-2xl mb-4">Digital Archive</h2>
                </div>
                <div class="text-lg text-black">
                    @include('layouts.messages')
                </div>
                <div class="px-6">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="my-2">
                            <input type="text" name="username" placeholder="Username" class="border-gray-300 rounded py-4 px-6 w-full my-2 border-2 border-b focus:outline-none @error('username')  @enderror" autofocus>
                            @error('username')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="my-2">
                            <input type="password" name="password" placeholder="Password" class="border-gray-300 rounded py-4 px-6 w-full my-2 border-2 border-b focus:outline-none @error('password')  @enderror">
                            @error('password')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="text-right mb-4">
                            <span><a href="#" class="hover:text-blue-600 hover:underline">Forgot your Password?</a></span>
                        </div>
                        <div class="text-center">
                            <button class="text-lg mx-auto bg-green-800 rounded-full w-full py-3 text-white tracking-wider">LOGIN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
