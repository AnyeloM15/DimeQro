<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use DataTables;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validar datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'message' => 'required|string',
            'subscribe' => 'nullable|boolean',
        ]);

        // Guardar en la base de datos
        Contact::create([
            'name' => $validated['name'],
            'contact' => $validated['contact'],
            'message' => $validated['message'],
            'subscribed' => $request->has('subscribe'),
            'status' => 'pendiente', // Por defecto, los mensajes son pendientes
        ]);

        // Redirigir a la página de agradecimiento
        return redirect()->route('thankyou');
    }

    public function markAsAttended($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = 'atendido';
        $contact->save();

        return back()->with('success', 'Mensaje marcado como atendido');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="' . $row->id . '">Editar</a> ';
                    $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Eliminar</a>';
                    return $btn;
                })
                ->addColumn('status', function($row) {
                    return $row->status == 'atendido' 
                        ? '<span class="badge bg-success">Atendido</span>' 
                        : '<span class="badge bg-warning">Pendiente</span>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.contacts.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        
        // Validar que el estado sea 'pendiente' o 'atendido'
        $request->validate([
            'status' => 'required|in:pendiente,atendido'
        ]);

        // Actualizar solo el estado del mensaje
        $contact->status = $request->status;
        $contact->save();

        return response()->json(['success' => 'Estado actualizado correctamente.']);
    }



    public function edit($id)
    {
        $contact = Contact::find($id);
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return response()->json(['success' => 'Mensaje eliminado.']);
        }

        return response()->json(['error' => 'Mensaje no encontrado.'], 404);
    }
}
