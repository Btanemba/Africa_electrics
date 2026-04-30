<style>
    .ae-social-row {
        gap: 0.75rem;
    }

    .ae-social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .ae-social-link--mobile {
        padding: 0.5rem;
    }

    .ae-social-icon {
        width: 1rem;
        height: 1rem;
        display: block;
    }

    .ae-social-icon--mobile {
        width: 1.25rem;
        height: 1.25rem;
    }

    .ae-social-facebook:hover {
        color: #2563eb;
    }

    .ae-social-x:hover {
        color: #111827;
    }

    .ae-social-instagram:hover {
        color: #db2777;
    }

    .ae-social-linkedin:hover {
        color: #1d4ed8;
    }
</style>

<div class="top-header bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.jpg') }}" class="h-10" alt="Logo">
            <span class="text-xl font-semibold text-gray-700">AFRICA ELECTRIC</span>
        </div>

        <!-- Social Media (mobile only) -->
        <div class="flex items-center ae-social-row md:hidden">
                <a href="https://www.facebook.com/africaelectric" target="_blank" rel="noopener noreferrer" class="ae-social-link ae-social-link--mobile ae-social-facebook">
                    <svg class="ae-social-icon ae-social-icon--mobile" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
                <a href="" target="_blank" rel="noopener noreferrer" class="ae-social-link ae-social-link--mobile ae-social-x">
                    <svg class="ae-social-icon ae-social-icon--mobile" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="" target="_blank" rel="noopener noreferrer" class="ae-social-link ae-social-link--mobile ae-social-instagram">
                    <svg class="ae-social-icon ae-social-icon--mobile" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                <a href="" target="_blank" rel="noopener noreferrer" class="ae-social-link ae-social-link--mobile ae-social-linkedin">
                    <svg class="ae-social-icon ae-social-icon--mobile" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
        </div>

        <!-- Contact Info + Social (desktop only) -->
        <div class="hidden md:flex items-center space-x-6 text-sm text-gray-600">
            <span>Telephone:+231886720189</span>
            <span>Email: info@africaelectric.co</span>
            {{-- <span class="font-bold">DE | <span class="text-red-600">EN</span></span> --}}
            <div class="flex items-center ae-social-row">
                <a href="https://www.facebook.com/africaelectric" target="_blank" rel="noopener noreferrer" class="ae-social-link ae-social-facebook">
                    <svg class="ae-social-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
                <a href="" target="_blank" rel="noopener noreferrer" class="ae-social-link ae-social-x">
                    <svg class="ae-social-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="" target="_blank" rel="noopener noreferrer" class="ae-social-link ae-social-instagram">
                    <svg class="ae-social-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                <a href="" target="_blank" rel="noopener noreferrer" class="ae-social-link ae-social-linkedin">
                    <svg class="ae-social-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<!-- NAVBAR -->
<nav class="navbar bg-gray-500 w-full" x-data="{ open: false }" style="position: sticky; top: 0; z-index: 50;">
    <div class="w-full px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Desktop Menu -->
            <ul class="hidden md:flex justify-center items-center text-white text-sm font-medium w-full gap-12">
                <li class="font-semibold cursor-pointer hover:text-gray-200 transition"><a href="/">Home</a></li>
                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="cursor-pointer hover:text-gray-200 transition flex items-center gap-1">
                        Company <span class="text-xs">▼</span>
                    </button>
                    <ul x-show="open" x-transition class="absolute top-full left-0 mt-2 bg-white text-gray-700 rounded shadow-lg min-w-[200px] py-2 z-50">
                        <li><a href="{{ route('team') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">Team</a></li>
                        <li><a href="{{ route('jobs') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">Jobs</a></li>
                    </ul>
                </li>
                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="cursor-pointer hover:text-gray-200 transition flex items-center gap-1">
                        Products <span class="text-xs">▼</span>
                    </button>
                    <ul x-show="open" x-transition class="absolute top-full left-0 mt-2 bg-white text-gray-700 rounded shadow-lg min-w-[200px] py-2 z-50">
                        <li><a href="{{ route('products.index') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">All Products</a></li>
                        @foreach(\App\Models\Category::all() as $navCat)
                            <li><a href="{{ route('products.category', $navCat->slug) }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">{{ $navCat->name }}</a></li>
                        @endforeach
                    </ul>
                </li>

                {{-- <li class="cursor-pointer hover:text-gray-200 transition flex items-center gap-1">Development electronics <span class="text-xs">▼</span></li>
                <li class="cursor-pointer hover:text-gray-200 transition">Research and development</li> --}}
                {{-- <li class="cursor-pointer hover:text-gray-200 transition">Downloads</li> --}}
                <li>
                    <a href="{{ route('track-order') }}" class="hover:text-gray-200 transition flex items-center gap-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span class="text-xs">Track Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cart.index') }}" class="relative hover:text-gray-200 transition flex items-center gap-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        @if(count(session('cart', [])) > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ count(session('cart', [])) }}</span>
                        @endif
                    </a>
                </li>
            </ul>

            <!-- Mobile Hamburger Button & Cart -->
            <div class="md:hidden flex items-center justify-between w-full">
                <button @click="open = !open" class="text-white hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <a href="{{ route('cart.index') }}" class="relative text-white hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    @if(count(session('cart', [])) > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ count(session('cart', [])) }}</span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" class="md:hidden bg-gray-600 pb-4" @click.away="open = false">
            <ul class="flex flex-col space-y-2 text-white text-sm font-medium">
                <li class="font-semibold cursor-pointer hover:text-gray-200 transition px-4 py-2"><a href="/">Home</a></li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2"><a href="{{ route('team') }}">Team</a></li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2"><a href="{{ route('jobs') }}">Jobs</a></li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2"><a href="{{ route('products.index') }}">Products</a></li>
                {{-- <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Switchboard construction</li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Development electronics</li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Research and development</li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Downloads</li> --}}
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2"><a href="{{ route('cart.index') }}">Cart @if(count(session('cart', [])) > 0)({{ count(session('cart', [])) }})@endif</a></li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2"><a href="{{ route('track-order') }}">Track Order</a></li>
            </ul>
        </div>
    </div>
</nav>
