@foreach ($roles as $role)
<div class="modal fade" id="editRoleModal_{{ $role->id }}" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.updateRole', $role->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="roleName_{{ $role->id }}" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="roleName_{{ $role->id }}" name="name" value="{{ $role->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="permissions_{{ $role->id }}" class="form-label">Permissions</label>
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    id="permission_{{ $role->id }}_{{ $permission->id }}" 
                                    name="permissions[]" 
                                    value="{{ $permission->id }}" 
                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission_{{ $role->id }}_{{ $permission->id }}">
                                    {{ ucfirst(str_replace('-', ' ', $permission->name)) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach