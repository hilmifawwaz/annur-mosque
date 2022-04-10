<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\News;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class NewsController extends Controller
{
    public function get(Request $request)
    {
        $id = $request->input('id');
        $judul = $request->input('judul');
        $nama_pembuat = $request->input('nama_pembuat');
        $isi = $request->input('isi');
        $limit = $request->input('limit', 6);

        if ($id) {
            $news = News::with(['agreement'])->find($id);
            if ($news) {
                return ResponseFormatter::success([
                    $news,
                    'Berhasil'
                ]);
            } else {
                return ResponseFormatter::error([
                    null,
                    'Gagal'
                ]);
            }
        }
        $news = News::with(['agreement']);

        if ($judul) {
            $news;
        }
        if ($nama_pembuat) {
            $news;
        }

        return ResponseFormatter::success(
            $news->paginate($isi),
            'Data berhasil diambil'
        );
    }
    public function post(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'nama_pembuat' => 'required',
                'isi' => 'required'
            ]);
            $news = News::create([
                'judul' => $request->judul,
                'nama_pembuat' => $request->nama_pembuat,
                'isi' => $request->isi
            ]);
            $data = News::where('id', '=', $news->id)->get();
            if ($data) {
                return ResponseFormatter::success([
                    $news,
                    'Berhasil'
                ]);
            } else {
                return ResponseFormatter::error([
                    null,
                    'gagal'
                ]);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'gagal bro, ada yang salah',
                'error' => $error,
            ], 'Authentication Failed');
        }
    }
}
