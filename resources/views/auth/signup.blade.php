@extends('layout.app')

@section('title')
    Sign Up
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-300 via-gray-400 to-gray-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-black/80 text-white rounded-3xl shadow-2xl p-10 transform transition">

            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-400 tracking-wide">Create Account</h2>
                <p class="mt-2 text-gray-300">Join us and explore unlimited books</p>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="space-y-4">

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                        <input id="name" name="name" type="text" required
                            class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email address</label>
                        <input id="email" name="email" type="email" required
                            class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <input id="password" name="password" type="password" required
                            class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="w-full py-3 px-6 bg-gray-600 hover:bg-gray-800 text-white font-semibold rounded-full shadow-md transition-transform transform hover:scale-105">
                        Sign Up
                    </button>
                </div>
            </form>

            <p class="text-center text-gray-400 mt-4">
                Already have an account? 
                <a href="{{ route('sign-in-form') }}" class="text-gray-00 hover:underline">Sign In</a>
            </p>
        </div>
    </div>
@endsection

@section('js')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Toastify({
                    text: "{{ $error }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "red",
                        border: "1px solid red",
                        borderRadius: "8px",
                        padding: "10px"
                    },
                    onClick: function() {}
                }).showToast();
            </script>
        @endforeach
    @endif
@endsection
