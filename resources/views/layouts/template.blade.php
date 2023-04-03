<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @yield('page-title')
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-200">
        <div id="appContainer">
            <!-- Nav  -->
            <div id="appNav" class="bg-white">
                <!-- App title  -->
                <div class="text-xl text-center py-12">Digital Archive</div>
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
                    
                    <!-- Category  -->
                    <div id="categoryNav" class="py-4 border-b cursor-pointer flex justify-between px-6">
                        <div>Category</div>
                        <div><i class="text-black  fas fa-building"></i></div>
                    </div>
                    <div id="categoryBody" class="hidden ml-4">
                        <a href="{{ route('add-categories') }}">
                            <div class="py-4 border-b cursor-pointer flex justify-between px-6">
                                <div>Add Category</div>
                            </div>
                        </a>
                        <a href="{{ route('categories') }}">
                            <div class="py-4 border-b cursor-pointer flex justify-between px-6">
                                <div>All Categories</div>
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

                    <!-- Logout  -->
                    <div class="py-4 border-b cursor-pointer flex justify-between px-6">
                        <div>Logout</div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex justify-between">
                                <div><i class="text-black  fas fa-sign-out-alt"></i></div>
                            </button>
                        </form> 
                    </div>
                    <!-- End of Profile  -->
                </div>
            </div>
            <!-- Menu  -->
            <div id="appMenu">
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
    </body>
</html>
