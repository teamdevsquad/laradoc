<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Forms\DocumentationForm;
use App\Models\Documentation;

class DocumentationService
{
    public function create(DocumentationForm $form): Documentation
    {
        return DB::transaction(function () use ($form) {
            $obj                = new Documentation();
            $obj->title         = $form->title;
            $obj->documentation = $form->documentation;
            $obj->save();
            return $obj;
        });
    }

    public function update(DocumentationForm $form, Documentation $obj): Documentation
    {
        return DB::transaction(function () use ($form, $obj) {
            $obj->title         = $form->title;
            $obj->documentation = $form->documentation;
            $obj->save();
            return $obj;
        });
    }

    public function delete(Documentation $obj)
    {
        return DB::transaction(function () use ($obj) {
            $obj->delete();
        });
    }
}
