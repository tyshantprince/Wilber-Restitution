@extends('partials.main')

@section('content')
    <restitution :states="{{ json_encode($states) }}"></restitution>
@endsection