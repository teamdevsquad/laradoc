<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Forms\CategoryForm;
use App\Models\Category;

class CategoryService
{
    public function create(CategoryForm $form): Category
    {
        return DB::transaction(function () use ($form) {
            $obj       = new Category();
            $obj->text = $form->text;
            $obj->save();
            return $obj;
        });
    }

    public function update(CategoryForm $form, Category $obj): Category
    {
        return DB::transaction(function () use ($form, $obj) {
            $obj->text = $form->text;
            $obj->save();
            return $obj;
        });
    }

    public function delete(Category $obj)
    {
        return DB::transaction(function () use ($obj) {
            $obj->delete();
        });
    }
}
