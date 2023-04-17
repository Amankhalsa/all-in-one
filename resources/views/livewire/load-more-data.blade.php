<div>
    {{-- Do your work, then step back. --}}
    <table class="table">
        <thead>
            <caption>Load More testing on scroll </caption>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
     
            @foreach($posts->sort() as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body  }}
            
                </td>
                <td><i class="fa-fa-trash"> </i></td>
            </tr>
            @endforeach
        </tbody>
    </table>
 
</div>
