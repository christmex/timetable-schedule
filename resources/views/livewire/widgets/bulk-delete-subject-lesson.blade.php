<div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header"><strong>Bulk Delete Schedules </strong></div>
                <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="school_years">School Year</label>
                        <select wire:model=school_year_id class="form-control select inline @error('school_year_id')is-invalid @enderror" id="school_years">
                            <option value="" selected>-- Choosen one --</option>
                            @foreach($SchoolYears as $schoolyear)
                                <option value="{{$schoolyear->id}}">{{$schoolyear->school_year_name}}</option>
                            @endforeach
                        </select elect>
                        @error('school_year_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="classrooms">Classroom</label>
                        <select wire:model=classroom_id class="form-control select inline @error('classroom_id')is-invalid @enderror" id="classrooms">
                            <option value="" selected>-- Choosen one --</option>
                            @foreach($Classrooms as $classroom)
                                <option value="{{$classroom->id}}">{{$classroom->classname}}</option>
                            @endforeach
                        </select elect>
                        @error('classroom_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="days">Days</label>
                        <select wire:model=day_id class="form-control select inline @error('day_id')is-invalid @enderror" id="days">
                            <option value="" selected>-- Choosen one --</option>
                            @foreach($Days as $day)
                                <option value="{{$day->id}}">{{$day->day_name}}</option>
                            @endforeach
                        </select elect>
                        @error('day_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="timetable">Timetable</label>
                        <select wire:model=timetable_id class="form-control select inline @error('timetable_id')is-invalid @enderror" id="timetable">
                            <option value="" selected>-- Choosen one --</option>
                            @foreach($Timetables as $timetable)
                                <option value="{{$timetable->id}}">{{$timetable->subject}}</option>
                            @endforeach
                        </select elect>
                        @error('timetable_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>


                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary btn-block" wire:click="find()"> Find </button>
                    </div>
                </div>
                <!-- /.row-->
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"></i> <strong>Idle teacher</strong></div>
                <div class="card-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                    <tr>
                        <th>Teacher's name</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if($resultFindIdleTeacher)
                            @foreach($resultFindIdleTeacher as $teacher)
                                <tr>
                                    <td>{{$teacher->teacher_name}}</td>
                                    <td><span class="badge badge-success">Free</span></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
</div>
