@foreach ($posts as $post)
<div class="modal fade" id="editPostModal_{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.updatePost', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="postTitle_{{ $post->id }}" class="form-label">Title</label>
                        <input type="text" class="form-control" id="postTitle_{{ $post->id }}" name="title" value="{{ $post->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="postContent_{{ $post->id }}" class="form-label">Content</label>
                        <textarea class="form-control" id="postContent_{{ $post->id }}" name="content" required>{{ $post->content }}</textarea>
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