<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactFormController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();
        $contact = $request->session()->get('contact', []); 
        return view('index', compact('categories', 'contact'));
    }



    public function showForm(Request $request){
    $categories = Category::all();
    $contact = $request->session()->get('contact', []); 

    return view('confirm', compact('categories', 'contact'));
}

    

    public function confirm(ContactRequest $request){
    $contact = $request->only([
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel1',
        'tel2',
        'tel3',
        'address',
        'building',
        'category_id',
        'detail'
    ]);

    $category = Category::find($contact['category_id']);
    $contact['category_name'] = $category ? $category->content : '';

    $request->session()->put('contact', $contact);
    
    return view('confirm', compact('contact'));
    }



    public function store(Request $request){

    $contact = $request->session()->get('contact');

    $contact['tel'] =
        $contact['tel1'] . '-' .
        $contact['tel2'] . '-' .
        $contact['tel3'];

    unset($contact['tel1'], $contact['tel2'], $contact['tel3'], $contact['category_name']);

    Contact::create($contact);

    $request->session()->forget('contact');

    return view('thanks');
    }




    public function thanks(){
        return view('thanks');
    }

}
