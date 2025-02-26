<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    // Muestra la vista de edición con los datos actuales
    public function edit()
    {
        $settings = SiteSetting::first();
        return view('admin.settings.index', compact('settings'));
    }

    // Actualiza la configuración del sitio
    public function update(Request $request)
    {
        $settings = SiteSetting::first() ?? new SiteSetting;

        // Validar datos de entrada
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'terms' => 'nullable|string',
            'refund_policy' => 'nullable|string',
            'shipping_policy' => 'nullable|string',
            'cookie_policy' => 'nullable|string',
            'warranty_policy' => 'nullable|string',
            'payment_methods' => 'nullable|string',
            'security_policy' => 'nullable|string',
            'promotions' => 'nullable|string',
            
        ]);

        // Procesar el logo
        if ($request->hasFile('logo')) {
            $filename = time() . '_' . $request->logo->getClientOriginalName();
            $destinationPath = public_path('/assets/logo');
            $request->logo->move($destinationPath, $filename);
            $settings->logo = 'assets/logo/' . $filename;
        }

        // Actualizar otros campos
        $settings->email = $request->input('email');
        $settings->address = $request->input('address');
        $settings->phone = $request->input('phone');
        $settings->facebook = $request->input('facebook');
        $settings->twitter = $request->input('twitter');
        $settings->whatsapp = $request->input('whatsapp');
        $settings->instagram = $request->input('instagram');
        $settings->youtube = $request->input('youtube');
        
        // Nuevos campos de texto largo
        $settings->terms = $request->input('terms');
        $settings->refund_policy = $request->input('refund_policy');
        $settings->shipping_policy = $request->input('shipping_policy');
        $settings->cookie_policy = $request->input('cookie_policy');
        $settings->warranty_policy = $request->input('warranty_policy');
        $settings->payment_methods = $request->input('payment_methods');
        $settings->security_policy = $request->input('security_policy');
        $settings->promotions = $request->input('promotions');
        

        // Guardar los cambios
        $settings->save();

        // Redireccionar con un mensaje de éxito
        return back()->with('success', 'Configuración actualizada correctamente.');
    }
}
