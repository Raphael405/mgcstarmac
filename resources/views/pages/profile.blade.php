@extends('layouts.app')


@section('content')
    @livewire('profile-show',['id'=>$id,'checker'=>$checker])
@endsection
