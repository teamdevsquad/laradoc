<?php

namespace App\Http\Requests;

use DevSquad\Extensions\BaseRequest;
use App\Forms\DocumentationForm;

class DocumentationRequest extends BaseRequest
{
    public function form(): DocumentationForm
    {
        return new DocumentationForm($this->context());
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'         => 'required',
            'documentation' => 'required'
        ];
    }
}
