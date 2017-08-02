@extends('partials.main')

@section('content')
    <restitution :states="{{ $states->toJson() }}"></restitution>
@endsection