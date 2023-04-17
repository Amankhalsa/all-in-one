<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @push('topscripts')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,body{height: 100vh !important;}
    </style>
    @endpush()
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
              <h1>Load More testing on scroll </h1>
              @livewire('load-more-data')
            
            </div>
        </div>
    </div>
    @push('scripts')
    <script type="text/javascript">
      window.onscroll = function(ev) {
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
       console.log('scrolled');
              window.livewire.emit('load-more');
          }
      };
  </script>
  @endpush()
</x-app-layout>
