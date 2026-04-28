@extends(backpack_view('blank'))

@section('content')

@php
    $entries = $crud->getEntries();
@endphp

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Projects</h2>

        <a href="{{ url($crud->route.'/create') }}" class="btn btn-primary">
            + Add Project
        </a>
    </div>

    <div class="row">
        @forelse($entries as $entry)
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow-sm h-100">
                    @if($entry->image_url)
                        <img
                            src="{{ $entry->image_url }}"
                            alt="{{ $entry->title }}"
                            class="card-img-top"
                            style="height: 220px; object-fit: cover;"
                        >
                    @endif

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                            <div>
                                <h5 class="card-title mb-1">{{ $entry->title }}</h5>
                                <h6 class="card-subtitle text-muted">{{ $entry->category_label }}</h6>
                            </div>

                            @if($entry->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Hidden</span>
                            @endif
                        </div>

                        @if($entry->summary)
                            <p class="card-text mb-3">
                                {{ \Illuminate\Support\Str::limit($entry->summary, 110) }}
                            </p>
                        @endif

                        <div class="small text-muted d-flex flex-column gap-1">
                            <span><strong>Location:</strong> {{ $entry->location ?: 'Not provided' }}</span>
                            <span><strong>Year:</strong> {{ $entry->project_year ?: 'Not provided' }}</span>
                            <span><strong>Order:</strong> {{ $entry->sort_order }}</span>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            ID #{{ $entry->id }}
                        </small>

                        <div>
                            <a href="{{ url($crud->route.'/'.$entry->id.'/edit') }}"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ url($crud->route.'/'.$entry->id) }}"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this project?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No projects found</p>
            </div>
        @endforelse
    </div>

</div>

@endsection