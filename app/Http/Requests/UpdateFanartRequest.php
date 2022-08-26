<?php

namespace App\Http\Requests;

use App\Models\Fanart;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFanartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $fanart = $this->route('fanart');
        if ($this->user()->id !== $fanart->id_users) {
            return false;
        }
        return true;
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
            'image' =>  'nullable|string',
            'id_users' => 'exists:users,id',
            'id_fanartCategories' => 'exists:fanartCategories,id'
        ];
    }
}
