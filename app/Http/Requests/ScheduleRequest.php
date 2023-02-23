<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd(request('school_year_id'));
        return [
            'school_year_id' => 'required',
            'classroom_id' => ['required', function ($attribute, $value, $fail) {
                        $value = json_decode($value,true);
                        if (! is_array($value) || count($value) == 0) {
                            $fail('The '.$attribute.' is invalid, please choose one');
                        }
                    },
                ],
            'timetable_id' => ['required', function ($attribute, $value, $fail) {
                        $value = json_decode($value,true);
                        if (! is_array($value) || count($value) == 0) {
                            $fail('The '.$attribute.' is invalid, please choose one');
                        }
                    },
                ],
            // 'day_id' => ['required', function ($attribute, $value, $fail) {
            //             $value = json_decode($value,true);
            //             if (! is_array($value) || count($value) == 0) {
            //                 $fail('The '.$attribute.' is invalid, please choose one');
            //             }
            //         },
            //     ],
            'no_lesson' => ['required', function ($attribute, $value, $fail) {
                        $value = json_decode($value,true);
                        if (! is_array($value)) {
                            $fail('The '.$attribute.' is invalid, please choose one');
                        }
                    },
                ],
            // 'classroom_id' => 'required',
            // 'timetable_id' => 'required|array',
            // 'day_id' => 'required|array',
            // 'no_lesson' => 'required|array',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
