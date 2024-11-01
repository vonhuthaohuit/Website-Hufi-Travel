<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FooterGridOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Traits\ImageUploadTrait;

class FooterGridOneController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footerInfo = FooterGridOne::first();
        // dd($footerInfor);
        return view('backend.footer.footer-grid-one.index', compact('footerInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['nullable', 'image', 'max:3000'],
            'phone' => ['max:100'],
            'email' => ['max:100'],
            'address' => ['max:300'],
            'copyright' => ['max:200']
        ]);

        $footerInfo = FooterGridOne::find($id);
        /** Handle file upload */
        $imagePath = $this->updateImage($request, 'logo', 'frontend/images/uploads/logo', $footerInfo?->logo);

        FooterGridOne::updateOrCreate(
            ['id' => $id],
            [
                'logo' => empty(!$imagePath) ? $imagePath : $footerInfo->banner,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'copyright' => $request->copyright
            ]
        );

        Cache::forget('footer_grid_one');

        toastr('Updated successfully!', 'success', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}