<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModalLabel">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.addRole')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="roleName" name="name" placeholder="Enter role name" required>
                    </div>
                    <div class="mb-3">
                        <label for="rolePermissions" class="form-label">Permissions</label>
                        <div id="rolePermissions">
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        class="form-check-input" 
                                        id="permission_{{ $permission->id }}" 
                                        name="permissions[]" 
                                        value="{{ $permission->id }}">
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                        {{ ucfirst(str_replace('-', ' ', $permission->name)) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Role</button>
                </div>
            </form>
        </div>
    </div>
</div>