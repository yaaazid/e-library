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
<section class="p-4 flex flex-col gap-4">
    <button type="button" class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium" onclick="history.back()">
        Back
    </button>
    {{-- <a href="{{ route('book.index') }}" class="p-2 bg-blue-800 text-white rounded-md w-fit font-medium">Home</a> --}}
    
    <h1 class="text-4xl font-bold text-blue-800">{{ $book->title }}</h1>

    <div class="flex flex-col gap-4 text-xl col-span-4 border border-blue-500 p-4 rounded-lg bg-blue-500/20">
        <div>
            <h2 class="font-bold text-blue-800">Name :</h2>
            <p>{{ $user->name }}</p>
        </div>
        <div>
            <h2 class="font-bold text-blue-800">Request Date :</h2>
            <p>{{ $borrow->created_at->format('1,j F Y H:i') }}</p>
        </div>
        <div>
            <h2 class="font-bold text-blue-800">Expected Return Date :</h2>
            <p>{{ $borrow->returned_at->format('1,j F Y H:i') }}</p>
        </div>
        <div>
            <h2 class="font-bold text-blue-800">Status :</h2>
            
        </div>
    </div>

    <div class="grid grid-cols-7 gap-4">
        <img src={{ asset('storage/book-images/' . $book->image) }} alt={{ $book->title }} class="col-span-3 w-full" />

        <div class="flex flex-col gap-4 text-xl col-span-4 border border-yellow-500 p-4 rounded-lg bg-yellow-500/20">
            <div>
                <h2 class="font-bold text-blue-800">Title :</h2>
                <p>{{ $book->title }}</p>
            </div>
            <div>
                <h2 class="font-bold text-blue-800">Description :</h2>
                <p>{{ $book->description }}</p>
            </div>
            <div>
                <h2 class="font-bold text-blue-800">Total Page :</h2>
                <p>{{ $book->page_count }}</p>
            </div>
            <div>
                <h2 class="font-bold text-blue-800">Author :</h2>
                <p>{{ $book->author }}</p>
            </div>
            <div>
                <h2 class="font-bold text-blue-800">Published Year :</h2>
                <p>{{ $book->published_year }}</p>
            </div>
        </div>
    </div>
</section>
@endsection