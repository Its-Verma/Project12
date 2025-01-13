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
        
        <div class="container my-5">
            <h1 class="text-center mb-4">Blogs</h1>
            <div class="row">
               @foreach($posts as $post)
                     <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                           <div class="card-body d-flex flex-column">
                                 <h5 class="card-title">{{ $post->title }}</h5>
                                 <p class="card-text">{{ Str::limit($post->content, 150, '...') }}</p>
                                 <div class="mt-auto">
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-block">Read More</a>
                                 </div>
                           </div>
                        </div>
                     </div>
               @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
               {{ $posts->links() }}
            </div>
         </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>