{{--  بتعرض كل الدكاتره عند الادمن --}}
@extends('layouts.app')
@section('main-content')
@foreach ($doctors as $doctor )
    <h1>هتكتب هنا الكود الى بيعرض كل الدكاتره جوا السكشن وملكش دعوه ب اى حاجه تانيه الشغل bootstarp بس </h1>
<a href="{{ route('doctors.show',$doctor->id) }}">دا لنك بيعرضلك صفحة ال show بتاع الدكتور علشان تشوف الى انت عملته</a>
<a href="{{ route('doctors.edit',$doctor->id) }}">دا لنك بيعرضلك صفحة ال edit بتاع الدكتور علشان تشوف الى انت عملته</a>


@endforeach

@endsection