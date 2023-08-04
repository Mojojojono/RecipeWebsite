<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="bg-white shadow-md fixed top-0 left-0 right-0 z-50  " x-data="{ isOpen: false }">
        <nav class="container px-6 py-8 mx-auto md:flex md:justify-between md:items-center " x-data="{ open: false }" wire:id="oYMiPnZp4Nzbmr9iAsGp">
            
          <div class="flex items-center justify-between">
            <a class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 md:text-2xl hover:text-green-400"
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
              
              <a  href="{{ Auth::check() ? route('dashboard.index') : route('welcome.index') }}"class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400" href="#">Home</a>
              
             
              @can('admin')
              <a href="{{route('userview')}}" class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400">Admin</a>
              @endcan
              <a href="{{ route('aboutus.index') }}" class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400">About Us</a>
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
<form action="{{$url}}" method="post">
  @csrf
    <div class="container">
        <h1 class="text-center">{{$title}}</h1>
        <div class="form-group">
       
       <div class="mb-3">
           <label for="Ingredients" class="form-label">Ingredients</label>
           <input type="text" name="ingredient" class="form-control" id="ingredients" value="{{$ingredient->name}}">
       </div>
       
         <button type="submit" class="btn btn-primary">Submit</button>

        </div>
        </div>
    </form>
      </div>
</body>
</html>