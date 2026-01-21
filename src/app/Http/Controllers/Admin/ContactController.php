<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    public function index(Request $request){
    $query = Contact::with('category');

    if ($request->filled('name')) {
    $query->where(function ($q) use ($request) {
        $q->where('last_name', 'like', '%' . $request->name . '%')
          ->orWhere('first_name', 'like', '%' . $request->name . '%')
          ->orWhere('email', 'like', '%' . $request->name . '%')
          ->orWhereRaw(
              "CONCAT(last_name, first_name) LIKE ?",
              ['%' . $request->name . '%']
          );
    });
    }

    if ($request->filled('gender')) {
    $query->where('gender', $request->gender);
    }

    if ($request->filled('category_id')) {
    $query->where('category_id', $request->category_id);
    }

    if ($request->filled('date')) {
    $query->whereDate('created_at', $request->date);
    }

    $contacts = $query
        ->orderBy('created_at', 'desc')
        ->paginate(7)
        ->appends($request->query());

    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
}

    public function export(){
    $contacts = Contact::with('category')->orderBy('created_at', 'desc')->get();

    return response()->streamDownload(function () use ($contacts) {
        $handle = fopen('php://output', 'w');

        fputcsv($handle, [
            'お名前',
            '性別',
            'メールアドレス',
            'お問い合わせの種類',
        ]);

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender,
                $contact->email,
                $contact->category->content ?? '',
            ]);
        }

        fclose($handle);
    }, 'contacts.csv', ['Content-Type' => 'text/csv']);
}

    public function show($id){
    $contact = Contact::with('category')->findOrFail($id);

    return view('admin_detail', compact('contact'));
    }

    public function destroy(Request $request){
    $id = $request->input('id');
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->route('admin');
}

}
