<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        $productId = $request->query('product_id');

        if (!$productId) {
            return response()->json(['message' => 'product_id is required'], 400);
        }

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $recommendations = [];

        // Simple association rule: if product name contains "Coffee", recommend "Sugar" or "Bread"
        if (stripos($product->name, 'Coffee') !== false) {
            $sugar = Product::where('name', 'like', '%Sugar%')->first();
            $bread = Product::where('name', 'like', '%Bread%')->first();

            if ($sugar) $recommendations[] = $sugar;
            if ($bread) $recommendations[] = $bread;
        } elseif (stripos($product->name, 'Bread') !== false) {
            $butter = Product::where('name', 'like', '%Butter%')->first();
            $jam = Product::where('name', 'like', '%Jam%')->first();

            if ($butter) $recommendations[] = $butter;
            if ($jam) $recommendations[] = $jam;
        } else {
            // Default recommendations: random products
            $recommendations = Product::where('id', '!=', $productId)->inRandomOrder()->limit(2)->get();
        }

        return response()->json($recommendations);
    }
}