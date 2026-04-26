<x-layouts.admin>
    <h4 class="mb-3">Edit Event</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.events.update', $event) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $event->title) }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Venue</label>
                        <input type="text" name="venue" class="form-control" value="{{ old('venue', $event->venue) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Event Date</label>
                        <input type="date" name="event_date"
                               class="form-control @error('event_date') is-invalid @enderror"
                               value="{{ old('event_date', $event->event_date) }}">
                        @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $event->start_time) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Max Slots</label>
                        <input type="number" name="max_slots" class="form-control"
                               value="{{ old('max_slots', $event->max_slots) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft" {{ $event->status === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ $event->status === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-layouts.admin>