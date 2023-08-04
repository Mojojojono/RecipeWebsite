<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FlavorFiesta</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
      
        @vite(['resources/css/app.css', 'resources/js/app.js'])


    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
{{-- Favourite --}}
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    </head>
    <body class="antialiased flex flex-col min-h-screen">

        <div class="bg-white shadow-md" x-data="{ isOpen: false }">
            <nav class="container px-6  mx-auto md:flex md:justify-between md:items-center justify-start">
              <div class="flex items-center justify-between">
                <a class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-yellow-400 to-red-800 md:text-2xl hover:text-green-400"
                  href="#">
                  FlavorFiesta
                </a>
                <!-- Mobile menu button -->
                <div @click="isOpen = !isOpen" class="flex md:hidden">
                  <button type="button" class="text-gray-800 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                    aria-label="toggle menu">
                    <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                      <path fill-rule="evenodd"
                        d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                      </path>
                    </svg>
                  </button>
                </div>
              </div>
      
              <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
              
              <div :class="isOpen ? 'flex' : 'hidden'" class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0 ">
                <a href="{{ Auth::check() ? route('dashboard.index') : route('welcome.index') }}" class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-yellow-400 to-red-600 hover:text-green-400" href="#">Home</a>

                @foreach ( $categories as $category )
                <a href="{{ route('categorydetails', ['id' => $category->id]) }}" class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-yellow-400 to-red-600 hover:text-green-400">{{$category->name}}</a>
                @endforeach
                <a href="{{ route('aboutus.index') }}" class="text-transparent bg-clip-text bg-gradient-to-r from-red-700 via-orange-400 to-red-800 hover:text-green-400">About Us</a>
                
                @if (Route::has('login'))
                <div class=" sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
                  </div>
              </div>
              
            </nav>
          </div>
          <!-- Main Hero Content -->
          <div
            class="container max-w-lg px-4 py-32 mx-auto text-left  bg-center bg-no-repeat bg-cover md:max-w-none md:text-center"
            style="background-image: url('{{ asset('6b652625-da54-452b-ac13-3149ad94f0ed.jpg') }}')">
            <h1
              class="font-mono text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-yellow-400 to-red-600 md:text-center sm:leading-none lg:text-5xl">
              <span class="inline md:block">Welcome To FlavorFiesta Recipes</span>
            </h1>
            <div class="mx-auto mt-2  text-white md:text-center lg:text-lg">
              Want to eat something new but dont know what to eat? Well you are in the right place. Just suggest a name or search from some of our recommended recipes.
            </div>
            </div>
          </div>
          <!-- End Main Hero Content -->
         
            
          
          {{-- <div class="container">
            <h1>Search Example</h1>
            <form id="searchForm">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form> --}}
            
          

            
            <div class="flex justify-end mr-4">
              <form class="flex items-center" id="searchForm">
                <label for="searchInput" class="sr-only">Search</label>
                <div class="relative mt-5">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                  </div>
                  <input type="text" id="searchInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search" required>
                </div>
                <button type="submit" class="p-2.5 ml-2 mt-5 text-sm font-medium text-white rounded-lg border bg-gradient-to-r from-red-600 via-yellow-400 to-red-600  focus:ring-4 focus:outline-none focus:ring-blue-300">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
                  <span class="sr-only">Search</span>
                </button>
              </form>
            </div>
            
            


            <div class="mt-4 text-center text-slate-700">
              <h3 id="our-menu" class="text-3xl  font-extrabold">Our Recipes</h3>
              
            </div>

            
      <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6" id="results">
          @if(isset($recipes) && count($recipes) > 0)
                @foreach($recipes as $recipe)
                <div class="max-w-xs mx-4 mb-2 rounded-lg hover:shadow-lg">
                    <a href="{{ route('recipedetails.index', ['id' => $recipe->id]) }}">
                        <img class="w-full h-48" src="{{ asset('cover/' . $recipe->cover) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <div class="flex mb-2">
                                <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">
                                    @foreach ($recipe->category as $category)
                                    {{ $category->name }}
                                    @endforeach
                                </span>
                            </div>
                            <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">{{$recipe->title}}</h4>
                            <p class="leading-normal text-gray-700">{{$recipe->Description}}</p>
                        </div>
                        <div class="flex items-center justify-between p-4">
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <div class="text-center">
                    <p>No results found.</p>
                </div>
            @endif
        </div>
    </div>
            {{ $recipes->links() }}
      
       
          <footer class=" mt-auto bg-gradient-to-r from-red-600 via-yellow-500 to-red-800 " >
            <div class="container flex flex-wrap items-center justify-center px-4 py-8 mx-auto lg:justify-between">
              <div class="flex flex-wrap justify-center">
                <ul class="flex items-center space-x-4 text-white">
                  <li style="border-bottom: 1px solid white "> <a href="#"> Home</a> </li>
                  <li style="border-bottom: 1px solid white "> <a href="#"> About</a> </li>
                  <li style="border-bottom: 1px solid white "> <a href="#"> Contact</a> </li>
                  <li style="border-bottom: 1px solid white "> <a href="#"> Terms</a> </li>
                </ul>
              </div>
              <div class="flex justify-center mt-4 lg:mt-0">
                <a target=onblock href="https://www.facebook.com/">
                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-6 h-6 text-blue-600" viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                  </svg>
                </a>
                <a target=onblock href="https://twitter.com/" class="ml-3">
                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-6 h-6 text-blue-300" viewBox="0 0 24 24">
                    <path
                      d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                    </path>
                  </svg>
                </a>
                <a target=onblock href="https://www.instagram.com/" class="ml-3">
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-6 h-6 text-pink-400" viewBox="0 0 24 24">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                  </svg>
                </a>
                <a target=onblock href="https://www.linkedin.com/" class="ml-3">
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="0" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24">
                    <path stroke="none"
                      d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                    <circle cx="4" cy="4" r="2" stroke="none"></circle>
                  </svg>
                </a>
              </div>
            </div>
          </footer>


         
          <script>
            $(document).ready(function() {
                $('#searchInput').keyup(function() {
                    var searchTerm = $(this).val();
        
                    $.ajax({
                        url: "{{ route('welcome.index') }}",
                        type: 'GET',
                        data: {term: searchTerm},
                        dataType: 'html',
                        success: function(response) {
                            var $response = $(response).find('#results').html();
                            $('#results').html($response);
                        }
                    });
                });
            });
        </script>
            
    </body>
</html>


{{-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var favoriteButtons = document.querySelectorAll('.favoriteButton');
    for (var i = 0; i < favoriteButtons.length; i++) {
      favoriteButtons[i].addEventListener('click', function(event) {
        event.stopPropagation(); // Stop the event from propagating to the parent <a> tag

        var button = event.target;
        var isFavorite = button.classList.contains('favorite');
        var recipeId = button.getAttribute('data-recipe-id');
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send an AJAX request to the backend to toggle the recipe's favorite status
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route('favorite') }}');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-CSRF-Token', token);
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              if (isFavorite) {
                button.classList.remove('favorite');
                button.textContent = 'Add to Favorites';
              } else {
                button.classList.add('favorite');
                button.textContent = 'Remove from Favorites';
              }
              alert(JSON.parse(xhr.responseText).message);
            } else {
              console.error(xhr.statusText);
            }
          }
        };
        xhr.send('recipeId=' + encodeURIComponent(recipeId));
      });
    }
  });
</script> --}}