@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')

<main class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black p-10">
    <div class="max-w-6xl mx-auto bg-white bg-opacity-10 backdrop-blur-md shadow-2xl border border-gray-700 rounded-3xl p-10 text-white">

        {{-- Header Dashboard --}}
        <h1 class="text-5xl font-extrabold text-center mb-8 neon-text">
            <!-- 🚀 -->
             Dashboard Admin
        </h1>

        {{-- Navigation Buttons --}}
        <div class="flex justify-center gap-6 mb-8">
            <a href="{{ route('book.index') }}" 
                class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg hover:bg-blue-500 transition transform hover:scale-105 glow-effect">
                📚 Book List
            </a>
            <a href="{{ route('dashboard.borrow-list') }}" 
                class="px-8 py-3 bg-purple-600 text-white font-semibold rounded-full shadow-lg hover:bg-purple-500 transition transform hover:scale-105 glow-effect">
                📖 Borrow List
            </a>
        </div>

        {{-- Table Section --}}
        <div class="overflow-x-auto bg-black bg-opacity-20 backdrop-blur-lg rounded-xl border border-gray-700 shadow-md">
            <table class="min-w-full border-collapse w-full text-white">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-700 to-purple-700 text-white">
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Name</th>
                        <th class="px-6 py-4 text-left">Book Title</th>
                        <th class="px-6 py-4 text-left">Request Date</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pendingBorrows->count() === 0)
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-400">🚀 No Pending Requests</td>
                        </tr>
                    @endif

                    @foreach ($pendingBorrows as $pending)
                        <tr class="border-b border-gray-600 hover:bg-gray-800 transition">
                            <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                            <td class="px-6 py-4">{{ $pending->user->name }}</td>
                            <td class="px-6 py-4">{{ $pending->book->title }}</td>
                            <td class="px-6 py-4">{{ $pending->created_at->format('l, j F Y H:i') }}</td>
                            <td class="px-6 py-4 flex justify-center gap-4">
                                {{-- Accept Button --}}
                                <form action="{{ route('borrow.accept') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $pending->id }}">
                                    <button type="submit"
                                        class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-400 transition transform hover:scale-105 glow-effect">
                                        ✅ Accept
                                    </button>
                                </form>

                                {{-- Decline Button --}}
                                <form action="{{ route('borrow.decline') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $pending->id }}">
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-400 transition transform hover:scale-105 glow-effect">
                                        ❌ Decline
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</main>

@endsection

@section('js')
@if (session('success'))
<script>
    Toastify({
        text: "{{ session('success') }}",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "linear-gradient(to right, #22c55e, #16a34a)",
            color: "#fff",
            borderRadius: "10px",
            padding: "12px",
            boxShadow: "0px 0px 15px rgba(34, 197, 94, 0.7)",
        },
        onClick: function() {}
    }).showToast();
</script>
@endif
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
            background: "linear-gradient(to right, #ef4444, #dc2626)",
            color: "#fff",
            borderRadius: "10px",
            padding: "12px",
            boxShadow: "0px 0px 15px rgba(239, 68, 68, 0.7)",
        },
        onClick: function() {}
    }).showToast();
</script>
@endforeach
@endif
@endsection
