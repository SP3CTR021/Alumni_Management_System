<x-layouts.app>
    <a href="{{ route('alumni.announcements.index') }}" class="btn btn-sm btn-secondary mb-3">← Back</a>

    <div class="card">
        <div class="card-body">
            <span class="badge bg-secondary mb-2">{{ ucfirst($announcement->category) }}</span>
            <h4>{{ $announcement->title }}</h4>
            <small class="text-muted">Posted {{ $announcement->published_at?->format('M d, Y') }}</small>
            <hr>
            <p>{{ $announcement->body }}</p>
        </div>
    </div>
</x-layouts.app>