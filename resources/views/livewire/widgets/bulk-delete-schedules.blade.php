<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header"><strong>Bulk Delete Schedules </strong></div>
                <div class="card-body">
                <div class="row">

                    <div class="form-group col-sm-12">
                        <label for="school_years"><b>School Year</b></label>
                        <select wire:model=form_school_year_id class="form-control select inline @error('form_school_year_id')is-invalid @enderror" id="school_years">
                            <option value="" selected>-- Choosen one --</option>
                            @foreach($SchoolYears as $schoolyear)
                                <option value="{{$schoolyear->id}}">{{$schoolyear->school_year_name}}</option>
                            @endforeach
                        </select elect>
                        @error('form_school_year_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <!-- <div class="form-group col-sm-8">
                        <label for="days"><b>Days</b></label>
                        <div class="checkbox">
                            @foreach($Days as $day)
                            <label class="font-weight-normal mr-3">
                                <input type="checkbox" wire:model="form_day_id" value="{{$day->id}}" id="days" class="inline @error('form_day_id')is-invalid @enderror">
                                {{$day->day_name}}
                            </label>
                            @endforeach
                        </div>
                        @error('form_day_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div> -->

                    <div class="form-group col-sm-12">
                        <label for="timetables"><b>Timetables</b></label>
                        <div class="row">
                            @foreach($Timetables as $timetable)
                            <div class="col-sm-{{ intval(12/3) }}">
                                <div class="checkbox">
                                    <label class="font-weight-normal mr-3">
                                        <input type="checkbox" wire:model="form_timetable_id" value="{{$timetable->id}}" id="timetables" class="inline @error('form_timetable_id')is-invalid @enderror" > {{$timetable->subject}}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('form_timetable_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group col-sm-12">
                        <label for="classrooms"><b>Classrooms</b></label>
                        <div class="row">
                            @foreach($Classrooms as $classroom)
                            <div class="col-sm-{{ intval(12/3) }}">
                                @if($classroom->schedules_count)
                                <div class="checkbox">
                                    <label class="font-weight-normal mr-3">
                                        <input type="checkbox" wire:model="form_classroom_id" value="{{$classroom->id}}" id="classrooms" class="inline @error('form_classroom_id')is-invalid @enderror"> {{$classroom->classname}}
                                    </label>
                                    @if($form_school_year_id)
                                    <a href="{{backpack_url('print-student-schedule')}}/?classroom_id={{$classroom->id}}&school_year_id={{$this->form_school_year_id}}" target="_blank" class="badge badge-warning">CHECK AVAILABLE SLOT</a>
                                    @endif
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @error('form_classroom_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary btn-block" wire:click="delete()"> Delete </button>
                    </div>
                </div>
                <!-- /.row-->
                </div>
            </div>
        </div>
    </div>
</div>
