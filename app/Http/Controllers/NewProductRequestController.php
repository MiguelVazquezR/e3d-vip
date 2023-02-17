<?php

namespace App\Http\Controllers;

use App\Models\NewProductRequest;
use Illuminate\Http\Request;

class NewProductRequestController extends Controller
{

    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $new_product_request = NewProductRequest::create($request->all() + ['user_id' => auth()->id()]);
        $new_product_request->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());

        request()->session()->flash('flash.banner', 'Se ha enviado tu solicitud');
        request()->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('products.index');

    }


    public function show(NewProductRequest $newProductRequest)
    {
        //
    }


    public function edit(NewProductRequest $newProductRequest)
    {
        //
    }


    public function update(Request $request, NewProductRequest $newProductRequest)
    {
        //
    }


    public function destroy(NewProductRequest $new_product_request)
    {
        $new_product_request->delete();

        request()->session()->flash('flash.banner', 'Se ha eliminado correctamente');
        request()->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('products.index');
    }

    public function deleteFile(Request $request)
    {
        NewProductRequest::find($request->homework_id)->deleteMedia($request->file_id);

        return response()->json(['success' => 'success'], 200);
    }
}
