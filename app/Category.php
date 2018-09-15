<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_to_categories');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productToCategories()
    {
        return $this->hasMany(ProductsToCategories::class);
    }

    /**
     * @return bool|null
     * @throws Exception
     */
    public function delete() : bool
    {
        DB::beginTransaction();

        try {
            parent::delete();
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }

        DB::commit();

        return true;
    }
}
