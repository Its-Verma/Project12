<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Laravel 11 Multi Auth</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
   </head>
   <body class="bg-light">
      <!-- Header Included -->
      @include('layouts.header')

      <div class="container">
         <h2 class="pt-2 mt-4">Admin Dashboard</h2>
         @if (Session::has('success'))
         <div class="alert alert-success">{{ Session::get('success') }}</div>
         @endif

         @if (Session::has('error'))
         <div class="alert alert-danger">{{ Session::get('error') }}</div>
         @endif

         <div class="card border-0 shadow my-4">
            <div class="card-header bg-light d-flex align-items-center">
               <h3 class="h5 pt-2">Posts</h3>
               <span class="ms-auto">
                  @if ($permissions['create-post'] ?? false)
                  <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPostModal" href="#">Add New Post</a>
                  @endif
               </span>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($posts as $post)
                     <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->status }}</td>
                        <td>
                           @if ($permissions['edit-post'] ?? false)
                           <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPostModal_{{ $post->id }}">Edit</a>
                           @endif

                           @if ($permissions['delete-post'] ?? false)
                           <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletePostModal_{{ $post->id }}">Delete</a>
                           @endif

                           @if ($permissions['publish-post'] ?? false)
                           <form action="{{ route('post.toggleStatus', $post->id) }}" method="POST" style="display: inline;">
                              @csrf
                              @method('PUT')
                              <button type="submit" class="btn btn-sm btn-{{ $post->status === 'published' ? 'secondary' : 'success' }}">
                              {{ $post->status === 'published' ? 'Draft' : 'Publish' }}
                              </button>
                           </form>
                           @endif
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>

         <!-- Add New Post Model -->
         @include('post.add')
         <!-- Update Post Model -->
         @include('post.update')
         <!-- Delete Post Model -->
         @include('post.delete')
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>
