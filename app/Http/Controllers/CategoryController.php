<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
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

        return view('admin.categories.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active' => 'required|boolean'
        ]);

        $category_id = $request->input('category_id');
        $category = Category::find($category_id);

        if (!$category) {
            $category = new Category();
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->active = $request->active;

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->image->getClientOriginalName();
            $destinationPath = public_path('/assets/admin/categories');
            $request->image->move($destinationPath, $filename);
            $category->image = 'assets/admin/categories/' . $filename;
        }

        $category->save();

        if ($category_id) {
            return response()->json(['success' => 'Categoría actualizada correctamente.']);
        } else {
            return response()->json(['success' => 'Categoría creada correctamente.']);
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Categoría no encontrada.'], 404);
        }
        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            // Establece el campo 'active' en 0 para un borrado lógico
            $category->active = 0;
            $category->save(); // Guarda el cambio en la base de datos

            return response()->json(['success' => 'Categoría desactivada exitosamente.']);
        }

        return response()->json(['error' => 'Categoría no encontrada.'], 404);
    }

}
