<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use DataTables;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="' . $row->id . '">Editar</a> ';
                    $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Eliminar</a>';
                    return $btn;
                })
                ->addColumn('active', function($row) {
                    if ($row->active) {
                        return '<span class="badge bg-success">Activo</span>';
                    } else {
                        return '<span class="badge bg-danger">Inactivo</span>';
                    }
                })
                ->rawColumns(['action','active'])
                ->make(true);
        }
        return view('admin.brands.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active' => 'required|boolean'
        ]);
    
        $brand_id = $request->input('brand_id');  // Asegúrate de enviar este campo desde el formulario.
        $brand = Brand::find($brand_id);
    
        if (!$brand) {
            $brand = new Brand();
        }
    
        $brand->name = $request->name;
        $brand->active = $request->active;
    
        if ($request->hasFile('logo')) {
            // Eliminar la imagen anterior si existe y está actualizando una marca existente
            if ($brand->logo && file_exists(public_path($brand->logo))) {
                unlink(public_path($brand->logo));
            }
    
            $filename = time() . '_' . $request->logo->getClientOriginalName();
            $destinationPath = public_path('/assets/admin/brands');
            $request->logo->move($destinationPath, $filename);
            $brand->logo = 'assets/admin/brands/' . $filename;
        }
    
        $brand->save();
    
        return response()->json(['success' => $brand_id ? 'Marca actualizada exitosamente.' : 'Marca creada exitosamente.']);
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return response()->json($brand);
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $brand->active = 0;  // Marcar como inactivo en lugar de eliminar
            $brand->save();      // Guardar el cambio
            return response()->json(['success' => 'Marca desactivada exitosamente.']);
        }

        return response()->json(['error' => 'Marca no encontrada.'], 404);
    }

}
