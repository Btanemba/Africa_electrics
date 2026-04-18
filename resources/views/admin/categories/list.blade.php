@extends(backpack_view('blank'))

@section('content')

@php
    $entries = $crud->getEntries();
@endphp

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Categories</h2>

        <a href="{{ url($crud->route.'/create') }}" class="btn btn-primary">
            + Add Category
        </a>
    </div>

    <!-- Grid -->
    <div class="row">
        @forelse($entries as $entry)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">

                    <div class="card-body">
                        <h5 class="card-title">{{ $entry->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $entry->slug }}</h6>

                        @if($entry->description)
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::limit($entry->description, 80) }}
                            </p>
                        @endif
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            {{ $entry->products_count ?? 0 }} products
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
                                        onclick="return confirm('Delete this category?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No categories found</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
