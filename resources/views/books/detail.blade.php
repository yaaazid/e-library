@extends('layout.app')

@section('title')
    {{ $book->title }}
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-black/70 via-gray-700 to-gray-600 py-12 flex justify-center items-center">
        <div class="container mx-auto px-6">
            <div class="bg-black/60 text-white rounded-2xl shadow-2xl overflow-hidden transform transition">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-10">

                    <div class="flex justify-center items-center">
                        <img src="{{ asset('storage/book-images/' . $book->image) }}" alt="{{ $book->title }}"
                            class="w-full max-w-sm rounded-xl object-cover shadow-lg transition-transform duration-300 hover:scale-110">
                    </div>

                    <div class="flex flex-col justify-between">
                        <div>
                            <h1 class="text-4xl font-extrabold text-gray-400 mb-6">{{ $book->title }}</h1>

                            <div class="mb-6">
                                <h2 class="text-lg font-semibold text-gray-300 mb-2">Deskripsi:</h2>
                                <p class="text-gray-300 leading-relaxed">{{ $book->description }}</p>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-lg font-semibold text-gray-300 mb-2">Detail Buku:</h2>
                                <ul class="list-none space-y-3">
                                    <li>
                                        <span class="font-semibold text-gray-200">Penulis:</span>
                                        <span class="text-gray-400">{{ $book->author }}</span>
                                    </li>
                                    <li>
                                        <span class="font-semibold text-gray-200">Jumlah Halaman:</span>
                                        <span class="text-gray-400">{{ $book->page_count }}</span>
                                    </li>
                                    <li>
                                        <span class="font-semibold text-gray-200">Tahun Terbit:</span>
                                        <span class="text-gray-400">{{ $book->published_year }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex justify-start">
                            <button onclick="history.back()"
                                class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-lg shadow-md transition duration-300">
                                ← Kembali ke Daftar Buku
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
