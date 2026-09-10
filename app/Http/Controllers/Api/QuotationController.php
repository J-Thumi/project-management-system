<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'project_id' => 'required|uuid|exists:projects,id',
            'created_by_user_id' => 'required|uuid|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*.catalog_item_id' => 'nullable|uuid|exists:master_items_catalog,id',
            'items.*.item_name' => 'required|string|max:150',
            'items.*.category' => 'required|in:plant,hardscape,irrigation,lighting,soil_mulch,labor',
            'items.*.supplier_name' => 'nullable|string|max:150',
            'items.*.quantity_quoted' => 'required|numeric|gt:0',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $quotation = DB::transaction(function () use ($validated) {
            $latestVersion = Quotation::where('project_id', $validated['project_id'])->max('version_number') ?? 0;

            $quotation = Quotation::create([
                'project_id' => $validated['project_id'],
                'created_by_user_id' => $validated['created_by_user_id'],
                'version_number' => $latestVersion + 1,
                'status' => 'draft',
            ]);

            $totalAmount = 0;

            foreach ($validated['items'] as $item) {
                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'catalog_item_id' => $item['catalog_item_id'] ?? null,
                    'item_name' => $item['item_name'],
                    'category' => $item['category'],
                    'supplier_name' => $item['supplier_name'] ?? null,
                    'quantity_quoted' => $item['quantity_quoted'],
                    'unit_price' => $item['unit_price'],
                ]);

                $totalAmount += ($item['quantity_quoted'] * $item['unit_price']);
            }

            $quotation->update(['total_amount' => $totalAmount]);

            return $quotation;
        });

        return response()->json($quotation->load('items'), 201);
    }

    public function show(string $id): JsonResponse
    {
        $quotation = Quotation::with('items.catalogItem')->findOrFail($id);
        return response()->json($quotation);
    }
}