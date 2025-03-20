@extends('layout.app')

@section('title')
    Edit Book : {{ $book->title }}
@endsection

@section('content')
<section class="p-8 min-h-screen flex justify-center items-center bg-gray-900 text-white">
    <div class="max-w-3xl w-full bg-gray-800 bg-opacity-40 backdrop-blur-lg p-6 rounded-xl shadow-lg">
        
        {{-- Header --}}
        <h1 class="text-3xl font-bold text-center text-blue-400 mb-6">📖 Edit Book</h1>

        {{-- Error Messages --}}
        @if ($errors->any())
        <div class="space-y-2 mb-4">
            @foreach ($errors->all() as $error)
            <div class="p-3 bg-red-500 text-white rounded-md flex items-center gap-2">
                ⚠️ <span>{{ $error }}</span>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('book.update' , $book->slug ) }}" method="post" 
            class="flex flex-col gap-5" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="font-bold text-blue-300">Title</label>
                <input type="text" name="title" id="title" class="w-full p-3 mt-1 bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-md" 
                    value="{{ $book->title }}">
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="font-bold text-blue-300">Description</label>
                <textarea name="description" id="description" class="w-full p-3 mt-1 bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-md">{{ $book->description }}</textarea>
            </div>

            {{-- Pages --}}
            <div>
                <label for="page_count" class="font-bold text-blue-300">Pages</label>
                <input type="number" name="page_count" id="page_count" class="w-full p-3 mt-1 bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-md" 
                    value="{{ $book->page_count }}">
            </div>

            {{-- Author --}}
            <div>
                <label for="author" class="font-bold text-blue-300">Author</label>
                <input type="text" name="author" id="author" class="w-full p-3 mt-1 bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-md" 
                    value="{{ $book->author }}">
            </div>

            {{-- Year --}}
            <div>
                <label for="published_year" class="font-bold text-blue-300">Year</label>
                <input type="number" name="published_year" id="published_year" class="w-full p-3 mt-1 bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-md" 
                    value="{{ $book->published_year }}">
            </div>

            {{-- Image Upload --}}
            <div>
                <label for="image" class="font-bold text-blue-300">Image</label>
                @if ($book->image)
                    <div class="flex justify-center my-3">
                        <img src="{{ asset('storage/book-images/' . $book->image) }}" alt="{{ $book->title }}" class="w-40 h-40 object-cover rounded-lg border border-gray-700 shadow-md">
                    </div>
                @else
                    <p class="text-gray-400 text-center">No image</p>
                @endif
                <input type="file" accept="image/*" name="image" id="image" class="w-full p-3 mt-1 bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-md">
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="w-full p-4 bg-blue-600 text-white font-medium rounded-lg shadow-lg hover:bg-blue-500 transition transform hover:scale-105">
                ✨ Update Book
            </button>
        </form>

    </div>
</section>
@endsection
