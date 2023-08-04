@extends('layouts.main')

@section('main-container')

<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
       <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
 </button>
 
 <aside id="default-sidebar" class="fixed top-16 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
        <li>
            <a href="{{route('userview')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
               <span class="flex-1 ml-3 whitespace-nowrap">Users</span>
            </a>
         </li>
          <li>
             <a href="{{route('categoryview')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Category</span>
              
             </a>
          </li>
          <li>
             <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Ingredients</span>
                
             </a>
          </li>
          
          <li>
             <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Photos</span>
             </a>
          </li>
          
         </li>
         
       </ul>
    </div>
 </aside>
 

 <div>
   {{-- <div class="container">
      <a href="{{route('user.index')}}">
      <button class="btn btn-primary d-inline m-2 float-right">Add</button></a>
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Action</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($recipes as $recipe)
            <tr>
              <td>{{$recipes->Username}}</td>
              <td>{{$recipes->Email}}</td>
              <td>
                <a href="{{route('edit',['id'=>$recipes->id])}}"><button class="btn btn-primary" >Edit</button></a>
                <a href="{{route('delete',['id'=>$recipes->id])}}"><button class="btn btn-danger" >Delete</button></a>
              </td>
            
            </tr>
            @endforeach

          </tbody>
        </table>
    </div>
 </div> --}}



 {{-- <div class="p-4 sm:ml-64">
   <div class="flex flex-col justify-center items-center">
    <form action="/recipes" method="POST" enctype="multipart/form-data">
        @csrf 
    
        <label class="pr-16 " for="title">Title:</label>
        <input class="mb-1" type="text" id="title" name="title" required><br>
    
        <label class="pr-[0.9rem]" for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
    
        <label for="instructions">Instructions:</label>
        <textarea id="instructions" name="instructions" required></textarea><br>
    
        <label for="prep_time">Preparation Time:</label>
        <input type="text" id="prep_time" name="prep_time" required><br>

        <label for="ingredients">Ingredients:</label>
    <select id="ingredients" name="ingredients[]" multiple>
        @foreach ($ingredients as $ingredient)
            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
        @endforeach
    </select><br>
    
        <label for="cook_time">Cooking Time:</label>
        <input type="text" id="cook_time" name="cook_time" required><br>
    
        <label for="total_time">Total Time:</label>
        <input type="text" id="total_time" name="total_time" required><br>
    
        <label for="servings">Servings:</label>
        <input type="text" id="servings" name="servings" required><br>
    
        <label for="photos">Photos:</label>
        <input type="file" id="photos" name="photos[]" accept="image/*" multiple><br>
        
        <button type="submit" class="border-slate-900">Submit</button>
      </form>
   </div> --}}
   
 {{-- </div> --}}

 @endsection
