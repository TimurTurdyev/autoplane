<?php

namespace App\Http\Requests;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page.id' => 'required|string',
            'page.type' => 'required|string',
            'page.slug' => [
                'required',
                Rule::unique(Page::class, 'slug')->ignore($this->page['id'], 'id'),
            ],
            'page.name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Page::class, 'name')->ignore($this->page['id'], 'id'),
            ],
            'page.heading' => 'nullable|string|max:255',
            'page.meta_title' => 'nullable|string|max:255',
            'page.meta_description' => 'nullable|string|max:255',
            'page.hero' => 'nullable|string',
            'page.body' => 'nullable|string',
            'page.setting' => 'nullable|array',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $request_data = parent::validated($key, $default);
        $request_data['setting'] = array_values($request_data['setting'] ?? []);

        return $request_data;
    }
}
