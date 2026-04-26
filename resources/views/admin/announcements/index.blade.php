<x-layouts.admin>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Announcements</h4>
        <a href="{{ route('admin.announcements.create') }}" class="btn btn-success">+ New Post</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($announcements as $a)
            <tr>
                <td>{{ $a->id }}</td>
                <td>{{ $a->title }}</td>
                <td><span class="badge bg-secondary">{{ ucfirst($a->category) }}</span></td>
                <td>
                    <span class="badge bg-{{ $a->status === 'published' ? 'success' : 'secondary' }}">
                        {{ ucfirst($a->status) }}
                    </span>
                </td>
                <td>{{ $a->published_at?->format('M d, Y') ?? '—' }}</td>
                <td>
                    <a href="{{ route('admin.announcements.edit', $a) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.announcements.destroy', $a) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this announcement?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">No announcements.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-layouts.admin>