<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminSettingController extends Controller
{
    /**
     * Show the settings form.
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required|string|max:30',
            'instagram_link' => 'nullable|url|max:255',
            'tiktok_link' => 'nullable|url|max:255',
            'banks' => 'nullable|array',
            'banks.*.bank_name' => 'required_with:banks|string|max:50',
            'banks.*.account_number' => 'required_with:banks|string|max:30',
            'banks.*.account_holder' => 'required_with:banks|string|max:100',
            'qris_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'hero_description' => 'nullable|string|max:500',
        ]);

        // Text settings
        Setting::setValue('whatsapp_number', $request->whatsapp_number);
        Setting::setValue('instagram_link', $request->instagram_link);
        Setting::setValue('tiktok_link', $request->tiktok_link);
        Setting::setValue('hero_description', $request->hero_description);

        // Handle bank accounts - convert array to JSON
        if ($request->has('banks') && is_array($request->banks)) {
            $bankAccounts = array_filter($request->banks, function($bank) {
                return !empty($bank['bank_name']) && !empty($bank['account_number']);
            });
            Setting::setValue('bank_accounts', json_encode(array_values($bankAccounts)));
        } else {
            Setting::setValue('bank_accounts', json_encode([]));
        }

        // Handle QRIS Image upload
        if ($request->hasFile('qris_image')) {
            $oldQris = Setting::getValue('qris_image');
            if ($oldQris && File::exists(public_path($oldQris))) {
                File::delete(public_path($oldQris));
            }

            $file = $request->file('qris_image');
            $filename = 'qris_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            Setting::setValue('qris_image', '/uploads/settings/' . $filename);
        }

        // Handle Website Logo upload
        if ($request->hasFile('website_logo')) {
            $oldLogo = Setting::getValue('website_logo');
            if ($oldLogo && File::exists(public_path($oldLogo))) {
                File::delete(public_path($oldLogo));
            }

            $file = $request->file('website_logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            Setting::setValue('website_logo', '/uploads/settings/' . $filename);
        }

        // Handle Hero Image upload
        if ($request->hasFile('hero_image')) {
            $oldHero = Setting::getValue('hero_image');
            if ($oldHero && File::exists(public_path($oldHero))) {
                File::delete(public_path($oldHero));
            }

            $file = $request->file('hero_image');
            $filename = 'hero_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            Setting::setValue('hero_image', '/uploads/settings/' . $filename);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
