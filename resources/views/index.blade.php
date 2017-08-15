@extends('partials.main')

@section('content')
    <restitution :state-list="{{$states->toJson() }}"></restitution>
@endsection