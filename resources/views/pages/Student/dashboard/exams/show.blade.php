@extends('layouts.master')
@section('css')
    @livewireStyles
    @section('title')
        {{trans('Students_trans.Quizz')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('Students_trans.Quizz')}}
    @stop
    <!-- breadcrumb -->
@endsection

@section('content')

    @livewire('show-question', ['quizze_id' =>$quizze_id_controller, 'student_id' =>$student_id_controller])
@endsection

@section('js')
    @livewireScripts
@endsection
