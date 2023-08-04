<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="bg-white shadow-md fixed top-0 left-0 right-0 z-50  " x-data="{ isOpen: false }">
        <nav class="container px-6 py-8 mx-auto md:flex md:justify-between md:items-center " x-data="{ open: false }" wire:id="oYMiPnZp4Nzbmr9iAsGp">
            
          <div class="flex items-center justify-between">
            <a class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-yellow-400 to-red-600 md:text-3xl hover:text-green-400"
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
          
          <div :class="isOpen ? 'flex' : 'hidden'" class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0 justify-center">
              
              <a  href="{{ Auth::check() ? route('dashboard.index') : route('welcome.index') }}"class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-yellow-400 to-red-600 hover:text-green-400" href="#">Home</a>
              
              
              @can('admin')
              <a href="{{route('userview')}}" class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-yellow-400 to-red-600 hover:text-green-400">Admin</a>
              @endcan
              <a href="{{ route('aboutus.index') }}" class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-yellow-400 to-red-600 hover:text-green-400">About Us</a>
          </div>
  
          <div class="ml-3 relative">
            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <!-- Teams Dropdown -->
              @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                  <div class="ml-3 relative">
                      <x-dropdown align="right" width="60">
                          <x-slot name="trigger">
                              <span class="inline-flex rounded-md">
                                  <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                      {{ Auth::user()->currentTeam->name }}
  
                                      <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                      </svg>
                                  </button>
                              </span>
                          </x-slot>
  
                          <x-slot name="content">
                              <div class="w-60">
                                  <!-- Team Management -->
                                  <div class="block px-4 py-2 text-xs text-gray-400">
                                      {{ __('Manage Team') }}
                                  </div>
  
                                  <!-- Team Settings -->
                                  <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                      {{ __('Team Settings') }}
                                  </x-dropdown-link>
  
                                  @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                      <x-dropdown-link href="{{ route('teams.create') }}">
                                          {{ __('Create New Team') }}
                                      </x-dropdown-link>
                                  @endcan
  
                                  <!-- Team Switcher -->
                                  @if (Auth::user()->allTeams()->count() > 1)
                                      <div class="border-t border-gray-200"></div>
  
                                      <div class="block px-4 py-2 text-xs text-gray-400">
                                          {{ __('Switch Teams') }}
                                      </div>
  
                                      @foreach (Auth::user()->allTeams() as $team)
                                          <x-switchable-team :team="$team" />
                                      @endforeach
                                  @endif
                              </div>
                          </x-slot>
                      </x-dropdown>
                  </div>
              @endif
  
              <!-- Settings Dropdown -->
              <div class="ml-3 relative">
                  <x-dropdown align="right" width="48">
                      <x-slot name="trigger">
                          @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                              <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                  <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                              </button>
                          @else
                              <span class="inline-flex rounded-md">
                                  <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                      {{ Auth::user()->name }}
  
                                      <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                      </svg>
                                  </button>
                              </span>
                          @endif
                      </x-slot>
  
                      <x-slot name="content">
                          <!-- Account Management -->
                          <div class="block px-4 py-2 text-xs text-gray-400">
                              {{ __('Manage Account') }}
                          </div>
  
                          <x-dropdown-link href="{{ route('profile.show') }}">
                              {{ __('Profile') }}
                          </x-dropdown-link>
  
                          @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                              <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                  {{ __('API Tokens') }}
                              </x-dropdown-link>
                          @endif
  
                          <div class="border-t border-gray-200"></div>
  
                          <!-- Authentication -->
                          <form method="POST" action="{{ route('logout') }}" x-data>
                              @csrf
  
                              <x-dropdown-link href="{{ route('logout') }}"
                                       @click.prevent="$root.submit();">
                                  {{ __('Log Out') }}
                              </x-dropdown-link>
                          </form>
                      </x-slot>
                  </x-dropdown>
              </div>
          </div>
  
  
              
        </nav>
      </div>
      <div class="relative overflow-x-auto  mt-28">
    <form method="post" action="{{$url}}" enctype="multipart/form-data">
@csrf
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Recipe</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Ingredients</button>
                </li>
                
            </ul>
        </div>
                  
        <div id="myTabContent">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" id="title" name="title" required class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-orange-500 appearance-none dark:text-white dark:border-green-500 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-orange-500 peer" placeholder=" " value="{{ old('title', $recipes->title) }}" />
                        <label for="title" class="absolute text-sm text-orange-500 dark:text-green-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Title</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="relative">
                        <textarea id="description" name="description" required class="block  px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-orange-600 appearance-none dark:text-white dark:border-green-500 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-orange-500 peer" placeholder=" ">{{ old('description', $recipes->Description) }}</textarea>
                        <label for="description" class="absolute text-sm text-orange-500 dark:text-green-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Description</label>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="relative">
                        <textarea id="Instructions" name="Instructions" required class="block  px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-orange-600 appearance-none dark:text-white dark:border-violet-500 dark:focus:border-violet-500 focus:outline-none focus:ring-0 focus:border-violet-600 peer" placeholder=" ">{{ old('Instructions', $recipes->Instructions) }}</textarea>
                        <label for="Instructions" class="absolute text-sm text-orange-500 dark:text-orange-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Instructions</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="relative">
                        <textarea id="Prep_time" name="Prep_time" required class="block  px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-orange-500 appearance-none dark:text-white dark:border-green-500 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-orange-500 peer" placeholder=" ">{{ old('Prep_time', $recipes->Prep_time) }}</textarea>
                        <label for="Prep_time" class="absolute text-sm text-orange-500 dark:text-green-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Prep Time</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="relative">
                        <textarea id="cook_time" name="cook_time" required class="block  px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-orange-500 appearance-none dark:text-white dark:border-green-500 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-orange-500 peer" placeholder=" ">{{ old('cook_time', $recipes->cook_time) }}</textarea>
                        <label for="cook_time" class="absolute text-sm text-orange-500 dark:text-green-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Cook Time</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="relative">
                        <textarea id="servings" name="servings" required class="block  px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-orange-500 appearance-none dark:text-white dark:border-green-500 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-orange-500 peer" placeholder=" ">{{ old('servings', $recipes->servings) }}</textarea>
                        <label for="servings" class="absolute text-sm text-orange-500 dark:text-green-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Servings</label>
                    </div>
                </div>
                
                <label for="Category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                <select id="Category_id" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, old('category', $recipes->category->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                
                <div class="mb-4">
                    <label for="images" class="block">Images:</label>
                    <input type="file" id="cover" name="cover" multiple accept="image/*" required class="w-full">
                </div>
                </div>
                
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    @foreach ($ingredients as $ingredient)
                    <div class="flex flex-row space-x-4">
                        <div class="flex items-center mr-4">
                            <input id="purple-checkbox" type="checkbox" data-id="{{$ingredient->id}}" value="{{$ingredient->id}}" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 ingredient-enable" {{ in_array($ingredient->id, old('ingredients', $recipes->ingredients->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label for="purple-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$ingredient->name}}</label>
                        </div>
                        <div class="flex items-center mb-4">
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="relative">
    <input type="text" data-id="{{$ingredient->id}}" id="Quantity" name="ingredients[{{$ingredient->id}}]" required class="block rounded-lg px-2.5 pb-2.5 pt-5 text-sm text-gray-900 bg-transparent  border-1 border-violet-600 appearance-none dark:text-white dark:border-green-500 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-violet-600 w-full ingredient-amount" placeholder=" " disabled value="{{ old('ingredients.' . $ingredient->id, $recipes->ingredients->where('id', $ingredient->id)->first()->pivot->quantity ?? '') }}" {{ in_array($ingredient->id, old('ingredients', $recipes->ingredients->pluck('id')->toArray())) ? '' : 'disabled' }}>
    <label for="Quantity" class="absolute text-sm text-violet-600 dark:text-green-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Amount</label>
</div>

                        </div>
                    </div>
                    @endforeach
                </div>                
           
        </div>
        {{-- {{ route('recipes.store') }} --}}
        <button type="submit" class="px-5 py-2 mt-2 ml-4 mb-4 bg-orange-500 text-white rounded-lg">Add Recipe</button>
    </form>
    @if (session('success'))
        {{session('success')}}
   
    @endif
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.ingredient-enable').each(function() {
            let id = $(this).data('id');
            let enabled = $(this).is(":checked");
            let ingredientAmountField = $('.ingredient-amount[data-id="' + id + '"]');
            ingredientAmountField.prop('disabled', !enabled);
            
            // Check if the ingredient has a corresponding old value
            let oldValue = ingredientAmountField.data('old-value');
            if (oldValue) {
                ingredientAmountField.val(oldValue);
            }
        });

        $('.ingredient-enable').on('click', function() {
            let id = $(this).data('id');
            let enabled = $(this).is(":checked");
            $('.ingredient-amount[data-id="' + id + '"]').prop('disabled', !enabled).val('');
        });
    });
</script>
      </div>
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
</body> 
</html>