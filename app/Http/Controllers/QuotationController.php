<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuotationResource;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = QuotationResource::collection(Quotation::where('user_id', auth()->id())
            ->with('seller', 'user', 'products')
            ->latest()
            ->paginate(15));

        // return $quotations;
        return inertia('Quotations/Index', compact('quotations'));
    }
}
