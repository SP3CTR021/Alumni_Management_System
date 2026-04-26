<x-layouts.app>
    <div class="directory-shell">
        <section class="directory-hero">
            <div>
                <h1>Alumni Directory</h1>
                <p>Search and connect with your fellow graduates.</p>
            </div>
        </section>

        <form class="directory-filters" method="GET" action="{{ route('alumni.directory') }}">
            <label class="directory-search">
                <span class="directory-search-icon">&#128269;</span>
                <input
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search by name, course, or company"
                    aria-label="Search alumni"
                />
            </label>

            <label class="directory-select">
                <span class="sr-only">Batch</span>
                <select name="batch" onchange="this.form.submit()">
                    <option value="all">All Batches</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch }}" {{ request('batch') == $batch ? 'selected' : '' }}>{{ $batch }}</option>
                    @endforeach
                </select>
            </label>

            <label class="directory-select">
                <span class="sr-only">Course</span>
                <select name="course" onchange="this.form.submit()">
                    <option value="all">All Courses</option>
                    @foreach($courses as $course)
                        <option value="{{ $course }}" {{ request('course') == $course ? 'selected' : '' }}>{{ $course }}</option>
                    @endforeach
                </select>
            </label>
        </form>

        <div class="directory-card">
            <div class="directory-table-head">
                <span>Name</span>
                <span>Course</span>
                <span>Batch</span>
                <span>Employment</span>
                <span>Company</span>
                <span>Status</span>
            </div>

            @forelse($profiles as $profile)
                <div class="directory-row">
                    <div>
                        <strong>{{ $profile->user->name }}</strong>
                        <div class="directory-meta">{{ $profile->user->email }}</div>
                    </div>
                    <div>{{ $profile->course ?? '—' }}</div>
                    <div>{{ $profile->batch_year ?? '—' }}</div>
                    <div>
                        <span class="directory-badge directory-badge--employment {{ $profile->employment_type === 'unemployed' ? 'directory-badge--muted' : 'directory-badge--success' }}">
                            {{ $profile->employment_type ? strtoupper(str_replace('_', ' ', $profile->employment_type)) : 'UNKNOWN' }}
                        </span>
                    </div>
                    <div>{{ $profile->employer ?: '—' }}</div>
                    <div>
                        <span class="directory-badge directory-badge--status {{ $profile->status === 'approved' ? 'directory-badge--active' : 'directory-badge--inactive' }}">
                            {{ $profile->status === 'approved' ? 'ACTIVE' : 'INACTIVE' }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="directory-empty">No alumni found matching your search.</div>
            @endforelse
        </div>

        <div class="directory-footer">
            <div>
                @if($profiles->total() > 0)
                    Showing {{ $profiles->firstItem() }}–{{ $profiles->lastItem() }} of {{ $profiles->total() }} alumni
                @else
                    No alumni to display.
                @endif
            </div>

            <div class="directory-pagination">
                {{ $profiles->links() }}
            </div>
        </div>
    </div>

    <style>
        .directory-shell {
            display: grid;
            gap: 1.75rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .directory-hero {
            padding: 2rem 1.75rem;
            background: #f8f2e7;
            border-radius: 18px;
            border: 1px solid #e8dfd5;
        }

        .directory-hero h1 {
            margin: 0 0 0.6rem;
            color: #741021;
            font-size: clamp(2rem, 2.3vw, 2.5rem);
            font-family: var(--font-display);
        }

        .directory-hero p {
            margin: 0;
            color: #6f5f4d;
            font-size: 1rem;
        }

        .directory-filters {
            display: grid;
            grid-template-columns: 1.8fr 0.9fr 0.9fr;
            gap: 1rem;
            align-items: center;
        }

        .directory-search {
            position: relative;
            background: #fff;
            border: 1px solid #d8ceb9;
            border-radius: 12px;
            padding: 0.95rem 1.2rem 0.95rem 3rem;
            display: block;
        }

        .directory-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #8a6f4d;
            font-size: 1rem;
        }

        .directory-search input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: #3b2f23;
            font-size: 0.98rem;
        }

        .directory-search input::placeholder {
            color: #9b8c79;
        }

        .directory-select select {
            width: 100%;
            border: 1px solid #d8ceb9;
            border-radius: 12px;
            padding: 0.95rem 1rem;
            background: #fff;
            color: #3b2f23;
            font-size: 0.98rem;
            appearance: none;
        }

        .directory-card {
            background: #fff9f2;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #e1d5c3;
            box-shadow: 0 12px 30px rgba(62, 21, 19, 0.08);
        }

        .directory-table-head,
        .directory-row {
            display: grid;
            grid-template-columns: minmax(220px, 2.4fr) 1fr 0.9fr 1.2fr 1.6fr 1fr;
            gap: 1rem;
            align-items: center;
            padding: 1rem 1.5rem;
            min-height: 66px;
        }

        .directory-table-head {
            background: #69171e;
            color: #f7d08c;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .directory-row {
            border-top: 1px solid #e4d7c9;
            background: #fffaf2;
        }

        .directory-row:nth-child(even) {
            background: #f8f2e7;
        }

        .directory-row strong {
            color: #37170e;
            font-size: 1rem;
        }

        .directory-meta {
            margin-top: 0.35rem;
            color: #8b7d71;
            font-size: 0.92rem;
        }

        .directory-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.45rem 0.75rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .directory-badge--employment {
            color: #3b5e47;
            background: #e8f4ea;
            border: 1px solid #cfe7d3;
        }

        .directory-badge--muted {
            color: #7a5d49;
            background: #f2ebe5;
            border: 1px solid #e2d5c8;
        }

        .directory-badge--status {
            color: #741021;
            background: #f9eced;
            border: 1px solid #ecdbd9;
        }

        .directory-badge--active {
            color: #741021;
            background: #fdeaec;
        }

        .directory-badge--inactive {
            color: #7a5d49;
            background: #f1ebe5;
        }

        .directory-empty {
            padding: 2.5rem 1.5rem;
            color: #6f5f4d;
            text-align: center;
            font-size: 1rem;
        }

        .directory-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            color: #6f5f4d;
            font-size: 0.95rem;
        }

        .directory-pagination {
            min-width: 280px;
        }

        .directory-pagination .pagination {
            margin: 0;
            justify-content: flex-end;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
</x-layouts.app>
