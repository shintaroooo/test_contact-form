<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    /* 管理画面トップ（一覧表示）*/
    public function admin()
    {
        $contacts = Contact::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $categories = Category::all();

        return view('admin.admin', compact('contacts', 'categories'));
    }

    /* 検索処理 */
    public function search(Request $request)
    {
        $query = Contact::with('category');

        // 名前 or メールアドレス
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        // 性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // お問い合わせの種類
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(7);
        $categories = Category::all();

        return view('admin.search', compact('contacts', 'categories'));
    }

    /* 詳細表示 */
    public function detail($id)
    {
        $contact = Contact::with('category')->findOrFail($id);

        return response()->json([
            'name' => $contact->last_name . ' ' . $contact->first_name,
            'gender' => $contact->gender_text,
            'email' => $contact->email,
            'tel' => $contact->tel,
            'address' => $contact->address,
            'building' => $contact->building,
            'category' => $contact->category->content ?? '',
            'detail' => $contact->detail,
        ]);
    }

    /* 削除処理 */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return view('admin.delete');
    }
    /* CSVエクスポート（仮実装） */
    public function export(Request $request)
    {
        $contacts = Contact::with('category')
        ->when($request->keyword, function ($q) use ($request) {
            $q->where(function ($sub) use ($request) {
                $sub->where('last_name', 'like', "%{$request->keyword}%")
                  ->orWhere('first_name', 'like', "%{$request->keyword}%")
                  ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        })
        ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
        ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
        ->get();

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            // BOM付与（Excelで文字化け防止）
            fwrite($handle, "\xEF\xBB\xBF");
            // ヘッダー行
            fputcsv($handle, [
                'お名前', '性別', 'メールアドレス', '電話番号',
                '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容',
            ]);

            // データ行
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->gender_text,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '',
                    $contact->detail,
                ]);
            }
            fclose($handle);
        });

        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', "attachment; filename={$filename}");
        return $response;
    }
    /* パスワードリセット画面表示 */
    public function reset()
    {
        return view('admin.reset');
}
}