@extends(backpack_view('blank'))

@section('content')

@php
    $entries = $crud->getEntries();
@endphp

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Products</h2>

        <a href="{{ url($crud->route.'/create') }}" class="btn btn-primary">
            + Add Product
        </a>
    </div>

    <div class="row">
        @forelse($entries as $entry)

            @php
                $image = $entry->images->first();
                $imageUrl = $image
                    ? asset('storage/'.$image->image_path)
                    : 'https://via.placeholder.com/300x200?text=No+Image';
            @endphp

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">

                    <!-- Image -->
                    <img src="{{ $imageUrl }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;">

                    <div class="card-body">

                        <h5 class="card-title">{{ $entry->name }}</h5>

                        <p class="text-muted mb-1">
                            {{ $entry->category->name ?? 'No Category' }}
                        </p>

                        <p class="mb-2">
                            <strong>${{ number_format($entry->price, 2) }}</strong>
                        </p>

                        @if($entry->description)
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::limit($entry->description, 80) }}
                            </p>
                        @endif

                        <span class="badge {{ $entry->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $entry->status ? 'Active' : 'Inactive' }}
                        </span>

                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">

                        <small class="text-muted">
                            Stock: {{ $entry->stock_quantity }}
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
                                        onclick="return confirm('Delete this product?')">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No products found</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
