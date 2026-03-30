<div class="top-header bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.jpg') }}" class="h-10" alt="Logo">
            <span class="text-xl font-semibold text-gray-700">AFRICA ELECTRICS</span>
        </div>

        <!-- Contact Info -->
        <div class="hidden md:flex items-center space-x-6 text-sm text-gray-600">
            <span>Telephone:+231886720189</span>
            <span>Email: comingsoon@africaelectrics.com</span>
            <span class="font-bold">DE | <span class="text-red-600">EN</span></span>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<!-- NAVBAR -->
<nav class="navbar bg-gray-500 w-full" x-data="{ open: false }">
    <div class="w-full px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Desktop Menu -->
            <ul class="hidden md:flex justify-center items-center text-white text-sm font-medium w-full gap-12">
                <li class="font-semibold cursor-pointer hover:text-gray-200 transition">Home</li>
                <li class="cursor-pointer hover:text-gray-200 transition flex items-center gap-1">Company <span class="text-xs">▼</span></li>
                <li class="cursor-pointer hover:text-gray-200 transition flex items-center gap-1">Work safety <span class="text-xs">▼</span></li>
                <li class="cursor-pointer hover:text-gray-200 transition">Switchboard construction</li>
                <li class="cursor-pointer hover:text-gray-200 transition flex items-center gap-1">Development electronics <span class="text-xs">▼</span></li>
                <li class="cursor-pointer hover:text-gray-200 transition">Research and development</li>
                <li class="cursor-pointer hover:text-gray-200 transition">Downloads</li>
            </ul>

            <!-- Mobile Hamburger Button -->
            <button @click="open = !open" class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" class="md:hidden bg-gray-600 pb-4" @click.away="open = false">
            <ul class="flex flex-col space-y-2 text-white text-sm font-medium">
                <li class="font-semibold cursor-pointer hover:text-gray-200 transition px-4 py-2">Home</li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Company</li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Work safety</li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Switchboard construction</li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Development electronics</li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Research and development</li>
                <li class="cursor-pointer hover:text-gray-200 transition px-4 py-2">Downloads</li>
            </ul>
        </div>
    </div>
</nav>
