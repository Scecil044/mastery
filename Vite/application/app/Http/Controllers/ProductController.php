<?php

namespace App\Http\Controllers;

use App\Models\Api\Product;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductListResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search', false);
        $perPage = request('per_page', 10);
        $sortField= request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Product::query();
        $query->orderBy($sortField, $sortDirection);
        if($search){
            $search = $query->where('title', 'like', "%{$search}%")
            ->orWhere('price', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
        }

        return ProductListResource::collection($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

       /** @var \Illuminate\Http\UploadedFile $image */

        $image = $data['image'] ?? null;
        if($image){
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();
        }
        $product = Product::Create($data);
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $data['image'] ?? null;
        if($image){
            $relativePath = $this->saveImage(($image));
            $data['image'] = url::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();

            if($product->image){
                Storage::deleteDirectory('/public/'.dirname($product->image));
            }
        }
        $product->update($data);
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }

    //Save Image

    public function saveImage(UploadedFile $image){
        $path = 'images/'. Str::random();
        if(!Storage::exists($path)){
            Storage::makeDirectory($path, 0755, true);
        }
        if(!Storage::putFileAs('public/'. $path, $image, $image->getClientOriginalName())){
            throw new \Exception("unable to save file \"{$image->getClientOriginalName()}\"");
        }
        return $path . '/' . $image->getClientOriginalName();

    }
}
