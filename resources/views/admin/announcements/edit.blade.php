<x-layouts.admin>
    <h4 class="mb-3">Edit Announcement</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $announcement->title) }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select">
                        @foreach(['news','job','scholarship','notice'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $announcement->category) === $cat ? 'selected' : '' }}>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Body / Content</label>
                    <textarea name="body" class="form-control" rows="5">{{ old('body', $announcement->body) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft" {{ $announcement->status === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $announcement->status === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-layouts.admin>