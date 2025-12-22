<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;

class ContactController extends Controller
{   // 一覧ページ
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%'.$request->keyword.'%')
              ->orWhere('last_name', 'like', '%'.$request->keyword.'%')
              ->orWhere('email', 'like', '%'.$request->keyword.'%');
        });
    }
        if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }
        $contacts = $query->paginate(10)->withQueryString();

        if ($request->filled('birthday')) {
            $contacts->where('birthday', $request->birthday);
        }

        $contacts = $contacts->get();
        $categories = Category::all();

        return view('admin.contacts.index', compact('contacts'));
    }
    // 詳細ページ
    public function show(Contact $contact)
    {
        // Contact モデルが自動で $contact に入る
        return view('admin.show', compact('contact'));
    }
    // エクスポート機能
    public function export()
    {
    return Excel::download(new ContactsExport, 'contacts.xlsx');
    }
    // 削除機能
    public function destroy(Contact $contact)
{
    $contact->delete();

    return redirect()
        ->route('admin.contacts.index')
        ->with('success', 'お問い合わせを削除しました');
}

}
