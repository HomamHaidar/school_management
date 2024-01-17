@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('Students_trans.Quizzes_list')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('Students_trans.Quizzes_list')}}
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.Subject_Name')}} </th>
                                            <th>{{trans('Students_trans.Quiz_name')}}</th>
                                            <th>{{trans('Students_trans.Enter_Exam/degree')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->subject->name}}</td>
                                                <td>{{$quizze->name}}</td>

                                                <td>
                                                    @php
                                                        $student_id = auth()->user()->id;
                                                        $hasTakenQuiz = false;
                                                    @endphp

                                                    @for ($i = 0; $i < $quizze->degree->count(); $i++)
                                                        @if ($student_id == $quizze->degree[$i]->student_id && $quizze->id == $quizze->degree[$i]->quizze_id)
                                                            <p class="badge badge-success">{{ $quizze->degree[$i]->score }}</p>
                                                            @php
                                                                $hasTakenQuiz = true;
                                                            @endphp
                                                            @break
                                                        @endif
                                                    @endfor

                                                    @if (!$hasTakenQuiz)
                                                        <a href="{{ route('student_exam.show', $quizze->id) }}" class="btn btn-outline-success btn-sm" role="button" aria-pressed="true" onclick="alertAbuse()">
                                                            <i class="fas fa-person-booth"></i>
                                                        </a>
                                                    @endif

                                                </td>

                                            </tr>
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

        <script>
            function alertAbuse() {
                alert("برجاء عدم إعادة تحميل الصفحة بعد دخول الاختبار - في حال تم تنفيذ ذلك سيتم الغاء الاختبار بشكل اوتوماتيك ");
            }
        </script>

@endsection
