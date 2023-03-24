<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PatientreisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  Auth::user()->is_reception;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'First_Name'=>'required',
            'Last_Name'=>'required',
            'Father_Name'=>'required',
            'Gender'=>['required',Rule::in(['f','F','m','M'])],
            'Date_Of_Birth'=>['required','date'],
            'username'=>'required',
            'password'=>'required',
            //'phone'=>'phone', غير موجود كقاعدة
            'email'=>'email',
        ];
    }



    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json([
         'success'   => false,
         'message'   => 'يوجد خطأ في القيم المدخلة',
         'errors'      => $validator->errors()
       ],400));
    }
}
