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

        // Rule-based recommendations
        if ($productId == 1 || $productId == 5) {
            // If Kopi (1) or Teh (5), recommend Gula (2) and Susu (6)
            $gula = Product::find(2);
            $susu = Product::find(6);
            if ($gula) $recommendations[] = $gula;
            if ($susu) $recommendations[] = $susu;
        } elseif ($productId == 3) {
            // If Roti (3), recommend Selai (4) and Susu (6)
            $selai = Product::find(4);
            $susu = Product::find(6);
            if ($selai) $recommendations[] = $selai;
            if ($susu) $recommendations[] = $susu;
        } else {
            // Default: 2 random products
            $recommendations = Product::where('id', '!=', $productId)->inRandomOrder()->take(2)->get();
        }

        return response()->json($recommendations);
    }
}