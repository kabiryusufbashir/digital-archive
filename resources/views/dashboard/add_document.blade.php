@extends('layouts.template')

@section('page-title')
    <title>Document - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Add Form  -->
    <div>
        <div class="px-24">
            <h2 class="text-center text-2xl">Upload Document</h2>
        </div>
        <form action="{{ route('add-document') }}" method="POST" class="grid grid-cols-2 gap-4 px-6 lg:px-8 py-4" enctype="multipart/form-data">
            @csrf
            <!-- First Column  -->
            <div class="bg-white p-6 rounded-lg">
                <div>
                    <label for="status">Manifest</label><br>
                    <select type="text" name="category" value="{{old('category')}}" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                        <option></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                    </select>
                    @error('status')
                    {{$message}}
                    @enderror
                </div>
                <div>
                    <label for="name">Name</label><br>
                    <input type="text" name="name" value="{{old('name')}}" placeholder="Document Name" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>     
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="billing_month">Billing Month</label><br>
                        <input type="date" name="billing_month" value="{{old('billing_month')}}" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                        @error('billing_month')
                        {{$message}}
                        @enderror
                    </div>     
                    <div>
                        <label for="received_date">Received Date</label><br>
                        <input type="date" name="received_date" value="{{old('received_date')}}" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                        @error('received_date')
                        {{$message}}
                        @enderror
                    </div>     
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="amount_billed">Amount Billed</label><br>
                        <input type="text" name="amount_billed" value="{{old('amount_billed')}}" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                        @error('amount_billed')
                        {{$message}}
                        @enderror
                    </div>     
                    <div>
                        <label for="amount_paid">Amount Paid</label><br>
                        <input type="text" name="amount_paid" value="{{old('amount_paid')}}" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                        @error('amount_paid')
                        {{$message}}
                        @enderror
                    </div>     
                </div>
                <div>
                    <label for="status">Status</label><br>
                    <select type="text" name="status" value="{{old('status')}}" class="border-gray-300 rounded py-3 px-6 w-full my-2 border-2 border-b focus:outline-none">
                        <option></option>
                        <option value="Active">Active</option>
                        <option value="Not Active">Not Active</option>
                    </select>
                    @error('status')
                    {{$message}}
                    @enderror
                </div>
            </div>
            <!-- Second Column  -->
            <div class="bg-white p-6 rounded-lg">
                <div class="form-group mb-3">
                    <label for="doc">Upload Document</label><br>
                    <input name="doc_path[]" type="file" class="form-control">
                </div>   
                <div id="documentSection" class="my-4"></div>
            
                <div id="addDocument" class="bg-blue-800 text-white p-2 rounded float-right mb-3 text-xs cursor-pointer">Add Document + </div>
                <br><br>
                <div class="text-center">
                    <button class="mx-auto bg-green-800 rounded w-full py-3 text-white tracking-wider">Upload Document</button>
                </div>
            </div>
        </form>
        
        <script>
            let addDocument = document.querySelector('#addDocument')
            let documentSection = document.querySelector('#documentSection')
            const divContent = 
                    '<div class="border-b-2 my-2">'+
                        '<label for="doc">Upload Document</label><br>'+
                        '<input name="doc_path[]" type="file" class="form-control"><div>'+
                    '</div>'

            addDocument.addEventListener('click', ()=>{
                documentSection.insertAdjacentHTML('beforeend', divContent)
            })

        </script>
    </div>
@endsection