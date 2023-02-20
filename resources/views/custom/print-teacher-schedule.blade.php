<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">
<head>
    @include(backpack_view('inc.head'))
</head>
<body class="app flex-row align-items-top">

  <div class="container">
  <div class="row mt-3">
        <div class="col-sm-12">
            <div class="text-center">
                <h5 style="font-weight:bold" class="text-uppercase">BASIC CHRISTIAN SCHOOL TIMETABLE FOR {{$ActiveClassroom}}</h5>
                <h5 style="font-weight:bold">SCHOOL YEAR {{$ActiveSchoolyear}}</h5>
            </div>
            <h5 style="font-weight:bold">Teacher Name :</h5>
            <h5 style="font-weight:bold">Subject :</h5>
            <table class="table table-responsive-sm table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>Timetable</th>
                        @foreach($Days as $key => $value)
                        <th>{{$value->day_name}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($result as $key => $value)
                        <tr>
                            <td>{{$key}}</td>
                            
                            @foreach($value as $second_key => $second_value)
                                @if($second_value[0]['is_break'])
                                    <td>-</td>
                                @else
                                    
                                @endif
                                <td>{{$second_value[0]['subject_lesson']}} {{$second_value[0]['classroom'] ?? $second_value[0]['classroom']}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>


  @include(backpack_view('inc.scripts'))

</body>
</html>
