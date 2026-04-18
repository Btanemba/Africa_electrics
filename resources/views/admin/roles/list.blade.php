@extends(backpack_view('blank'))

@section('content')

@php
    $entries = $crud->query->paginate(9);
@endphp

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Roles</h2>

        <a href="{{ url($crud->route.'/create') }}" class="btn btn-primary">
            <i class="la la-plus"></i> Add Role
        </a>
    </div>

    <!-- Search -->
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                   placeholder="Search roles..."
                   value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="row">
        @forelse($entries as $entry)

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <!-- Name -->
                        <h5 class="mb-1">{{ $entry->name }}</h5>

                        <!-- Code -->
                        <span class="badge bg-secondary mb-2">
                            {{ $entry->code }}
                        </span>

                        <!-- Description -->
                        @if($entry->description)
                            <p class="small text-muted">
                                {{ \Illuminate\Support\Str::limit($entry->description, 100) }}
                            </p>
                        @else
                            <p class="small text-muted">No description</p>
                        @endif

                    </div>

                    <!-- Actions -->
                    <div class="card-footer d-flex justify-content-between">

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
                            <form method="POST"
                                  action="{{ url($crud->route.'/'.$entry->id) }}"
                                  onsubmit="return confirm('Delete this role?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="la la-trash"></i>
                                </button>
                            </form>

                        </div>

                    </div>

                </div>
            </div>

        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No roles found</p>

                <a href="{{ url($crud->route.'/create') }}"
                   class="btn btn-primary mt-2">
                    Add First Role
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $entries->appends(request()->query())->links() }}
    </div>

</div>

@endsection
