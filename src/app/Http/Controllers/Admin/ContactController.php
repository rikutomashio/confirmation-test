<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;

class ContactController extends Controller
{
    /**
     * 一覧・検索
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // キーワード検索（名前・メール）
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        // 性別検索
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種別
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 生年月日
        if ($request->filled('birthday')) {
            $query->whereDate('birthday', $request->birthday);
        }

        // ページネーション（検索条件保持）
        $contacts = $query->paginate(10)->withQueryString();

        // セレクト用カテゴリ
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    /**
     * 詳細
     */
    public function show(Contact $contact)
    {
        return view('admin.show', compact('contact'));
    }

    /**
     * エクスポート
     */
    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }

    /**
     * 削除
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'お問い合わせを削除しました');
    }
}
