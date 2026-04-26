<x-layouts.admin>
    <h4 class="mb-3">Create Event</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.events.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Venue</label>
                        <input type="text" name="venue" class="form-control" value="{{ old('venue') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Event Date</label>
                        <input type="date" name="event_date"
                               class="form-control @error('event_date') is-invalid @enderror"
                               value="{{ old('event_date') }}">
                        @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Max Slots</label>
                        <input type="number" name="max_slots"
                               class="form-control @error('max_slots') is-invalid @enderror"
                               value="{{ old('max_slots', 100) }}">
                        @error('max_slots') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-layouts.admin>