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
    // public $withBackground = true;
    public $searchBy = ['name', 'price'];
    // protected $paginate = 8;

    protected $model = Product::class;
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
            'model' => $model,
        ];
    }

    // public function sortableBy()
    // {
    //     return [
    //         'Name' =>'name',
    //         'Price' => 'price'
    //     ];
    // }
}