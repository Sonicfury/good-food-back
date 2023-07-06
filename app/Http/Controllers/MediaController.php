<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\MenuResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addMedia(Request $request)
    {
        $model = match ($request->input('model')) {
            'menu' => [
                'media' => 'menu_image',
                'model' => Menu::find($request->id),
                'resource' => MenuResource::make(Menu::find($request->id))
            ],
            'product' => [
                'media' => 'product_image',
                'model' => Product::find($request->id),
                'resource' => ProductResource::make(Product::find($request->id)),
            ],
            'category' => [
                'media' => 'menu_image',
                'model' => Category::find($request->id),
                'resource' => CategoryResource::make(Category::find($request->id)),
            ],
            'restaurant' => [
                'media' => 'restaurant_image',
                'model' => Restaurant::find($request->id),
                'resource' => RestaurantResource::make(Restaurant::find($request->id)),
            ],
        };

        $model['model']->addMediaFile($request->file('image'), $model['media']);

        return $this->handleResponse($model['resource'], 'Media file stored or updated successfully.');
    }
}
