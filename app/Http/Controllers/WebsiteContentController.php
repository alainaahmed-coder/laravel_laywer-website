<?php

namespace App\Http\Controllers;

use App\Models\WebsiteContent;
use Illuminate\Http\Request;

class WebsiteContentController extends Controller
{
    // Admin Website Content Page Display
    public function index()
    {
        // Unique key-value pairs ka associative array banayein
        $contents = WebsiteContent::pluck('value', 'key')->toArray();
        return view('admin.website_content', compact('contents'));
    }

    // Save/Update Content Settings
    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            WebsiteContent::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Website content updated successfully!');
    }
}
