<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Education;
use Illuminate\Http\Request;
use App\Helpers\CloudinaryHelper;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::with('category')
            ->latest()
            ->paginate(10);

        return view('pages.admin.kelola-edukasi', compact('educations'));
    }

    public function create()
    {
        $categories = Category::where('type', 'education')->get();
        return view('pages.admin.form.form-edukasi', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'link' => 'nullable|url'
        ]);

        $imageUrl = null;
        $publicId = null;

        if ($request->hasFile('image')) {

            $upload = CloudinaryHelper::upload(
                $request->file('image'),
                'si-cerdas/education-thumbnail'
            );

            $imageUrl = $upload['url'];
            $publicId = $upload['public_id'];
        }

        Education::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'imageUrl' => $imageUrl,
            'public_id' => $publicId,
            'link' => $request->link
        ]);

        return redirect()
            ->route('educations.index')
            ->with('success', 'Edukasi berhasil ditambahkan');
    }

    public function edit(int $id)
    {
        $categories = Category::where('type', 'education')->get();
        $education = Education::findOrFail($id);

        return view('pages.admin.form.form-edukasi', compact('categories', 'education'));
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'link' => 'nullable|url'
        ]);

        if ($request->hasFile('image')) {

            // 🔥 Hapus gambar lama dari Cloudinary
            if ($education->public_id) {
                CloudinaryHelper::delete($education->public_id);
            }

            $upload = CloudinaryHelper::upload(
                $request->file('image'),
                'si-cerdas/education-thumbnail'
            );

            $education->imageUrl = $upload['url'];
            $education->public_id = $upload['public_id'];
        }

        $education->title = $request->title;
        $education->description = $request->description;
        $education->category_id = $request->category_id;
        $education->link = $request->link;
        $education->save();

        return redirect()
            ->route('educations.index')
            ->with('success', 'Edukasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $education = Education::findOrFail($id);

        // 🔥 Hapus gambar dari Cloudinary
        if ($education->public_id) {
            CloudinaryHelper::delete($education->public_id);
        }

        $education->delete();

        return redirect()
            ->route('educations.index')
            ->with('success', 'Edukasi berhasil dihapus');
    }
}
