@extends(backpack_view('blank'))

@section('content')

@php
    $entries = $crud->getEntries();

    $statusColors = [
        'pending' => 'warning',
        'reviewed' => 'info',
        'shortlisted' => 'success',
        'rejected' => 'danger',
    ];
@endphp

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Job Applications</h2>
    </div>

    <div class="row">
        @forelse($entries as $entry)

            @php
                $statusColor = $statusColors[$entry->status] ?? 'secondary';
            @endphp

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 border-start border-4 border-{{ $statusColor }}">

                    <div class="card-body">

                        <!-- Job Title -->
                        <h5 class="mb-2 text-primary">
                            {{ $entry->jobListing->title ?? 'No Job Title' }}
                        </h5>

                        <!-- Status -->
                        <span class="badge bg-{{ $statusColor }}">
                            {{ ucfirst($entry->status) }}
                        </span>

                        <!-- Applicant Info -->
                        <p class="mt-3 mb-1">
                            <strong>{{ $entry->full_name }}</strong>
                        </p>

                        <p class="text-muted small mb-1">
                            {{ $entry->email }}
                        </p>

                        <p class="text-muted small mb-2">
                            {{ $entry->phone ?? 'No phone' }}
                        </p>

                        <!-- Date -->
                        <p class="small text-muted">
                            Applied: {{ optional($entry->created_at)->format('d M Y, H:i') }}
                        </p>

                    </div>

                    <!-- Actions -->
                    <div class="card-footer d-flex justify-content-between align-items-center">

                        <!-- View -->
                        <a href="{{ url($crud->route.'/'.$entry->id.'/show') }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="la la-eye"></i> View
                        </a>

                        <div class="d-flex gap-1">

                            <!-- Update -->
                            <a href="{{ url($crud->route.'/'.$entry->id.'/edit') }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="la la-edit"></i> Update
                            </a>

                            <!-- Delete -->
                            <form method="POST"
                                  action="{{ url($crud->route.'/'.$entry->id) }}"
                                  onsubmit="return confirm('Delete this application?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="la la-trash"></i> Delete
                                </button>
                            </form>

                        </div>

                    </div>

                </div>
            </div>

        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No job applications found</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
