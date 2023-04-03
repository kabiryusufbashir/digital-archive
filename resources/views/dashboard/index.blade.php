@extends('layouts.template')

@section('page-title')
    <title>Dashboard - Digital Archive</title>
@endsection

@section('page-section')
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
            <a href="#">
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
            <a href="#">
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