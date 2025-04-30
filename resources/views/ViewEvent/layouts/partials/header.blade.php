<header class="fixed w-full bg-white/80 backdrop-blur-md z-50 transition-all duration-300">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center">
            <a href="#" class="flex items-center">
                <img src="{{ asset('images/logo.svg') }}" alt="{{ __('messages.event_logo_alt') }}" class="h-10">
            </a>
        </div>

        <nav class="hidden md:flex items-center space-x-8 rtl:space-x-reverse">
            <a href="#registration" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">
                {{ __('messages.registration') }}
            </a>
            <a href="#sponsors" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">
                {{ __('messages.sponsors') }}
            </a>
            <a href="#about" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">
                {{ __('messages.about_us') }}
            </a>
        </nav>

        <div class="flex items-center space-x-4 rtl:space-x-reverse">
            <div class="relative">
                <button id="language-switcher" class="flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                    <span>{{ app()->getLocale() == 'en' ? 'English' : 'العربية' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 rtl:mr-1 rtl:ml-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="language-dropdown" class="hidden absolute right-0 rtl:left-0 rtl:right-auto mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                    <a href="{{ route('language.switch', ['locale' => 'en']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">English</a>
                    <a href="{{ route('language.switch', ['locale' => 'ar']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">العربية</a>
                </div>
            </div>

            <button id="mobile-menu-button" class="md:hidden flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#registration" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                {{ __('messages.registration') }}
            </a>
            <a href="#sponsors" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                {{ __('messages.sponsors') }}
            </a>
            <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                {{ __('messages.about_us') }}
            </a>
        </div>
    </div>
</header>
