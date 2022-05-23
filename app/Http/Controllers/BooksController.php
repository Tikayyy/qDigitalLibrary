<?php

namespace App\Http\Controllers;

use App\Contracts\BookInterface;
use App\Models\User;
use App\Models\UserBook;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    private function getUser()
    {
        return User::where('remember_token', hash('md5', request()->cookie('library-token')))->first();
    }

    public function search(Request $request, BookInterface $service)
    {
        $request->validate([
            'search' => 'nullable|string'
        ]);
        $search = $request->get('search');
        $books = [];

        if ($search) {
            try {
                $books = $service->search($search);
            } catch (Exception $e) {
                return redirect()->back()->withErrors($e->getMessage());
            }
        }

        return view('pages.books-search', compact('books'));
    }

    public function library(Request $request)
    {
        $user = self::getUser();
        $books = $user->books;
        if ($request->get('favorite')) {
            $books = $books->where('favorite', true);
        }

        return view('pages.books-library', compact('books'));
    }

    public function info(BookInterface $service, $book_id)
    {
        $user = self::getUser();
        $check_book = $user->books->where('id', $book_id)->first();
        if (!$check_book) {
            return redirect()->back()->withErrors('This book isn`t added');
        }

        try {
            $book = $service->info($check_book->book_id);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return view('pages.book-info', compact('book', 'book_id'));
    }

    public function add(BookInterface $service, $book_id)
    {
        $user = self::getUser();
        $check_book = $user->books->where('book_id', $book_id)->first();
        if ($check_book) {
            return redirect()->back()->withErrors('This book has been already added');
        }

        try {
            $book = $service->info($book_id);

            $user_book = new UserBook();

            $user_book->user_id = $user->id;
            $user_book->book_id = $book->id;
            $user_book->title = $book->volumeInfo->title;

            $user_book->save();

            return redirect()->back()->with('success', 'Book successfully added in your library');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($book_id)
    {
        $user = self::getUser();
        $book = $user->books->where('id', $book_id)->first();
        if (!$book) {
            return redirect()->back()->withErrors('This book isn`t in the library');
        }

        try {
            $book->delete();
            return redirect()->back()->with('success', 'Book successfully deleted from your library');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function changeFavorite($book_id)
    {
        $user = self::getUser();
        $book = $user->books->where('id', $book_id)->first();
        if (!$book) {
            return redirect()->back()->withErrors('This book isn`t in the library');
        }

        try {
            $book->favorite = !$book->favorite;
            $book->save();
            return redirect()->back()->with('success', 'Book status successfully changed');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
