@extends('layouts.main')
@section('main-container')

 
<div class="relative overflow-x-auto ml-[16rem] mt-32 mr-4">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="myTable">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
      
      @foreach ($user as $user)
      <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role_id}}</td>
        <td>
          <a href="{{route('useredit',['id'=>$user->id])}}"><button class="btn btn-primary" >Edit</button></a>
          <a href="{{route('userdelete',['id'=>$user->id])}}"><button class="btn btn-danger" >Delete</button></a>
        </td>
      
      </tr>
      @endforeach
        
    </tbody>
</table>
<a href="{{route('user.index')}}">
  <button class="btn btn-primary d-inline m-2 float-right">Add</button></a>
</div>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
  $('#myTable').DataTable(
  {
  "pagingType": "full_numbers",
  "lengthMenu": [
  [5, 10, 25, 50, -1],
  [5, 10, 25, 50, "All"]
  ],
  responsive: true,
  language: {
  search: "_INPUT_",
  searchPlaceholder: "Search",
  }
  }
  );
  } );
  </script>
  
@endsection