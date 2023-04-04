@extends('layouts.template')

@section('page-title')
    <title>Dashboard - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Search Box  -->
    <div>
        <form action="" class="my-1 flex w-1/2 ml-auto">
            <input type="text" class="form-control py-3 px-10 rounded-tl-full rounded-bl-full" name="search_document" placeholder="Search Document" id="search_document">
            <input type="submit" class="mx-auto bg-green-800 py-2 px-3 text-white tracking-wider" value="Search" name="search_document_submit" id="search_document">
        </form>
    </div>
    <!-- App Stats -->
    <div class="grid grid-cols-3 gap-4 py-6 rounded-lg text-center">
        <div class="bg-white py-7 px-6 mr-4 text-gray-600 rounded">
            <a href="{{ route('categories') }}">
                <div class="flex py-2 items-center">
                    <span class="mr-4">
                        <div class="bg-yellow-300 p-2 rounded-full">
                            <i class="text-black fas fa-building text-xl"></i>
                        </div>
                    </span>
                    <span class="text-sm">
                        <div class="font-semibold mb-1">Categories</div>
                        <div>
                            {{ $category_count }}
                        </div>
                    </span>
                </div>
            </a>
        </div>
        <div class="bg-white py-7 px-6 mr-4 text-gray-600 rounded">
            <a href="{{ route('documents') }}">
                <div class="flex py-2 items-center">
                    <span class="mr-4">
                        <div class="bg-yellow-300 p-2 rounded-full">
                            <i class="text-black fas fa-folder text-xl"></i>
                        </div>
                    </span>
                    <span class="text-sm">
                        <div class="font-semibold mb-1">Documents</div>
                        <div>
                            {{ $document_count }}
                        </div>
                    </span>
                </div>
            </a>
        </div>
        <div class="bg-white py-7 px-6 mr-4 text-gray-600 rounded">
            <a href="{{ route('users') }}">
                <div class="flex py-2 items-center">
                    <span class="mr-4">
                        <div class="bg-yellow-300 p-2 rounded-full">
                            <i class="text-black fas fa-users text-xl"></i>
                        </div>
                    </span>
                    <span class="text-sm">
                        <div class="font-semibold mb-1">Users</div>
                        <div>
                            {{ $user_count }}
                        </div>
                    </span>
                </div>
            </a>
        </div>
    </div>
@endsection 