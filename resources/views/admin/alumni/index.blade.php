<x-layouts.admin>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Alumni Records</h4>
        <a href="{{ route('admin.alumni.create') }}" class="btn btn-success">+ Add Alumni</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Batch</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumni as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->alumniProfile?->course ?? '—' }}</td>
                <td>{{ $user->alumniProfile?->batch_year ?? '—' }}</td>
                <td>
                    <span class="badge bg-{{ $user->status === 'active' ? 'success' : ($user->status === 'flagged' ? 'danger' : 'secondary') }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.alumni.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.alumni.destroy', $user) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this alumni?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No alumni found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</x-layouts.admin>