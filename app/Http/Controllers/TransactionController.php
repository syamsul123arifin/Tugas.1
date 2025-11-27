<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'cashier_id' => 'required|exists:users,id',
            'payment_amount' => 'required|integer|min:0',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $totalAmount = 0;
        $items = $request->items;

        // Calculate total amount
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            $totalAmount += $product->price * $item['quantity'];
        }

        // Check if payment is sufficient
        if ($request->payment_amount < $totalAmount) {
            return response()->json(['message' => 'Insufficient payment'], 400);
        }

        $changeAmount = $request->payment_amount - $totalAmount;

        DB::transaction(function () use ($request, $totalAmount, $changeAmount, $items) {
            // Create transaction
            $transaction = Transaction::create([
                'cashier_id' => $request->cashier_id,
                'total_amount' => $totalAmount,
                'payment_amount' => $request->payment_amount,
                'change_amount' => $changeAmount,
            ]);

            // Create transaction details
            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                // Update stock
                $product->decrement('stock', $item['quantity']);
            }
        });

        return response()->json(['message' => 'Checkout successful', 'change' => $changeAmount], 201);
    }
}