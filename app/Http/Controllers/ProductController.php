<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:64|unique:products',
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:categories,id',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $product = Product::create($data);
        $product->categories()->sync($data['categories']);

        return response()->json([
            'status' => 'ok',
            'id' => $product->id
        ]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:64',
                Rule::unique('products')->ignore($product->id)
            ],
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:categories,id',
            'price' => 'required|numeric'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        if (!$product->update($data)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error while updating Product.'
            ], 500);
        }

        return response()->json([
            'status' => 'ok',
            'id' => $product->id
        ]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Product $product)
    {
        if (!$product->delete()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error while deleting Product.'
            ], 500);
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }
}
