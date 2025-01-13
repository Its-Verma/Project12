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
            <h2 class="pt-2 mt-4">Super Admin Dashboard</h2>
            @if (Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif
           <div class="card border-0 shadow my-4">
                <div class="card-header bg-light d-flex align-items-center">
                    <h3 class="h5 pt-2"> Users</h3>
                    <span class="ms-auto">
                    <a class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal" href="#">Add New User</a>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name ?? 'N/A' }}</td> <!-- Replace 'role' with the actual column name -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateUserModal{{ $user->id }}">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger"data-bs-toggle="modal" data-bs-target="#deleteUserModal_{{ $user->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
           </div>
            
           <!-- Table for Roles -->
           <div class="card border-0 shadow my-4">
                <div class="card-header bg-light d-flex align-items-center">
                    <h3 class="h5 pt-2"> Roles</h3>
                    <span class="ms-auto">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal" href="#">Add New Role</a>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Permissions</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if ($role->permissions->isNotEmpty())
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge bg-info">{{ $permission->name }}</span>
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRoleModal_{{ $role->id }}">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRoleModal_{{ $role->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Add New User Popup Model -->

        @include('admin.add_user_popup')

        <!-- Update User Model -->

        @include('admin.update_user_popup')

        <!-- Delete User Model -->

        @include('admin.delete_user_popup')
        
        <!-- Add New Role Popup Model -->

        @include('admin.add_role_popup')

        <!-- Update Role Model -->
        
        @include('admin.update_role_popup')

        <!-- Delete Confirmation Model -->

        @include('admin.delete_role_popup')


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script>

            // Handle validation Error for add new user
            @if ($errors->any())
                // Reopen the modal if there are validation errors
                const addUserModal = new bootstrap.Modal(document.getElementById('addUserModal'));
                addUserModal.show();
            @endif
        </script>

   </body>
</html>