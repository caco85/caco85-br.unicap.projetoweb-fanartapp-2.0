<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Fanart;
use App\Models\FanartCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;



class StoreFanartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_users' => $this->user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:1000',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'id_users' => 'exists:users,id',
            'id_fanartCategories' => 'exists:fanartCategories,id'
        ];
    }
}
