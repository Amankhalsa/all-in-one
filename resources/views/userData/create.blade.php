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
          <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
          {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
          <!-- Style -->
          <style>
              .input-box { position: relative; }
              .unit { position: absolute; display: block; left: 5px; top: 10px; z-index: 9; }
              .fixedTxtInput { display: block; border: 1px solid #d7d6d6; background: #fff; padding: 10px 10px 10px 30px; width: 100%; }
          </style>    
        @endpush()
            <div class="row">
              <div class="col-lg-12 margin-tb">
                  <div class="pull-left">
                      <h2>Add New User</h2>
                  </div>
                  <div class="pull-right">
                      <a class="btn btn-primary" href="{{ route('homepage') }}"> Back</a>
                      <button class="btn btn-success" onclick="window.location.reload()"> Reload</button>
                  </div>
              </div>
          </div>
             
          @if ($errors->any())
              <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <div class="alert alert-success" style="display:none" id="alertid">
           
          </div>
          <div id="form_id">
          <div class="form-group">
          
          <input type="hidden" name="_token"  id="csrf" value="{{ csrf_token() }}" />
          
              <label for="email">Name:</label>
              <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
            </div>
          
            <div class="form-group">
              <label for="email">Phone:</label>
              <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
            </div>
          
            <div class="form-group">
              <label for="email">City:</label>
              <input type="text" class="form-control" id="city" placeholder="Enter City" name="city">
            </div>
          
            <button type="submit" class="btn btn-primary" id="butsave">Submit</button>
          </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="bodyData">
              </tbody>
            </table>
          </div>
          @push('scripts')

          <script>
          $(document).ready(function() {
              $('#butsave').on('click', function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var city = $('#city').val();
                var password = $('#password').val();
                if(name!="" && email!="" && phone!="" && city!=""){
                  /*  $("#butsave").attr("disabled", "disabled"); */
                    $.ajax({
                        url: "/storedata",
                        type: "POST",
                        data: {
                            _token: $("#csrf").val(),
                            name  : name,
                            email : email,
                            phone : phone,
                            city  : city
                        },
                        cache: false,
                        success: function(response) {
                          console.log(response.message);
                          $(".alert-success").css("display", "block");
                          $('input[type="text"],input[type="email"],textarea, select').val('');
                          if (response) {
                              $(".alert-success").append("<P>"+response.message);
                              $("#alertid").fadeOut(3000);
                              setTimeout(settime, 2000);
                            function settime() {
                              document.getElementById('alertid').innerHTML = "";
                              }
                          } else {
                            console.log(response.status);
                             $("#butsave").attr("disabled", "disabled"); 
                          }
                          // window.location.reload();
                           table.draw();
                      }
                    });
                }
                else{
                    alert('Please fill all the field !');
                }
            });
          });
          </script>
          
          <script>
            $(document).ready(function() {
              var url = "{{route('adduser')}}";
              $.ajax({
                    url   : "/userData/getUserData",
                    type  : "POST",
                    data  :
                    { 
                    _token:'{{ csrf_token() }}'
                        },
                    cache: false,
                    dataType: 'json',
                    success: function(dataResult){
                        console.log(dataResult);
                        var resultData = dataResult.data;
                        var bodyData = '';
                        var i=1;
                        $.each(resultData,function(index,row){
                            var editUrl = url+'/'+row.id+"/edit";
                            bodyData+="<tr>"
                            bodyData+="<td>"+ i++ +"</td><td>"+row.name+"</td><td>"+row.email+"</td><td>"+row.phone+"</td>"
                            +"<td>"+row.city+"</td><td><a class='btn btn-primary' href='"+editUrl+"'>Edit</a>" 
                            +"<button class='btn btn-danger delete' value='"+row.id+"' style='margin-left:20px;'>Delete</button></td>";
                            bodyData+="</tr>";
                        })
                        $("#bodyData").append(bodyData);
                    }
                });
            
            $(document).on("click", ".delete", function() { 
                var $ele   =  $(this).parent().parent();
                var id     =  $(this).val();
                var url    =  "{{route('adduser')}}";
                var dltUrl =  url+"/"+id;
              
            $.ajax({
              url   : dltUrl,
              type  : "DELETE",
              cache : false,
              data  :
              {
              _token:'{{ csrf_token() }}'
              },
                    success: function(response) {
                    console.log(response.message);
                    if (response) 
                    {
                      $ele.fadeOut().remove();
                      } 
                    else 
                    {
                      console.log(response.status);
                      }
                    }
                // -----------
              });
            });
          });
          </script>
         @endpush()
          </div>
      </div>
  </div>
  
</x-app-layout>
