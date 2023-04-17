

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
	         <div class="col-md-6">



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ask something to ChatGPT</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('chatgpt.ask') }}">
                            @csrf

                            <div class="form-group">
                                <textarea class="form-control" id="question" name="prompt" rows="5"></textarea>
                                
                            </div>

                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


	         </div>
            </div>
        </div>
    </div>
</x-app-layout>
