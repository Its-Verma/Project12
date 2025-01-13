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
            <div class="card shadow-lg">
               <div class="card-body">
                     <h1 class="card-title text-center mb-4">{{ $post->title }}</h1>
                     <p class="card-text text-justify" style="line-height: 1.8;">
                        {{ $post->content }}
                     </p>
               </div>
               <div class="card-footer text-center">
                     <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Blogs
                     </a>
               </div>
            </div>
         </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>