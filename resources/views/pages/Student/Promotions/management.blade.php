@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_trans.Students_Promotions')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.Students_Promotions')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#Delete_all">
                                    {{trans('Students_trans.Undo_operations')}}
                                </button>
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-secondary">#</th>
                                            <th class="alert-secondary">{{trans('Students_trans.name')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.Current_academic_year')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.Previous_Grade')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.Previous_classrooms')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.Previous_section')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.Next_academic_year')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.Next_Grade')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.Next_classrooms')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.Next_section')}}</th>
                                            <th class="alert-warning">{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{optional($promotion->student)->name}}</td>
                                                <td>{{$promotion->academic_year}}</td>
                                                <td>{{$promotion->f_grade->Name}}</td>
                                                <td>{{$promotion->f_classroom->Name_Class}}</td>
                                                <td>{{$promotion->f_section->Name_Section}}</td>
                                                <td>{{$promotion->academic_year_new}}</td>
                                                <td>{{$promotion->t_grade->Name}}</td>
                                                <td>{{$promotion->t_classroom->Name_Class}}</td>
                                                <td>{{$promotion->t_section->Name_Section}}</td>
                                                <td>

                                                    <button type="button" class="btn btn-outline-danger"
                                                            data-toggle="modal"
                                                            data-target="#Delete_one{{$promotion->id}}">
                                                        {{trans('Students_trans.back_Student')}}
                                                    </button>
                                                    <a type="button" class="btn btn-outline-success"
                                                        href="{{route('Graduated.edit',$promotion->student_id)}}">
                                                        {{trans('Students_trans.Graduation_student')}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @include('pages.Student.Promotions.Delete_all')
                                        @include('pages.Student.Promotions.Delete_one')

                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
