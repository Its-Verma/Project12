<header >
      <nav class=" navbar navbar-expand-md bg-white shadow-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
         <div class="container container-fluid">
            <a class="navbar-brand" href="{{ route('posts.index') }}">Multi User System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
               <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{route('posts.index')}}">Home</a>
               </li>
               <li class="nav-item">
                  @guest('admin') <!-- Show login if user is not logged in -->
                     <a class="nav-link" href="{{route('admin.login')}}">Login</a>
                  @endguest
                  @php
                     use Illuminate\Support\Facades\DB;

                     $user = Auth::guard('admin')->user();
                     $hasSuperadminPermission = false;

                     if ($user) {
                        $hasSuperadminPermission = DB::table('role_permission')
                              ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
                              ->where('role_permission.role_id', $user->role_id)
                              ->where('permissions.name', 'superadmin')
                              ->exists();
                     }
                  @endphp

                  @auth('admin') <!-- Show dropdown if user is logged in -->
                     <!-- <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.dashboard')}}">SuperAdmin</a>
                     </li> -->
                     @if($hasSuperadminPermission)
                        <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.dashboard') }}">SuperAdmin</a>
                        </li>
                     @endif
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('other.dashboard') }}">Admin</a>
                     </li>
                     <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Hello, {{ Auth::guard('admin')->user()->name }}
                           </a>
                           <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">
                              <li>
                                 <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                              </li>
                           </ul>
                     </li>
                  @endauth
               </li>

            </div>
         </div>
      </nav>
   </header>