@extends('layout.app')

@section('title')
    Sign In
@endsection

@section('content')

<main class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-300 via-gray-400 to-gray-900 p-6">
    <div class="w-full max-w-md bg-black/80 opacity-80 text-white rounded-3xl shadow-2xl p-8 ">
        
        <h1 class="text-center text-4xl font-extrabold text-gray-400 tracking-wide">Welcome Back</h1>
        <p class="text-center text-gray-300 mt-2">Sign in to continue</p>

        <form action="{{ route('login') }}" method="POST" class="mt-6 space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="w-full py-3 px-6 bg-gray-600 hover:bg-gray-800 text-white font-semibold rounded-full shadow-md transition-transform transform hover:scale-105">
                    Continue
                </button>
            </div>
        </form>

        <p class="text-center text-gray-400 mt-6">
            Don't have an account? 
            <a href="{{ route('sign-up-form') }}" class="text-gray-200 hover:underline">Sign Up</a>
        </p>
    </div>
</main>

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
