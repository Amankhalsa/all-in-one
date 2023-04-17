

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
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                             <a href="{{route('namemypet')}}" class="btn btn-success">Ask New Question </a>
                            </div>
                                <div class="card-header">ChatGPT answer</div>

                            <div class="card-body">
                                <p>{{ $response }}</p>
                            </div>
                        </div>
                    </div>
                </div>

 


	         </div>
            </div>
        </div>
    </div>
</x-app-layout>
