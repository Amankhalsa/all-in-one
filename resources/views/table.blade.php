<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
          
            <style>
               .tablestyle{border:1px solid black;
                padding: 10px

              }
              .tablestyle > td{border:1px solid black;
                padding:15px

              }
              
            </style>
            <div class="mb-4">
              <H1 class="text-center" >Google Sheet testing data </H1>
              <a href="{{route('insertToSheet')}}" class="btn btn-success" >Insert Data</a>
            </div>
            <table class="table tablestyle" border='1' >
              <thead >
                <tr class="tablestyle">
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $val)
              <tr scope="row" class="tablestyle">
                <td  class="tablestyle" >
                  {!! $val['id'] !!}
                </td >
                <td> {!! $val['name']!!}</td>
                <td> {!!   Carbon\Carbon::parse($val['created_at'])->diffForHumans() !!} </td>
                <td> <a  class="btn btn-danger" href="{{route('delete_row',$val['id'])}}"> Delete</button></td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
      </div>
  </div>
  
</x-app-layout>
