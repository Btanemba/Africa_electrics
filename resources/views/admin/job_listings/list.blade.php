@extends(backpack_view('blank'))

@section('content')

@php
    $entries = $crud->getEntries();

    $typeColors = [
        'full-time' => 'primary',
        'part-time' => 'info',
        'contract' => 'warning',
        'internship' => 'secondary',
    ];
@endphp

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Job Listings</h2>

        <a href="{{ url($crud->route.'/create') }}" class="btn btn-primary">
            <i class="la la-plus"></i> Add Job
        </a>
    </div>

    <div class="row">
        @forelse($entries as $entry)

            @php
                $typeColor = $typeColors[$entry->type] ?? 'secondary';
                $isExpired = $entry->deadline && now()->gt($entry->deadline);
            @endphp

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 border-start border-4 border-{{ $typeColor }}">

                    <div class="card-body">

                        <!-- Title + Type -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">
                                {{ $entry->title }}
                            </h5>

                            <span class="badge bg-{{ $typeColor }}">
                                {{ ucfirst($entry->type) }}
                            </span>
                        </div>

                        <!-- Location -->
                        <p class="text-muted small mb-2">
                            <i class="la la-map-marker"></i>
                            {{ $entry->location ?? 'No location' }}
                        </p>

                        <!-- Salary -->
                        @if($entry->salary_range)
                            <p class="small mb-2">
                                💰 {{ $entry->salary_range }}
                            </p>
                        @endif

                        <!-- Applications -->
                        <p class="small text-muted mb-2">
                            📄 {{ $entry->applications_count ?? 0 }} applications
                        </p>

                        <!-- Deadline -->
                        <p class="small {{ $isExpired ? 'text-danger' : 'text-muted' }}">
                            Deadline:
                            {{ optional($entry->deadline)->format('d M Y') ?? 'N/A' }}
                        </p>

                        <!-- Status -->
                        <span class="badge bg-{{ $entry->is_active ? 'success' : 'secondary' }}">
                            {{ $entry->is_active ? 'Active' : 'Inactive' }}
                        </span>

                    </div>

                    <!-- Actions -->
                    <div class="card-footer d-flex justify-content-between align-items-center">

                        <!-- View -->
                        <a href="{{ url($crud->route.'/'.$entry->id.'/show') }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="la la-eye"></i>
                        </a>

                        <div class="d-flex gap-1">

                            <!-- Edit -->
                            <a href="{{ url($crud->route.'/'.$entry->id.'/edit') }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="la la-edit"></i>
                            </a>

                            <!-- Delete -->
                            @if($crud->hasAccess('delete'))
                                <form method="POST"
                                      action="{{ url($crud->route.'/'.$entry->id) }}"
                                      onsubmit="return confirm('Delete this job?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="la la-trash"></i>
                                    </button>
                                </form>
                            @endif

                        </div>

                    </div>

                </div>
            </div>

        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No job listings found</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
