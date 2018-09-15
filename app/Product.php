<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'price'
    ];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'products_to_categories');
    }

    /**
     * @return HasMany
     */
    public function productToCategories() : HasMany
    {
        return $this->hasMany(ProductsToCategories::class);
    }

    /**
     * @param array $attributes
     * @param array $options
     * @return bool
     * @throws Exception
     */
    public function update(array $attributes = [], array $options = []) : bool
    {
        DB::beginTransaction();

        try {
            parent::update($attributes);
            $this->categories()->sync($attributes['categories']);
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }

        DB::commit();

        return true;
    }

    /**
     * @return bool|mixed|null
     * @throws \Throwable
     */
    public function delete() : bool
    {
        DB::beginTransaction();

        try {
            $this->productToCategories()->delete();
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }

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
