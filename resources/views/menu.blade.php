<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="py-12">
                    @push('topscripts')
                    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
                    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
                    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
                    @endpush()
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="sort_menu list-group">
                                    @foreach ($data as $row)
                                    <li class="list-group-item" data-id="{{$row->id}}">
                                        <span class="handle"></span>  {{$row->lable}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @push('topscripts')

                    <style>
                        .list-group-item {display: flex; align-items: center;  }
                        .highlight { background: #f7e7d3; min-height: 30px; list-style-type: none; }
                        .handle { min-width: 18px;  background: #607D8B;  height: 15px; display: inline-block; cursor: move; margin-right: 10px; }
                    </style>
                   @endpush()
                       @push('scripts')
                    <script>
                        $(document).ready(function(){
                            function updateToDatabase(idString){
                               $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
                               $.ajax({
                                  url:'{{url('/menu/update-order')}}',
                                  method:'POST',
                                  data:{ids:idString},
                                  success:function(){
                                     alert('Successfully updated')
                                        //do whatever after success
                                  }
                               })
                            }
                            var target = $('.sort_menu');
                            target.sortable({
                                handle: '.handle',
                                placeholder: 'highlight',
                                axis: "y",
                                update: function (e, ui){
                                   var sortData = target.sortable('toArray',{ attribute: 'data-id'})
                                   updateToDatabase(sortData.join(','))
                                }
                            })   
                        })
                    </script>
                       @endpush()
                </div>
           
            </div>
        </div>
    </div>
    
</x-app-layout>
