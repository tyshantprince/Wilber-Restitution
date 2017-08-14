@extends('partials.main')

@section('content')
    <app :items="{{$states->toJson() }}"></app>
@endsection