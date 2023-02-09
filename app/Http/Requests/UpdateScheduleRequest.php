<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'school_year_id' => [
                'required',
                Rule::unique('schedules')->where(fn ($query) => $query->where('classroom_id', request()->classroom_id)->where('timetable_id',request()->timetable_id)->where('day_id',request()->day_id))->ignore(request()->id),

                // Ini untuk cek jika tahun ajaran ini, kelas ini dan pelajaran sudah ada atau tidak, tapi ini sudah di custom di controller
                // Rule::unique('schedules')->where(fn ($query) => $query->where('classroom_id', request()->classroom_id)->where('subject_lesson_id',request()->subject_lesson_id)->orWhere('subject_lesson_id',0))->ignore(request()->id)
            ],
            'classroom_id' => [
                'required',
                Rule::unique('schedules')->where(fn ($query) => $query->where('school_year_id', request()->school_year_id)->where('timetable_id',request()->timetable_id)->where('day_id',request()->day_id))->ignore(request()->id),

                // Ini untuk cek jika tahun ajaran ini, kelas ini dan pelajaran sudah ada atau tidak, tapi ini sudah di custom di controller
                // Rule::unique('schedules')->where(fn ($query) => $query->where('school_year_id', request()->school_year_id)->where('subject_lesson_id',request()->subject_lesson_id)->orWhere('subject_lesson_id',0))->ignore(request()->id)
            ],
            'timetable_id' => [
                'required',
                Rule::unique('schedules')->where(fn ($query) => $query->where('school_year_id', request()->school_year_id)->where('classroom_id',request()->classroom_id)->where('day_id',request()->day_id))->ignore(request()->id)
            ],
            'day_id' => [
                'required',
                Rule::unique('schedules')->where(fn ($query) => $query->where('school_year_id', request()->school_year_id)->where('classroom_id',request()->classroom_id)->where('timetable_id',request()->timetable_id))->ignore(request()->id)
            ],
            'no_lesson' => 'required',
            'teacher_id' => 'required_if:subject_lesson_id,'.request('subject_lesson_id'),
            'subject_lesson_id' => [
                'required_if:teacher_id,'.request('teacher_id'),

                // Ini untuk cek jika tahun ajaran ini, kelas ini dan pelajaran sudah ada atau tidak, tapi ini sudah di custom di controller
                // Rule::unique('schedules')->where(fn ($query) => $query->where('school_year_id', request()->school_year_id)->where('classroom_id',request()->classroom_id)->orWhere('subject_lesson_id',0))->ignore(request()->id)
            ],
        ];
    }
}
