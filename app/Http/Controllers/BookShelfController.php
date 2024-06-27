<?php

namespace App\Http\Controllers;

use App\Models\BookShelf;
use Illuminate\Http\Request;

class BookShelfController extends Controller
{
    public function index()
    {
        $bookShelves = BookShelf::all();
        return view('pages.book_shelves.index', compact('bookShelves'));
    }

    public function create()
    {
        return view('pages.book_shelves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        BookShelf::create($request->all());

        return redirect()->route('book_shelves.index')->with('success', 'BookShelf created successfully.');
    }

    public function edit($id)
    {
        $bookShelf = BookShelf::findOrFail($id);
        return view('pages.book_shelves.edit', compact('bookShelf'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bookShelf = BookShelf::findOrFail($id);
        $bookShelf->update($request->all());

        return redirect()->route('book_shelves.index')->with('success', 'BookShelf updated successfully.');
    }

    public function destroy($id)
    {
        $bookShelf = BookShelf::findOrFail($id);
        $bookShelf->delete();

        return redirect()->route('book_shelves.index')->with('success', 'BookShelf deleted successfully.');
    }
}
