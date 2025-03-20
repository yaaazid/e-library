@extends('layout.app')
@section('title')
Borrow List
@endsection

@section('content')
<main class="flex flex-col gap-6 p-6 min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900 text-white">
    <h1 class="text-4xl font-extrabold text-center text-cyan-400 drop-shadow-lg animate-pulse">
        📚 Borrow List - Admin Dashboard
    </h1>

    <!-- Table Request -->
    <div class="overflow-x-auto bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl shadow-2xl border border-gray-700">
        <table class="w-full text-center border-collapse rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gradient-to-r from-cyan-500 to-blue-700 text-white text-lg">
                    <th class="p-4">No</th>
                    <th class="p-4">Name</th>
                    <th class="p-4">Book Title</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Request Date</th>
                    <th class="p-4">Return Date</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900 text-white text-md">
                @if ($borrows->count() === 0)
                <tr>
                    <td colspan="7" class="p-6 text-gray-400 text-lg font-semibold">No Items</td>
                </tr>
                @endif
                @foreach ($borrows as $borrow)
                <tr class="border-b border-gray-600 hover:bg-cyan-800 transition duration-300 ease-in-out">
                    <td class="p-4 font-medium">{{ $loop->index + 1 }}</td>
                    <td class="p-4">{{ $borrow->user->name }}</td>
                    <td class="p-4">{{ $borrow->book->title }}</td>
                    <td class="p-4">
                        @if ($borrow->status === 'borrowed' && $borrow->returned_at >= now())
                        <span class="px-3 py-1 text-yellow-400 font-semibold rounded-lg bg-yellow-900 shadow-md">Borrowing</span>
                        @elseif ($borrow->status === 'borrowed' && $borrow->returned_at->isPast())
                        <span class="px-3 py-1 text-orange-400 font-semibold rounded-lg bg-orange-900 shadow-md">Overdue</span>
                        @elseif ($borrow->status === 'returned')
                        <span class="px-3 py-1 text-green-400 font-semibold rounded-lg bg-green-900 shadow-md">Returned</span>
                        @elseif ($borrow->status === 'lost')
                        <span class="px-3 py-1 text-red-400 font-semibold rounded-lg bg-red-900 shadow-md">Lost</span>
                        @endif
                    </td>
                    <td class="p-4">{{ $borrow->created_at->format('d M Y H:i') }}</td>
                    <td class="p-4">{{ $borrow->returned_at->format('d M Y H:i') }}</td>
                    <td class="p-4 flex gap-3 justify-center">
                        <a href="{{ route('dashboard.show-borrow', $borrow->id) }}" 
                            class="px-4 py-2 bg-cyan-600 text-white rounded-lg shadow-lg hover:bg-cyan-500 transition">
                            Detail
                        </a>

                        @if ($borrow->status === "borrowed" || $borrow->status === "lost")
                        <form action="{{ route('borrow.return') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $borrow->id }}">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-lg hover:bg-green-500 transition">
                                Return
                            </button>
                        </form>
                        @if ($borrow->status === "borrowed")
                        <form action="{{ route('borrow.lost') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $borrow->id }}">
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-lg hover:bg-red-500 transition">
                                Lost
                            </button>
                        </form>
                        @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
        style: {
            background: "linear-gradient(to right, #00c9ff, #92fe9d)",
            borderRadius: "10px",
            boxShadow: "0 0 10px #00c9ff",
        },
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
        style: {
            background: "linear-gradient(to right, #ff416c, #ff4b2b)",
            borderRadius: "10px",
            boxShadow: "0 0 10px #ff416c",
        },
    }).showToast();
</script>
@endforeach
@endif
@endsection
