<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
    @push('topscripts')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    @endpush()    
    <div class="row mt-5">
              <div class="col-md-10 offset-md-1">
                @if ( Session::has('success'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('success') }}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              
                  @endif
                  <h3 class="text-center mb-4">Drag and Drop Datatables Using 
                    jQuery UI Sortable - with MultiDelete </h3>
                    <form action="{{ route('all.delete') }}"  method="post"  >
                      <button class="btn btn-primary border" type="submit" >All delete</button>
                  @csrf
              @method('DELETE')
                    
                  <table id="table" class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="30px">#</th>
                        <th> <input type='checkbox'  id='select_all' onclick="selectAll()">  All </th>
                        <th>Title</th>
                        <th>body</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="tablecontents">
                      @foreach($posts as $post)
                        <tr class="row1" data-id="{{ $post->id }}">
                          <td class="pl-3"><i class="fa fa-sort"></i></td>
                          <th scope="row"> <input type="checkbox" name="ids[]" value="{{$post->id}}" class='check_del'></th>
                          <td>{{ $post->title }}</td>
                          <td>{{ $post->body }}</td>
                          <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View Post</a>
                          </td>
                          {{-- <td>{{ date('d-m-Y h:m:s',strtotime($post->created_at)) }}</td> --}}
                        </tr>
                      @endforeach
                    </tbody>                  
                  </table>
                    </form>
                  <hr>
                  <h5>Drag and Drop the table rows and 
                    <button class="btn btn-success btn-sm"
                     onclick="window.location.reload()"> REFRESH</button> 
                     the page to check the Demo.</h5> 
            </div>
          </div>
          @push('scripts')
          <script>
            function selectAll() {
        var blnChecked = document.getElementById("select_all").checked;
        var check_invoices = document.getElementsByClassName("check_del");
        var intLength = check_invoices.length;
        for(var i = 0; i < intLength; i++) {
            var check_invoice = check_invoices[i];
            check_invoice.checked = blnChecked;
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
          <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
          <script type="text/javascript">
            $(function () 
            {
              $("#table").DataTable();
              $( "#tablecontents" ).sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() 
                {
                    sendOrderToServer();
                  }
              });
      
              function sendOrderToServer() {
                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');
                $('tr.row1').each(function(index,element) {
                  order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                  });
                });
      
                $.ajax({
                  type: "POST", 
                  dataType: "json", 
                  url: "{{ url('post-sortable') }}",
                      data: {
                    order: order,
                    _token: token
                  },
                  success: function(response) {
                    //do whatever after success
                    alert('Successfully updated')
                      if (response.status == "success") {
                        console.log(response);
                      } else {
                        console.log(response);
                      }
                  }
                });
              }
            });
          </script>
         @endpush()
          </div>
      </div>
  </div>
  
</x-app-layout>
