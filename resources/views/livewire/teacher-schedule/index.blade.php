<div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <form wire:submit.prevent="submit">
                    <div class="row">
                        <div class="col-12">

                            <label for="school_years"><b>School Year</b></label>
                            <select wire:model=form_school_year_id class="form-control select inline @error('form_school_year_id')is-invalid @enderror" id="school_years">
                                <option value="" selected>-- Choosen one --</option>
                                @foreach($SchoolYears as $schoolyear)
                                    <option value="{{$schoolyear->id}}">{{$schoolyear->school_year_name}}</option>
                                @endforeach
                            </select elect>
                            @error('form_school_year_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror

                            <div class="mt-3">
                                <label for="days"><b>Days</b></label>
                                <div class="checkbox">
                                    @foreach($Days as $day)
                                    <label class="font-weight-normal" style="display:block">
                                        <input type="checkbox" wire:model="form_day_id" value="{{$day->id}}" id="days" class="inline @error('form_day_id')is-invalid @enderror" @if($day->schedules_count == 0) disabled @endif> {{$day->day_name}} (There are {{$day->schedules_count}} remaining empty slots across all classes.)
                                        
                                    </label>
                                    @endforeach
                                </div>
                                @error('form_day_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-3">
                                <label for="classrooms"><b>Classrooms</b></label>
                                <div class="row">
                                    @foreach($Classrooms as $classroom)
                                    <div class="col-sm-{{ intval(12/3) }}">
                                        <div class="checkbox">
                                            <label class="font-weight-normal mr-3">
                                                <input type="checkbox" wire:model="form_classroom_id" value="{{$classroom->id}}" id="classrooms" class="inline @error('form_classroom_id')is-invalid @enderror" @if($classroom->schedules_count == 0) disabled @endif> {{$classroom->classname}}
                                            </label>
                                            @if($classroom->schedules_count) 
                                                <a href="{{backpack_url('print-student-schedule')}}/?classroom_id={{$classroom->id}}&school_year_id={{$this->form_school_year_id}}" target="_blank" class="badge badge-warning">CHECK AVAILABLE SLOT</a>
                                            @endif
                                            <!-- <form action="{{backpack_url('print-student-schedule')}}" method="get" target="_blank" style="display:inline">
                                                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                                                <input type="hidden" name="school_year_id" value="{{$this->form_school_year_id}}">
                                                <button type="submit" class="badge badge-warning"> CHECK AVAILABLE SLOT </button>
                                            </form> -->
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('form_classroom_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-3">
                                <label for="teachers"><b>Teachers </b></label>
                                <select wire:model=form_teacher_id class="form-control select inline @error('form_teacher_id')is-invalid @enderror" id="teachers">
                                    <option value="" selected>-- Choosen one --</option>
                                    @foreach($Teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher->teacher_name}}</option>
                                    @endforeach
                                </select>
                                @error('form_teacher_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-3">
                                <label for="subject_lessons"><b>Subject Lessons</b></label>
                                <select wire:model=form_subject_lesson_id class="form-control select inline @error('form_subject_lesson_id')is-invalid @enderror" id="subject_lessons">
                                    <option selected>-- Choosen one --</option>
                                    @foreach($SubjectLessons as $subject_lesson)
                                        <option value="{{$subject_lesson->id}}">{{$subject_lesson->subject_name}}</option>
                                    @endforeach
                                </select>
                                @error('form_subject_lesson_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-3">
                                <label for="teaching_amount"><b>Teaching Lessons</b></label>
                                <input type="number" class="form-control inline @error('form_teaching_amount')is-invalid @enderror" min="1" wire:model="form_teaching_amount" id="teaching_amount" placeholder="Ex: 8">
                                @error('form_teaching_amount') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>


                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
