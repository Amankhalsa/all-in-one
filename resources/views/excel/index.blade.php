

<x-app-layout>
    @push('topscripts')

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	@endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 ">
	         <div class="col-md-12">
        
                    @if(Session::has('success'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                    @endif

                 <div class="card-body">
                    <form action="{{ route('import_data') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Import User Data</button>
                        <a class="btn btn-primary" href="{{route('exportstudent')}}">Export</a>
                        
                    </form>
                </div>
                <form action="{{ route('deleteAllStudent') }}"  method="post"  >
                    <input class="btn btn-primary border" type="submit" value="All Delete" >
                    @csrf
             

                <table class="table">
                 
      
                    <thead>
                        <caption>Load More testing on scroll </caption>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Class</th>

                        <th scope="col">S_Name</th>
                        <th scope="col">F_Name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                 
                        @foreach($exceldata->sort() as $post)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{$post->id}}" > {{ $post->id }}</td>
                            <td>{{ $post->class }}</td>
                            <td>{{ $post->sname }}</td>
                            <td>{{ $post->fname }}</td>
                            <td><a href="{{route('deleteSudent',$post->id)}}" style="font-size:30px; border:1px solid rgb(4, 2, 2);background:red;color:white"> Del</a></td>
                        </tr>
                       
                        @endforeach
                    </tbody>
                </table>
            </form>
                {{ $exceldata->links('pagination::bootstrap-5') }}
	         </div>
            </div>
        </div>
    </div>
</x-app-layout>
