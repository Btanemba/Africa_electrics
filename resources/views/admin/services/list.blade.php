@extends(backpack_view('blank'))

@section('content')

@php
    $entries = $crud->getEntries();
    $iconOptions = \App\Models\Service::iconOptions();
@endphp

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Services</h2>

        <a href="{{ url($crud->route.'/create') }}" class="btn btn-primary">
            + Add Service
        </a>
    </div>

    <div class="row">
        @forelse($entries as $entry)
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-primary"
                                     style="width: 3.25rem; height: 3.25rem;">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        {!! $entry->icon_markup !!}
                                    </svg>
                                </div>

                                <div>
                                    <h5 class="card-title mb-1">{{ $entry->title }}</h5>
                                    <h6 class="card-subtitle text-muted">{{ $iconOptions[$entry->icon] ?? $entry->icon }}</h6>
                                </div>
                            </div>

                            @if($entry->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Hidden</span>
                            @endif
                        </div>

                        @if($entry->description)
                            <p class="card-text mb-3">
                                {{ \Illuminate\Support\Str::limit($entry->description, 110) }}
                            </p>
                        @endif

                        <div class="small text-muted d-flex flex-column gap-1">
                            <span><strong>Order:</strong> {{ $entry->sort_order }}</span>
                            <span><strong>Key:</strong> {{ $entry->icon }}</span>
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
                                        onclick="return confirm('Delete this service?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No services found</p>
            </div>
        @endforelse
    </div>

</div>

@endsection