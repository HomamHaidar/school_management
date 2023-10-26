@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('Students_trans.Attendance_reports')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('Students_trans.Attendance_reports')}}
    @stop
    <!-- breadcrumb -->

    @section('content')
        <!-- row -->
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" action="{{ route('attendance.search') }}" autocomplete="off">
                            @csrf

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="student">{{trans('main_trans.students')}}</label>
                                        <select class="custom-select mr-sm-2" name="student_id">
                                            <option value="0">{{trans('Students_trans.All')}}</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="card-body datepicker-form">
                                    <div class="input-group" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control range-from date-picker-default"
                                               placeholder="{{trans('Students_trans.Start_Date')}}" required name="from">
                                        <span class="input-group-addon">==></span>
                                        <input class="form-control range-to date-picker-default"
                                               placeholder="{{trans('Students_trans.End_Date')}}" type="text" required name="to">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                    type="submit">{{trans('Students_trans.submit')}}</button>
                        </form>

                        @isset($student_report)
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th class="alert-success">#</th>
                                        <th class="alert-success">{{trans('Students_trans.name')}}</th>
                                        <th class="alert-success">{{trans('Students_trans.Grade')}}</th>
                                        <th class="alert-success">{{trans('Students_trans.section')}}</th>
                                        <th class="alert-success">{{trans('Students_trans.Date')}}</th>
                                        <th class="alert-warning">{{trans('Sections_trans.Status')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($student_report as $student)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$student->students->name}}</td>
                                            <td>{{$student->grade->Name}}</td>
                                            <td>{{$student->section->Name_Section}}</td>
                                            <td>{{$student->attendence_date}}</td>
                                            <td>

                                                @if($student->attendence_status == 0)
                                                    <span class="btn-danger">{{trans('Students_trans.absence')}}</span>
                                                @else
                                                    <span class="btn-success">{{trans('Students_trans.Presence')}}</span>
                                                @endif
                                            </td>
                                        </tr>
{{--                                  @include('pages.Students.Delete')--}}
                                    @endforeach
                                </table>
                            </div>
                        @endisset

                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    @endsection
    @section('js')

    @endsection
