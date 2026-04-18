@extends(backpack_view('blank'))

@section('content')

@php
    $entries = $crud->getEntries();
@endphp

<div class="container-fluid">

 
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Team Members</h2>

    <a href="{{ url($crud->route.'/create') }}"
       class="btn btn-primary">
        <i class="la la-plus"></i> Add Team Member
    </a>
</div>

    <div class="row">
        @forelse($entries as $entry)

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 text-center">

                    <div class="card-body">

                        <!-- Photo -->
                        <div class="mb-3">
                            @if($entry->photo)
                                <img src="{{ asset('storage/'.$entry->photo) }}"
                                     class="rounded-circle"
                                     style="width:100px;height:100px;object-fit:cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                     style="width:100px;height:100px;margin:auto;">
                                    <span class="text-muted">No Photo</span>
                                </div>
                            @endif
                        </div>

                        <!-- Name -->
                        <h5 class="mb-1">{{ $entry->name }}</h5>

                        <!-- Role -->
                        <p class="text-muted small mb-2">
                            {{ $entry->role }}
                        </p>

                        <!-- Bio -->
                        @if($entry->bio)
                            <p class="small text-muted">
                                {{ \Illuminate\Support\Str::limit($entry->bio, 80) }}
                            </p>
                        @endif

                        <!-- Status -->
                        <span class="badge bg-{{ $entry->is_active ? 'success' : 'secondary' }}">
                            {{ $entry->is_active ? 'Active' : 'Inactive' }}
                        </span>

                        <!-- Order -->
                        <p class="small text-muted mt-2">
                            Order: {{ $entry->sort_order }}
                        </p>

                    </div>

                    <!-- Actions -->
                    <div class="card-footer d-flex justify-content-between align-items-center">

                        <!-- Edit -->
                        <a href="{{ url($crud->route.'/'.$entry->id.'/edit') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="la la-edit"></i> Edit
                        </a>

                        <div class="d-flex gap-1">

                            <!-- Reorder -->
                            <a href="{{ url($crud->route.'/reorder') }}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="la la-arrows"></i>
                            </a>

                            <!-- Delete -->
                            <form method="POST"
                                  action="{{ url($crud->route.'/'.$entry->id) }}"
                                  onsubmit="return confirm('Delete this team member?')">
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
                <p class="text-muted">No team members found</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
