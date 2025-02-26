<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Filtrar solo usuarios que no han sido eliminados
            $data = User::whereNull('deleted_at')->latest()->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->role == 'admin') {
                        return '<span class="badge bg-secondary">No editable</span>';
                    }

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="' . $row->id . '">Editar</a> ';
                    $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Eliminar</a>';
                    return $btn;
                })
                ->addColumn('role', function ($row) {
                    return '<span class="badge bg-' . ($row->role == 'admin' ? 'success' : 'warning') . '">' . ucfirst($row->role) . '</span>';
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($request->input('user_id'))],
            'phone' => 'nullable|string|max:15',
            'country_code' => 'required|string|max:10',
            'password' => $request->input('user_id') ? 'nullable|min:8' : 'required|min:8',
            'role' => 'required|in:cliente',
        ]);

        $user = User::find($request->input('user_id')) ?? new User();
        
        if ($user->exists && $user->role == 'admin') {
            return response()->json(['error' => 'No puedes modificar un usuario administrador.'], 403);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country_code = $request->country_code;
        $user->role = 'cliente';

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['success' => 'Usuario guardado correctamente.']);
    }

    public function edit($id)
    {
        $user = User::find($id);

        if ($user->role == 'admin') {
            return response()->json(['error' => 'No puedes editar un usuario administrador.'], 403);
        }

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        if ($user->role == 'admin') {
            return response()->json(['error' => 'No puedes eliminar un usuario administrador.'], 403);
        }

        // En lugar de eliminar, usamos Soft Deletes
        $user->delete();

        return response()->json(['success' => 'Usuario desactivado correctamente.']);
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        $user->restore();

        return response()->json(['success' => 'Usuario restaurado correctamente.']);
    }
}
