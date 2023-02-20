<div>
    <div class="row">
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i class="la la-cogs bg-primary p-3 font-2xl mr-3"></i>
                <div>
                    <div class="text-value-sm text-primary">{{$Teachers->count()}}</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Teachers</div>
                </div>
                </div>
                <div class="card-footer px-3 py-2"><a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{backpack_url('teacher')}}"><span class="small font-weight-bold">View All</span><i class="fa fa-angle-right"></i></a></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i class="la la-cogs bg-primary p-3 font-2xl mr-3"></i>
                <div>
                    <div class="text-value-sm text-primary">{{$Classrooms->count()}}</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Classrooms</div>
                </div>
                </div>
                <div class="card-footer px-3 py-2"><a class="btn-block text-muted d-flex justify-content-between align-items-center" href="#"><span class="small font-weight-bold">View All</span><i class="fa fa-angle-right"></i></a></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i class="la la-cogs bg-primary p-3 font-2xl mr-3"></i>
                <div>
                    <div class="text-value-sm text-primary">{{$SubjectLesson}}</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Subject Lessons</div>
                </div>
                </div>
                <div class="card-footer px-3 py-2"><a class="btn-block text-muted d-flex justify-content-between align-items-center" href="#"><span class="small font-weight-bold">View All</span><i class="fa fa-angle-right"></i></a></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i class="la la-cogs bg-primary p-3 font-2xl mr-3"></i>
                <div>
                    <div class="text-value-sm text-primary">#</div>
                    <div class="text-muted text-uppercase font-weight-bold small">#</div>
                </div>
                </div>
                <div class="card-footer px-3 py-2"><a class="btn-block text-muted d-flex justify-content-between align-items-center" href="#"><span class="small font-weight-bold">View All</span><i class="fa fa-angle-right"></i></a></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header"><strong>Print schedule for student</strong><i> *Go to Teachers Menu for print Teacher's Schedule</i></div>
                <div class="card-body">
                    <form action="{{backpack_url('print-student-schedule')}}" method="get" target="_blank">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="school_years">School Year</label>
                                <select name=school_year_id class="form-control select inline @error('school_year_id')is-invalid @enderror" id="school_years" required>
                                    <option value="" selected>-- Choosen one --</option>
                                    @foreach($SchoolYears as $schoolyear)
                                        <option value="{{$schoolyear->id}}">{{$schoolyear->school_year_name}}</option>
                                    @endforeach
                                </select elect>
                                @error('school_year_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="classrooms">Classroom</label>
                                <select name=classroom_id class="form-control select inline @error('classroom_id')is-invalid @enderror" id="classrooms" required>
                                    <option value="" selected>-- Choosen one --</option>
                                    @foreach($Classrooms as $classroom)
                                        <option value="{{$classroom->id}}">{{$classroom->classname}}</option>
                                    @endforeach
                                </select elect>
                                @error('classroom_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>

                            <!-- <div class="form-group col-sm-12">
                                <label for="amount">Amount</label>
                                <input type="number" min="1" name=amount class="form-control" placeholder="Ex: 1" id="amount" required/>
                                @error('amount') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div> -->

                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block"> Print </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header"><strong>Print schedule for teacher</strong></div>
                <div class="card-body">
                    <form action="{{backpack_url('print-teacher-schedule')}}" method="post" target="_blank">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="school_years">School Year</label>
                                <select name=school_year_id class="form-control select inline @error('school_year_id')is-invalid @enderror" id="school_years" required>
                                    <option value="" selected>-- Choosen one --</option>
                                    @foreach($SchoolYears as $schoolyear)
                                        <option value="{{$schoolyear->id}}">{{$schoolyear->school_year_name}}</option>
                                    @endforeach
                                </select elect>
                                @error('school_year_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="teachers">Teacher</label>
                                <select name=teacher_id class="form-control select inline @error('teacher_id')is-invalid @enderror" id="teachers" required>
                                    <option value="" selected>-- Choosen one --</option>
                                    @foreach($Teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher->teacher_name}}</option>
                                    @endforeach
                                </select elect>
                                @error('teacher_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block"> Print </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>


    <!-- Find idle teacher -->
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header"><strong>Find idle teacher </strong></div>
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
