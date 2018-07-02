<?php

namespace App\Http\Requests;

use DevSquad\Extensions\BaseRequest;
use App\Forms\CategoryForm;

class CategoryRequest extends BaseRequest
{
    public function form(): CategoryForm
    {
        return new CategoryForm($this->context());
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'text' => 'required'
        ];
    }
}
