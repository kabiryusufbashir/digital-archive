<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @yield('page-title')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/production.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <script type="text/javascript">
            var siteUrl = "{{url('/')}}";
        </script>

        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-200">
        <div id="appContainer">
            <!-- Nav  -->
            <div id="appNav" class="bg-white">
                <!-- App title  -->
                <div class="text-xl text-center py-12">
                    <div>
                        <img class="w-1/3 mx-auto py-2" src="{{ asset('images/logo.png') }}" alt="Company Logo">
                    </div>
                    <div>
                        Digital Archive
                    </div>
                </div>
                <hr>
                <!-- Nav Links  -->
                <div id="nav" class="bg-white  text-black w-full">
                    <!-- Home  -->
                    <div id="homeNav" class="py-4 border-b cursor-pointer flex justify-between px-6">
                        <a class="flex justify-between w-full" href="{{ route('dashboard') }}">
                            <div>Home</div>
                            <div><i class="text-black  fas fa-home"></i></div>
                        </a>
                    </div>
                    
                    @if(Auth::user()->category == 'Admin')
                        <!-- Category  -->
                        <div id="categoryNav" class="py-4 border-b cursor-pointer flex justify-between px-6">
                            <div>Manifest</div>
                            <div><i class="text-black  fas fa-building"></i></div>
                        </div>
                        <div id="categoryBody" class="hidden ml-4">
                            <a href="{{ route('add-categories') }}">
                                <div class="py-4 border-b cursor-pointer flex justify-between px-6">
                                    <div>Add Manifest</div>
                                </div>
                            </a>
                            <a href="{{ route('categories') }}">
                                <div class="py-4 border-b cursor-pointer flex justify-between px-6">
                                    <div>All Manifests</div>
                                </div>
                            </a>
                        </div>
                        <!-- End of Category  -->

                        <!-- Document  -->
                        <div id="docNav" class="py-4 border-b cursor-pointer flex justify-between px-6">
                            <div>Document</div>
                            <div><i class="text-black fas fa-folder"></i></div>
                        </div>
                        <div id="docBody" class="hidden ml-4">
                            <a href="{{ route('add-document') }}">
                                <div class="py-4 border-b cursor-pointer flex justify-between px-6">
                                    <div>Upload Document</div>
                                </div>
                            </a>
                            <a href="{{ route('documents') }}">
                                <div class="py-4 border-b cursor-pointer flex justify-between px-6">
                                    <div>All Documents</div>
                                </div>
                            </a>
                        </div>
                        <!-- End of Document  -->

                        <!-- User  -->
                        <div id="userNav" class="py-4 border-b cursor-pointer flex justify-between px-6">
                            <div>Users</div>
                            <div><i class="text-black  fas fa-users"></i></div>
                        </div>
                        <div id="userBody" class="hidden ml-4">
                            
                            <a href="{{ route('add-user') }}">
                                <div class="py-4 border-b cursor-pointer flex justify-between px-6">
                                    <div>Add User</div>
                                </div>
                            </a>

                            <a href="{{ route('users') }}">
                                <div class="py-4 border-b cursor-pointer flex justify-between px-6">
                                    <div>Users</div>
                                </div>
                            </a>
                        </div>
                        <!-- End of User  -->
                    @else
                    <!-- Document  -->
                    <div id="docNav" class="py-4 border-b cursor-pointer flex justify-between px-6">
                        <a class="flex justify-between w-full" href="{{ route('add-document') }}">
                            <div>Upload Document</div>
                            <div><i class="text-black fas fa-folder"></i></div>
                        </a>
                    </div>
                    @endif
                    <!-- Change Password  -->
                    <div id="docNav" class="py-4 border-b cursor-pointer flex justify-between px-6">
                        <a class="flex justify-between w-full" href="{{ route('password') }}">
                            <div>Change Password</div>
                            <div><i class="text-black fas fa-lock"></i></div>
                        </a>
                    </div>
                    <!-- Logout  -->
                    <div class="py-4 border-b cursor-pointer px-6">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex justify-between w-full">
                                <div>Logout</div>
                                <div><i class="text-black  fas fa-sign-out-alt"></i></div>
                            </button>
                        </form> 
                    </div>
                    <!-- End of Profile  -->
                </div>
            </div>
            <!-- Menu  -->
            <div id="appMenu">
                <!-- Search Box  -->
                <div class="text-lg text-black">
                    @include('layouts.messages')
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <!-- User Info  -->
                    <div class="my-auto">
                        Welcome, <b>{{ Auth::user()->name }}</b>
                    </div>
                    <!-- Search Box  -->
                    <div class="mb-6">
                        <form name="autocomplete-textbox" id="autocomplete-textbox" method="post" action="{{ route('search') }}" class="my-1 flex ml-auto" style="margin-right: 1%;">
                            @csrf
                            <input id="name" name="name" type="text" class="form-control py-3 px-3" placeholder="Search Document">
                            <input type="submit" class="mx-auto bg-green-800 py-2 px-3 text-white tracking-wider" value="Search" name="search_document_submit" id="search">
                        </form>
                    </div>
                </div>
                @yield('page-section')
            </div>
        </div>

        <script>
            //category Module
            let categoryNav = document.querySelector('#categoryNav')
            let categoryBody = document.querySelector('#categoryBody')
                // category Nav 
                categoryNav.addEventListener('click', ()=>{
                    if(categoryBody.classList.contains('hidden')){
                        categoryBody.classList.remove('hidden')
                    }else{
                        categoryBody.classList.add('hidden')
                    }
                })
            //End of category
            
            //User Module
            let userNav = document.querySelector('#userNav')
            let userBody = document.querySelector('#userBody')
                // user Nav 
                userNav.addEventListener('click', ()=>{
                    if(userBody.classList.contains('hidden')){
                        userBody.classList.remove('hidden')
                    }else{
                        userBody.classList.add('hidden')
                    }
                })
            //End of User
            
            //Document Module
            let docNav = document.querySelector('#docNav')
            let docBody = document.querySelector('#docBody')
                // Doc Nav 
                docNav.addEventListener('click', ()=>{
                    if(docBody.classList.contains('hidden')){
                        docBody.classList.remove('hidden')
                    }else{
                        docBody.classList.add('hidden')
                    }
                })
            //End of Document

        </script>
        <script>
            $(document).ready(function() {

                $("#name").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: siteUrl + '/' +"autocomplete",
                            data: {
                                term : request.term
                            },
                            dataType: "json",
                                success: function(data){
                                    if (data.length > 0) {
                                        var resp = $.map(data, function(obj){
                                            return obj.name;
                                        });
                                        response(resp);
                                    }else{
                                        response(['No Document Found']);
                                    }
                                console.log(data)
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        $('#name').val(ui.item.label);
                        return false;
                    }
                });
            });
        </script>
    </body>
</html>
