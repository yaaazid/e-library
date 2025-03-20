@extends('layout.app')

@section('title', 'Books')

@section('content')
<section class="p-10 min-h-screen bg-gray-900 text-white flex justify-center items-center">
    <div class="max-w-6xl w-full">
        
        {{-- Header & Button --}}
        <div class="flex flex-col lg:flex-row justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-center lg:text-left">📚 Book List</h1>
            <a href="{{ route('book.create') }}" 
                class="mt-4 lg:mt-0 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 transition transform hover:scale-105">
                ➕ Add Book
            </a>
        </div>

        {{-- Grid Layout untuk Buku --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($books as $book)
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-md p-4 rounded-xl shadow-lg hover:scale-105 transition">
                    <img src="{{ asset('storage/book-images/' . $book->image) }}" 
                        alt="{{ $book->title }}" 
                        class="w-full h-48 object-cover rounded-md border border-gray-700">
                    <h2 class="mt-4 text-lg font-semibold text-center">{{ $book->title }}</h2>
                    <p class="text-sm text-gray-400 text-center">{{ $book->author }} - {{ $book->published_year }}</p>

                    {{-- Actions --}}
                    <div class="flex justify-center gap-2 mt-4">
                        <a href="{{ route('book.show', $book->slug) }}" 
                            class="px-3 py-1 text-sm bg-gray-600 rounded hover:bg-gray-500">Detail</a>
                        <a href="{{ route('book.edit', $book->slug) }}" 
                            class="px-3 py-1 text-sm bg-blue-600 rounded hover:bg-blue-500">Edit</a>
                        <form action="{{ route('book.delete', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-sm bg-red-600 rounded hover:bg-red-500">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 col-span-full">🚀 No Books Available</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="flex justify-between items-center mt-8 text-gray-400">
            <p>Showing {{ $books->firstItem() }} - {{ $books->lastItem() }} of {{ $books->total() }}</p>
            <div class="flex gap-2">
                @if (!$books->onFirstPage())
                    <a href="{{ $books->previousPageUrl() }}" class="px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">Prev</a>
                @endif
                @for ($i = 1; $i <= $books->lastPage(); $i++)
                    <a href="{{ $books->url($i) }}" class="px-4 py-2 {{ $books->currentPage() == $i ? 'bg-blue-600 text-white' : 'bg-gray-700 hover:bg-gray-600' }} rounded">
                        {{ $i }}
                    </a>
                @endfor
                @if ($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}" class="px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">Next</a>
                @endif
            </div>
        </div>

    </div>
</section>
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
            borderRadius: "8px",
            padding: "10px",
            boxShadow: "0px 0px 10px rgba(34, 197, 94, 0.5)",
        },
    }).showToast();
</script>
@endif
@endsection
