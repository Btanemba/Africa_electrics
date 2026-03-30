<footer class="bg-gray-800 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-white font-semibold mb-4">Africa Electrics</h3>
                <p class="text-sm text-gray-400">
                    Leading the way in electrical solutions and sustainable energy for Africa.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a></li>
                    <li><a href="/" class="hover:text-white transition">Home</a></li>
                    <li><a href="#" class="hover:text-white transition">About</a></li>
                    <li><a href="#" class="hover:text-white transition">Services</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-white font-semibold mb-4">Support</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition">Documentation</a></li>
                    <li><a href="#" class="hover:text-white transition">Blog</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-white font-semibold mb-4">Contact</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start">
                        <span class="mr-2">📧</span>
                        <span>info@africaelectrics.com</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2">📱</span>
                        <span>+1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2">📍</span>
                        <span>Africa</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-700 mt-8 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-400">
                    &copy; {{ date('Y') }} Africa Electrics. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white transition text-sm">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>
