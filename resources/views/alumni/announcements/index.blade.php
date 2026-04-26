<x-layouts.app>
    <h4 class="mb-3">Announcements</h4>

    @forelse($announcements as $announcement)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="badge bg-secondary mb-1">{{ ucfirst($announcement->category) }}</span>
                        <h6 class="mb-1">{{ $announcement->title }}</h6>
                        <small class="text-muted">{{ $announcement->published_at?->format('M d, Y') }}</small>
                    </div>
                </div>
                <p class="mt-2 text-muted small">{{ Str::limit($announcement->body, 120) }}</p>
                <a href="{{ route('alumni.announcements.show', $announcement) }}" class="btn btn-sm btn-outline-primary">Read More</a>
            </div>
        </div>
    @empty
        <p class="text-muted">No announcements yet.</p>
    @endforelse
</x-layouts.app>