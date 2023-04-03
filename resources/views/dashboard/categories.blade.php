@extends('layouts.template')

@section('page-title')
    <title>Category - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Categories  -->
    <div class="w-full bg-white p-6">
        @if(count($categories) > 0)
            <div class="pb-3 px-24">
                <h2 class="text-center text-2xl">All Categories</h2>
            </div>
            <div class="my-2">
                <table class="w-full">
                    <thead class="border-b">
                        <!-- Main Columns  -->
                        <tr class="text-left whitespace-nowrap">
                            <th>Category</th>
                            @if(Auth::user()->category == 1)
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data  -->
                        @foreach($categories as $item)
                            <tr class="text-left">
                                <td>
                                    {{ $item->name }}
                                </td>
                                @if(Auth::user()->category == 1)
                                    <!-- Action  -->
                                    <td class="flex px-2">
                                        <form action="{{ route('category-edit', $item->id) }}">
                                            @csrf 
                                            <button class="relative top-2">
                                                <span><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg></span>
                                            </button>
                                        </form>
                                        &nbsp;&nbsp;
                                        <form action="{{ route('category-delete', $item->id) }}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="relative top-2">
                                                <span><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg></span>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-2xl">
                No Category Found <a style="color: blue;" href="{{ route('add-categories') }}">Click here to Add a category</a>
            </div>
        @endif
        <div>
            {{ $categories->links() }}
        </div>
    </div>
@endsection