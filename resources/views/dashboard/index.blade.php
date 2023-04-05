@extends('layouts.template')

@section('page-title')
    <title>Dashboard - Digital Archive</title>
@endsection

@section('page-section')
    <!-- Search Box  -->
    <div>
        <form action="" class="my-1 flex w-1/2 ml-auto">
            <input id="search-box" type="text" class="form-control py-3 px-10 rounded-tl-full rounded-bl-full" name="search_document" placeholder="Search Document" id="search_document">
            <input type="submit" class="mx-auto bg-green-800 py-2 px-3 text-white tracking-wider" value="Search" name="search_document_submit" id="search">
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
    <script type="text/javascript">
        var path = "{{ route('search') }}";
        $("#search" ).autocomplete({
            source: function(request,response ) {
            $.ajax({
                url: path,
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    console.log('Yes')
                    response( data );
                }
            });
            },
            select: function (event, ui) {
            $('#search').val(ui.item.label);
            console.log(ui.item); 
            return false;
            }
        });
    
    </script>
    <script>
        // let searchBox = document.getElementById('search-box');
        // let searchResults = document.getElementById('search-results');


        
        // searchBox.addEventListener('keyup', function () {
            
        //     const query = this.value;
            
        //     if(query.length > 2){
        //         $.ajax({
        //             url: `/search?query=${query}`,
        //             method: 'GET',
        //             dataType: 'json'
        //             })
        //             .then(function(data) {
        //                 console.log(data);
        //                 if(data.length > 0){
        //                     data.forEach(doc => {
        //                         const li = document.createElement('li');
        //                         li.innerText = doc.name;
        //                         searchResults.appendChild(li);
        //                     })
        //                 }else{
        //                     searchResults.innerHTML = '';
        //                     const li = document.createElement('li');
        //                     li.innerText = 'Document Not Found';
        //                     searchResults.appendChild(li);
        //                 }
        //             })
        //             .catch(function(error) {
        //                 console.error(error);
        //             });
        //     }    
            
        // });
    </script>
@endsection 