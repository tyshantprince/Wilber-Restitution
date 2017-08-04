@extends('partials.main')

@section('content')
    <restitution :data="{{$states->toJson() }}"></restitution>
@endsection