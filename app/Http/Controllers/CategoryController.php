<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:64|unique:categories'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $category = Category::create($data);

        return response()->json([
            'status' => 'ok',
            'id' => $category->id
        ]);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:64',
                Rule::unique('categories')->ignore($category->id)
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $category->update($data);

        return response()->json([
            'status' => 'ok',
            'id' => $category->id
        ]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if (!$category->delete()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error while deleting Category.'
            ], 500);
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }
}
