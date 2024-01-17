@extends('layouts.master')
@section('css')

    @section('title')
     {{trans('Students_trans.Questions_list')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('Students_trans.Questions_list')}}
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
                                <a href="{{route('Question_admin.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">
                                    {{trans('Students_trans.Add_Questions')}}

                                </a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{trans('Students_trans.The_Question')}}</th>
                                            <th scope="col">{{trans('Students_trans.Answers')}}</th>
                                            <th scope="col">{{trans('Students_trans.Right_answer')}}</th>
                                            <th scope="col">{{trans('Students_trans.degree')}}</th>
                                            <th scope="col">{{trans('Students_trans.Quiz_name')}}</th>
                                            <th scope="col">{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$question->title}}</td>
                                                <td>{{$question->answers}}</td>
                                                <td>{{$question->right_answer}}</td>
                                                <td>{{$question->score}}</td>
                                                <td>{{$question->quizze->name}}</td>
                                                <td>
                                                    <a href="{{route('Question_admin.edit',$question->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $question->id }}" title="{{trans('Students_trans.Delete_Question')}}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        @include('pages.Question.Delete')
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
