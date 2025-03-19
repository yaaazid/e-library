<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == "admin") {
            $pendingBorrows = Borrow::where('status', 'pending')->get();

            return view('dashboard.admin.dashboard', compact('pendingBorrows'));
        }

        $books = Book::latest()->paginate(10);
        return view('dashboard.user.dashboard', compact('books'));
    }
    public function borrow(Request $request)
    {
        $book = Book::where('slug', $request->slug)->first();
        if (!$book) {
            return redirect()->route('dashboard.index')->with('error', 'Book not found');
        }

        return view('dashboard.user.borrow', compact('book'));
    }
    public function borrowList(Request $request)
    {
        $borrows = Borrow::latest()->whereNotIn('status',  ['pending', 'rejected'] )->paginate(10);
        foreach($borrows as $borrow){
            $borrow->returned_at = Carbon::parse($borrow->returned_at);
            $borrow->created_at = Carbon::parse($borrow->updated_at);
        }
        return view('dashboard.admin.borrow-list', compact('borrows'));
    }
    public function showBorrow(Request $request)
    {
        $borrow = Borrow::find($request->id);
        if (!$borrow) {
            return redirect()->route('dashboard.borrow-list')->with('error', 'Borrow not found');
        }
        return view('dashboard.admin.show-borrow', compact('borrow'));
    }
}