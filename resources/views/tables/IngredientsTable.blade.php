@extends('layouts.main')
@section('main-container')

<body>
  <div class="relative overflow-x-auto ml-[16rem] mt-16">
      
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($ingredient as $ingredient)
            <tr>
              <td>{{$ingredient->name}}</td>
              <td>
                <a href="{{route('ingredientedit',['id'=>$ingredient->id])}}"><button class="btn btn-primary" >Edit</button></a>
                <a href="{{route('ingredientdelete',['id'=>$ingredient->id])}}"><button class="btn btn-danger" >Delete</button></a>
              </td>
            
            </tr>
            @endforeach

          </tbody>
        </table>
        <a href="{{route('ingredient.index')}}">
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