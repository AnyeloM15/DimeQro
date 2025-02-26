<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subcategory::with('category')->latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category', function ($row) {
                        return $row->category->name ?? 'Sin categoría';
                    })
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
                    ->addColumn('image', function ($row) {
                        if (!empty($row->image)) {
                            $imageUrl = url("public/{$row->image}");
                            return "<img src='{$imageUrl}' height='50' alt='Imagen de categoría'>";
                        } else {
                            return "Sin imagen";
                        }
                    })
                    ->rawColumns(['action','active','image'])
                    ->make(true);
        }
        $categories = Category::all();
        return view('admin.subcategories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active' => 'required|boolean'
        ]);
    
        $subcategory_id = $request->input('subcategory_id');
        $subcategory = Subcategory::find($subcategory_id);
    
        if (!$subcategory) {
            $subcategory = new Subcategory();
        }
    
        $subcategory->name = $request->name;
        $subcategory->description = $request->description;
        $subcategory->category_id = $request->category_id;
        $subcategory->active = $request->active;
    
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($subcategory->image && file_exists(public_path($subcategory->image))) {
                unlink(public_path($subcategory->image));
            }
    
            $filename = time() . '_' . $request->image->getClientOriginalName();
            $destinationPath = public_path('/assets/admin/subcategories');
            $request->image->move($destinationPath, $filename);
            $subcategory->image = 'assets/admin/subcategories/' . $filename;
        }
    
        $subcategory->save();
    
        if ($subcategory_id) {
            return response()->json(['success' => 'Subcategoría actualizada exitosamente.']);
        } else {
            return response()->json(['success' => 'Subcategoría creada exitosamente.']);
        }
    }

    public function edit($id)
    {
        $subcategory = Subcategory::with('category')->find($id);
        return response()->json($subcategory);
    }


    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        if ($subcategory) {
            $subcategory->active = 0;  // Marcar como inactivo en lugar de eliminar
            $subcategory->save();      // Guardar el cambio
            return response()->json(['success' => 'Subcategoría desactivada exitosamente.']);
        }

        return response()->json(['error' => 'Subcategoría no encontrada.'], 404);
    }

}
