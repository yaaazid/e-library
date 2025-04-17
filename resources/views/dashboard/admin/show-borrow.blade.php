@extends('layout.app')

@section('title')
    {{ $borrow->book->title }} by {{ $borrow->user->name }}
@endsection

@php
$book = $borrow->book;
$user = $borrow->user;
$borrow->returned_at = Illuminate\Support\Carbon::parse($borrow->returned_at);
@endphp

@section('content')
<section class="p-6 flex flex-col gap-6 min-h-screen bg-gradient-to-br from-black/70 via-gray-700 to-gray-800 text-white">
    <button type="button" class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow-lg hover:bg-gray-500 transition" onclick="history.back()">
        Back
    </button>
    
    <h1 class="text-5xl font-extrabold text-center text-gray-400 drop-shadow-lg">{{ $book->title }}</h1>

    <div class="flex flex-col gap-6 text-xl border border-gray-400 p-6 rounded-xl bg-white bg-opacity-10 backdrop-blur-lg shadow-2xl">
        <div>
            <h2 class="font-bold text-gray-300"> Name:</h2>
            <p class="text-gray-100">{{ $user->name }}</p>
        </div>
        <div>
            <h2 class="font-bold text-gray-300"> Request Date:</h2>
            <p class="text-gray-100">{{ $borrow->created_at->format('d M Y H:i') }}</p>
        </div>
        <div>
            <h2 class="font-bold text-gray-300"> Expected Return Date:</h2>
            <p class="text-gray-100">{{ $borrow->returned_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-7 gap-6">
        <div class="col-span-3 flex justify-center">
            <img src={{ asset('storage/book-images/' . $book->image) }} alt={{ $book->title }} class="rounded-xl shadow-lg w-full max-w-md border border-gray-700" />
        </div>

        <div class="flex flex-col gap-6 text-xl col-span-4 border border-gray-400 p-6 rounded-xl bg-white bg-opacity-10 backdrop-blur-lg shadow-2xl">
            <div>
                <h2 class="font-bold text-gray-800"> Title:</h2>
                <p class="text-gray-100">{{ $book->title }}</p>
            </div>
            <div>
                <h2 class="font-bold text-gray-800"> Description:</h2>
                <p class="text-gray-100">{{ $book->description }}</p>
            </div>
            <div>
                <h2 class="font-bold text-gray-800"> Total Pages:</h2>
                <p class="text-gray-100">{{ $book->page_count }}</p>
            </div>
            <div>
                <h2 class="font-bold text-gray-800"> Author:</h2>
                <p class="text-gray-100">{{ $book->author }}</p>
            </div>
            <div>
                <h2 class="font-bold text-gray-800"> Published Year:</h2>
                <p class="text-gray-100">{{ $book->published_year }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
