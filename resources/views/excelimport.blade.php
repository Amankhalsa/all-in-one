<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 ">
         <div class="col-md-6">
            <form method="post" action="{{route('insert_into_sheet')}}">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name">
                  @error('name')<span class="text-danger"> {{$message}}</span>  @enderror  
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
           
            </div>
        </div>
    </div>
    
</x-app-layout>
