<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
            'cover_image' => 'required|image|max:2048',
            'file_path' => 'required|file|mimes:pdf,epub|max:10240'
        ]);

        $book = new Book($validated);
        $book->seller_id = auth()->id();
        $book->cover_image = $request->file('cover_image')->store('covers');
        $book->file_path = $request->file('file_path')->store('books');
        $book->save();

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
            'featured' => 'sometimes|boolean'
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        Storage::delete([$book->cover_image, $book->file_path]);
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }
}