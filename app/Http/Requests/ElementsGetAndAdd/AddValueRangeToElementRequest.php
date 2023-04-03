<?php

namespace App\Http\Requests\ElementsGetAndAdd;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class AddValueRangeToElementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'element_id'=>['required'],
            'gender'=>['required'],
            'from_age'=>['required_unless:is_age_affected,false'],
            'to_age'=>['required_unless:is_age_affected,false'],
            'age_unit'=>['required_unless:is_age_affected,false'],
            'min_value'=>['required_if:is_range,true'],
            'max_value'=>['required_if:is_range,true'],
            'value'=>['required_if:is_range,false'],
            'is_range'=>['required','boolean'],
            'is_gender_affected'=>['required','boolean'],
            'is_age_affected'=>['required','boolean'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'message'=>'يوجد خطأ في القيم المدخلة',
            'errors'=>$validator->errors()
        ],400));
    }
}
