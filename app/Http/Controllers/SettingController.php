<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function employerSettings()
    {
        $company = Auth::user()->company;
        $activeJobCount = $company->careers->where('status', 'available')->count();
        return view('careers.employer.settings', compact('company', 'activeJobCount'));
    }

    public function employerSettingsEdit(Company $company)
    {
        return view('careers.employer.edit_settings', compact('company'));
    }

    public function employerSettingsUpdate(Company $company, Request $request)
    {
        // 1. Updated validation rules
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'industry'     => 'nullable|string|max:255',
            'website'      => 'nullable|string|max:255',
            'logo_url'     => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:2048', // File validation (max 2MB)
            'location'     => 'nullable|string|max:255',
            'description'  => 'nullable|string|max:1000',
        ]);

        // 2. Handle Logo File Upload
        if ($request->hasFile('logo_url')) {
            // Delete old file from storage if it exists
            if ($company->logo_url && Storage::disk('public')->exists($company->logo_url)) {
                Storage::disk('public')->delete($company->logo_url);
            }

            // Store new file in 'storage/app/public/logos'
            $path = $request->file('logo_url')->store('logos', 'public');

            // Set the path to be saved in DB
            $validated['logo_url'] = $path;
        } else {
            // Unset so we don't clear the existing path when no new file is uploaded
            unset($validated['logo_url']);
        }

        // 3. Update company record
        $company->update($validated);

        return redirect()->route('employer.settings')->with('success', 'Company information updated successfully!');
    }
}
