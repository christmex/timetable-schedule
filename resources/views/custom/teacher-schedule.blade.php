@extends('layout/blank_livewire')

@section('header')
	<section class="container-fluid">
	  <h2>
        <span class="text-capitalize">Teacher Schedule</span>
	  </h2>
	</section>
@endsection

@section('content')
<livewire:teacher-schedule.index/> 
@endsection