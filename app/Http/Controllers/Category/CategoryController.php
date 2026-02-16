<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\CloudinaryHelper;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('pages.admin.kelola-category', compact('categories'));
    }

    public function create()
    {
        return view('pages.admin.form.form-category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:education,recipe',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imageUrl = null;
        $publicId = null;

        if ($request->hasFile('image')) {
            $upload = CloudinaryHelper::upload(
                $request->file('image'),
                'si-cerdas/categories'
            );

            $imageUrl = $upload['url'];
            $publicId = $upload['public_id'];
        }

        Category::create([
            'name' => $request->name,
            'type' => $request->type,
            'imageUrl' => $imageUrl,
            'public_id' => $publicId,
        ]);

        return redirect('admin/categories')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(int $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('pages.admin.form.form-category', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:education,recipe',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {

            // // 🔥 Hapus gambar lama di Cloudinary
            // if ($category->public_id) {
            //     CloudinaryHelper::delete($category->public_id);
            // }

            $upload = CloudinaryHelper::upload(
                $request->file('image'),
                'si-cerdas/categories'
            );

            $category->imageUrl = $upload['url'];
        }

        $category->name = $request->name;
        $category->type = $request->type;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(Category $category)
    {
        // 🔥 Hapus gambar dari Cloudinary
        // if ($category->public_id) {
        //     CloudinaryHelper::delete($category->public_id);
        // }

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
