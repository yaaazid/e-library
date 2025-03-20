<div class="flex justify-between items-center p-6 bg-gray-900 text-white shadow-lg">
    {{-- Logo --}}
    <a href="/" class="font-extrabold text-3xl text-blue-400 hover:text-blue-300 transition">
        E-Lib
    </a>

    {{-- Navigations --}}
    <nav class="flex gap-4 items-center">
        @auth
            <span class="text-gray-300">{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-md transition">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('sign-in-form') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition">
                Sign In
            </a>
            <a href="{{ route('sign-up-form') }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-md transition">
                Sign Up
            </a>
        @endauth
    </nav>
</div>
