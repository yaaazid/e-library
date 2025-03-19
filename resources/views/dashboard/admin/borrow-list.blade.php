@extends('layout.app')
@section('title')
Borrow List
@endsection

@section('content')
<main class="flex flex-col gap-4 p-4">
    <h1 class="text-4xl font-bold text-blue-800">
        Dashboard Admin
    </h1>
    <!-- Table request -->
    <table>
        <thead>
            <tr class="bg-blue-800 text-white">
                <th class="p-2">No</th>
                <th class="p-2">Name</th>
                <th class="p-2">Book Title</th>
                <th class="p-2">Status</th>
                <th class="p-2">Request Date</th>
                <th class="p-2">Return Date</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($borrows->count() === 0)
            <tr class="text-center p-2">
                <td colspan="5">No Items</td>
            </tr>
            @endif
            @foreach ($borrows as $borrow)
            <tr class="border-b border-neutral-500 hover:bg-neutral-200">
                <td class="p-2">{{ $loop->index + 1 }}</td>
                <td class="p-2">{{ $borrow->user->name }}</td>
                <td class="p-2">{{ $borrow->book->title }}</td>
                <td>
                    @if ($borrow->status === 'borrowed' && $borrow->returned_at >= now())
                    <span class="p-2 text-yellow-500">Borrowing</span>
                    @elseif ($borrow->status === 'borrowed' && $borrow->returned_at->isPast())
                    <span class="p-2 text-amber-500">Overdue</span>
                    @elseif ($borrow->status === 'returned')
                    <span class="p-2 text-green-500">Returned</span>
                    @elseif ($borrow->status === 'lost')
                    <span class="p-2 text-red-500">Lost</span>
                    @endif
                </td>
                <td class="p-2">{{ $borrow->created_at->format('1,j F Y H:i') }}</td>
                <td class="p-2">{{ $borrow->returned_at->format('1,j F Y H:i') }}</td>                
                <td class="p-2 flex gap-2">
                    <a href={{ route('dashboard.show-borrow', $borrow->id) }} 
                        class="p-2 bg-blue-800 text-white rounded-md">Detail</a>

                        @if ($borrow->status === "borrowed" || $borrow->status === "lost")
                        <form action={{ route('borrow.return') }} method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $borrow->id }}">
                            <button type="submit" class="p-2 bg-green-600 text-white rounded-md w-fit font-medium">
                                Return
                            </button>
                        </form>
                        @if ($borrow->status === "borrowed")
                        <form action={{ route('borrow.lost') }} method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $borrow->id }}">
                            <button type="submit" class="p-2 bg-red-600 text-white rounded-md w-fit font-medium">
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
    <div class="flex flex-col gap-4 justify-center items-center">
            <p>
                Showing {{ $borrows->firstItem() }} to {{ $borrows->lastItem() }} of {{ $borrows->total() }}
            </p>
            <div class="flex justify-center">
                <div class="flex gap-2">
                    {{-- Previous Button --}}
                    @if ($borrows->onFirstPage())
                        <span class="p-2 border bg-slate-200 min-w-10 text-center rounded-md cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $borrows->previousPageUrl() }}"
                            class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">
                            Prev
                        </a>
                    @endif

                    {{-- Button Angka2 --}}
                    @php
                        $currentPage = $borrows->currentPage();
                        $lastPage = $borrows->lastPage();
                        $maxVisiblePages = 3;

                        if ($lastPage <= $maxVisiblePages) {
                            $startPage = 1;
                            $endPage = $lastPage;
                        } else {
                            if ($lastPage <= ceil($maxVisiblePages / 2)) {
                                $startPage = 1;
                                $endPage = $maxVisiblePages;
                            } elseif ($currentPage >= $lastPage - floor($maxVisiblePages / 2)) {
                                $startPage = $lastPage - $maxVisiblePages + 1;
                                $endPage = $lastPage;
                            } else {
                                $startPage = $currentPage - floor($maxVisiblePages / 2);
                                $endPage = $currentPage + floor($maxVisiblePages / 2);
                            }
                        }
                    @endphp

                    @if ($startPage > 1)
                        <a href="{{ $borrows->url(1) }}"
                            class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">
                            1
                        </a>
                        @if ($startPage > 2)
                            <span class="p-2 min-w-10 text-center">...</span>
                        @endif
                    @endif

                    @for ($i = $startPage; $i <= $endPage; $i++)
                        @if ($i == $currentPage)
                            <span
                                class="p-2 border bg-slate-200 min-w-10 text-center rounded-md cursor-not-allowed">{{ $i }}</span>
                        @else
                            <a href="{{ $borrows->url($i) }}"
                                class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($endPage < $lastPage)
                        @if ($endPage < $lastPage - 1)
                            <span class="p-2 min-w-10 text-center">...</span>
                        @endif
                        <a href="{{ $borrows->url($lastPage) }}"
                            class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">
                            {{$lastPage}}
                        </a>
                    @endif


                    {{-- Next Button --}}
                    @if ($borrows->hasMorePages())
                        <a href="{{ $borrows->nextPageUrl() }}"
                            class="p-2 border min-w-10 hover:bg-slate-200 text-center rounded-md">
                            Next
                        </a>
                    @else
                        <span class="p-2 border bg-slate-200 min-w-10 text-center rounded-md cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        </div>
</main>
@endsection
@section('js')
    @if (session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                // text: "TEST",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "green",
                    border: "1px solid green",
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
                        background: "red",
                        border: "1px solid red",
                    },
                    onClick: function() {}
                }).showToast();
            </script>
        @endforeach
    @endif
@endsection