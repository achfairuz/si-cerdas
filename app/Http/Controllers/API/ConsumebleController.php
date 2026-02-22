<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Education;
use App\Models\Recipe;
use Illuminate\Http\Request;

class ConsumebleController extends Controller
{
    public function category(string $type)
    {
        try {

            $query = Category::where('type', $type);

            if ($type === 'education') {
                $query->whereHas('educations');
            }

            if ($type === 'recipe') {
                $query->whereHas('recipes');
            }

            $categories = $query->get();

            return response()->json([
                'status' => 'success',
                'data' => $categories
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function educationByCategory(int $categoryId)
    {
        try {
            $educations = Education::where('category_id', $categoryId)->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => $educations
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function detailEducation(string $slug)
    {
        try {
            $education = Education::where('slug', $slug)->first();
            if (!$education) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Education not found'
                ]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $education

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function RecipeByCategory(int $categoryId)
    {
        try {
            $recipes = Recipe::where('category_id', $categoryId)->paginate(10);

            return response()->json([
                'status' => 'success',
                'data' => $recipes
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function detailRecipe(string $slug)
    {
        try {
            $recipe = Recipe::where('slug', $slug)->with('category', 'ingredients', 'steps', 'nutritions')->first();
            if (!$recipe) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Recipe not found'
                ]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $recipe

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}