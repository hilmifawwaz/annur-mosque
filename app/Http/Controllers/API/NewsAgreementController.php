<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\NewsAgreement;
use Illuminate\Http\Request;

class NewsAgreementController extends Controller
{
    public function get(Request $request)
    {
        $id = $request->input('id');
        $news_id = $request->input('news_id');
        $status = $request->input('status');

        if ($id) {
            $agreement = NewsAgreement::with(['news'])->find($id);
            if ($agreement) {
                return ResponseFormatter::success([
                    $agreement,
                    'Berhasil'
                ]);
            } else {
                return ResponseFormatter::error([
                    null,
                    'Gagal cuyy'
                ]);
            }
        }
        $agreement = NewsAgreement::with(['news']);

        if ($news_id) {
            $agreement;
        }
        return ResponseFormatter::success(
            $agreement->paginate($status),
            'Data berhasil diambil'
        );
    }
}
