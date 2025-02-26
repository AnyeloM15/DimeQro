<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use DataTables;

class FAQController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FAQ::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-warning btn-sm">Editar</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Eliminar</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.faqs.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        FAQ::updateOrCreate(
            ['id' => $request->faq_id],
            ['question' => $request->question, 'answer' => $request->answer]
        );

        return response()->json(['success' => 'Pregunta frecuente guardada con éxito.']);
    }

    public function edit($id)
    {
        $faq = FAQ::find($id);
        return response()->json($faq);
    }

    public function destroy($id)
    {
        FAQ::find($id)->delete();
        return response()->json(['success' => 'Pregunta frecuente eliminada con éxito.']);
    }
}
