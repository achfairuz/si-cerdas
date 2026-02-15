<?php

namespace App\Http\Controllers\Recipe;

use App\Helpers\CloudinaryHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Nutrition;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with([
            'category',
            'ingredients',
            'steps',
            'nutritions'
        ])->paginate(10);

        $recipesData = collect($recipes->items())->mapWithKeys(function ($r) {
            return [
                $r->id => [
                    'ingredients' => $r->ingredients,
                    'steps' => $r->steps,
                    'nutritions' => $r->nutritions,
                ]
            ];
        });

        return view('pages.admin.kelola-recipe', compact('recipes', 'recipesData'));
    }

    public function create()
    {
        $categories = Category::where('type', 'recipe')->get();
        return view('pages.admin.form.form-recipe', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'portion' => 'required|max:255',
            'duration' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        DB::transaction(function () use ($request) {

            $imageUrl = null;
            $publicId = null;

            if ($request->hasFile('image')) {
                $upload = CloudinaryHelper::upload(
                    $request->file('image'),
                    'si-cerdas/recipes'
                );

                $imageUrl = $upload['url'];
                $publicId = $upload['public_id'];
            }

            $recipe = Recipe::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'portion' => $request->portion,
                'duration' => $request->duration,
                'description' => $request->description,
                'imageUrl' => $imageUrl,
                'public_id' => $publicId,
            ]);

            // INGREDIENTS
            collect($request->ingredients)
                ->filter()
                ->values()
                ->each(function ($ingredient, $index) use ($recipe) {
                    Ingredient::create([
                        'recipe_id' => $recipe->id,
                        'ingredient' => $ingredient,
                        'order' => $index
                    ]);
                });

            // STEPS
            collect($request->steps)
                ->filter()
                ->values()
                ->each(function ($step, $index) use ($recipe) {
                    Step::create([
                        'recipe_id' => $recipe->id,
                        'step' => $step,
                        'order' => $index
                    ]);
                });

            // NUTRITIONS
            collect($request->nutritions)
                ->filter(fn($n) => !empty($n['label']) && !empty($n['value']))
                ->each(function ($nutrition) use ($recipe) {
                    Nutrition::create([
                        'recipe_id' => $recipe->id,
                        'key' => strtolower($nutrition['label']),
                        'label' => $nutrition['label'],
                        'value' => $nutrition['value']
                    ]);
                });
        });

        return redirect()->route('recipes.index')
            ->with('success', 'Resep berhasil ditambahkan');
    }


    public function edit($id)
    {

        $recipe = Recipe::with(['ingredients', 'steps', 'nutritions'])
            ->findOrFail($id);
        $ingredients = $recipe
            ? $recipe->ingredients->pluck('ingredient')
            : collect(['']);

        $steps = $recipe
            ? $recipe->steps->pluck('step')
            : collect(['']);

        $nutritions = $recipe && $recipe->nutritions->count()
            ? $recipe->nutritions->map(fn($n) => [
                'label' => $n->label,
                'value' => $n->value
            ])
            : collect([
                ['label' => 'Energi', 'value' => ''],
                ['label' => 'Protein', 'value' => ''],
                ['label' => 'Lemak', 'value' => ''],
                ['label' => 'Karbohidrat', 'value' => ''],
            ]);


        $categories = Category::where('type', 'recipe')->get();

        return view('pages.admin.form.form-recipe', compact('categories', 'recipe', 'ingredients', 'steps', 'nutritions'));
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'portion' => 'required|max:255',
            'duration' => 'required|max:255',
            'description' => 'nullable',
        ]);

        DB::transaction(function () use ($request, $recipe) {

            if ($request->hasFile('image')) {

                // 🔥 Hapus gambar lama di Cloudinary
                if ($recipe->public_id) {
                    CloudinaryHelper::delete($recipe->public_id);
                }

                $upload = CloudinaryHelper::upload(
                    $request->file('image'),
                    'si-cerdas/recipes'
                );

                $recipe->imageUrl = $upload['url'];
                $recipe->public_id = $upload['public_id'];
            }

            $recipe->title = $request->title;
            $recipe->description = $request->description;
            $recipe->category_id = $request->category_id;
            $recipe->portion = $request->portion;
            $recipe->duration = $request->duration;
            $recipe->save();

            // Hapus lama
            $recipe->ingredients()->delete();
            $recipe->steps()->delete();
            $recipe->nutritions()->delete();

            // Insert ulang
            collect($request->ingredients)
                ->filter()
                ->values()
                ->each(function ($ingredient, $index) use ($recipe) {
                    Ingredient::create([
                        'recipe_id' => $recipe->id,
                        'ingredient' => $ingredient,
                        'order' => $index
                    ]);
                });

            collect($request->steps)
                ->filter()
                ->values()
                ->each(function ($step, $index) use ($recipe) {
                    Step::create([
                        'recipe_id' => $recipe->id,
                        'step' => $step,
                        'order' => $index
                    ]);
                });

            collect($request->nutritions)
                ->filter(fn($n) => !empty($n['label']) && !empty($n['value']))
                ->each(function ($nutrition) use ($recipe) {
                    Nutrition::create([
                        'recipe_id' => $recipe->id,
                        'key' => strtolower($nutrition['label']),
                        'label' => $nutrition['label'],
                        'value' => $nutrition['value']
                    ]);
                });
        });

        return redirect()->route('recipes.index')
            ->with('success', 'Resep berhasil diperbarui');
    }


    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);

        if ($recipe->public_id) {
            CloudinaryHelper::delete($recipe->public_id);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Resep berhasil dihapus');
    }

    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)
            ->with('category', 'ingredients', 'steps', 'nutritions')
            ->firstOrFail();

        return view('pages.user.recipe.show', compact('recipe'));
    }
}
