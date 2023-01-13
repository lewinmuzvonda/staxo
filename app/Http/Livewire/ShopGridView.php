<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\GridView;
use App\Models\Product;

class ShopGridView extends GridView
{
    /**
     * Sets a model class to get the initial data
     */
    // protected $model = Product::class;
    public $maxCols = 4;
    public $withBackground = true;
    public $searchBy = ['name', 'price'];

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return Product::select('products.id','products.name','products.image','products.price','products.status as product_status');
    }

    public $cardComponent = 'customer.product';
    /**
     * Sets the data to every card on the view
     *
     * @param $model Current model for each card
     */
    public function card($model)
    {
        return [
            'id' => $model->id,
            'image' => $model->image,
            'name' =>  $model->name,
            'price' =>  $model->price,
            'model' => $model
        ];
    }

    public function sortableBy()
    {
        return [
            'Name' =>'name',
            'Price' => 'price'
        ];
    }
}