@foreach ($users as $user)
<div class="modal fade" id="updateUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="updateUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel{{ $user->id }}">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="userName{{ $user->id }}" class="form-label">Name</label>
                        <input type="text" class="form-control" id="userName{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail{{ $user->id }}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="userRole{{ $user->id }}" class="form-label">Role</label>
                        <select class="form-control" id="userRole{{ $user->id }}" name="role_id" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword{{ $user->id }}" class="form-label">Password (Leave blank to keep unchanged)</label>
                        <input type="password" class="form-control" id="userPassword{{ $user->id }}" name="password" placeholder="Enter new password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
