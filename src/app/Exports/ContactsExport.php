<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Contact::with('category')->get()->map(function($contact) {
            return [
                '名前' => $contact->last_name . ' ' . $contact->first_name,
                '性別' => $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                'メール' => $contact->email,
                'お問い合わせ種別' => $contact->category->category_name ?? '未設定',
                '内容' => $contact->content,
            ];
        });
    }

    public function headings(): array
    {
        return ['名前', '性別', 'メール', 'お問い合わせ種別', '内容'];
    }
}
