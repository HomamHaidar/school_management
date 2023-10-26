<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template"/>
    <meta name="author" content="potenzaglobalsolutions.com"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    @include('layouts.head')
    @livewireStyles
</head>

<body>

<div class="wrapper">

    <!--=================================
preloader -->

    <div id="pre-loader">
        <img src="assets/images/pre-loader/loader-01.svg" alt="">
    </div>

    <!--=================================
preloader -->

    @include('layouts.main-header')

    @include('layouts.main-sidebar')

    <!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="mb-0 text-success" >
                        {{trans('main_trans.Welcome')}} <span >{{auth()->user()->Name}}</span>
                    </h2>
                </div>
                <br>
                <br>

                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>

        <!-- widgets -->

        <div class="row">

            <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">

                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>

                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{trans('main_trans.Number_of_students')}}</p>
                                <h4>{{$students_count}}</h4>
                            </div>

                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                href="{{route('students.index')}}" target="_blank"><span class="text-danger">{{trans('main_trans.Show_Data')}}</span></a>
                        </p>
                    </div>

                </div>
            </div>


            <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{trans('main_trans.Number_of_sections')}}</p>
                                <h4>{{$section_count}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                href="{{route('sections')}}" target="_blank"><span class="text-danger">{{trans('main_trans.Show_Data')}}</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Status widgets-->

        <div class="row">

            <div  style="height: 400px;" class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">

                    <div class="card-body">
                        <div class="tab nav-border" style="position: relative;">
                            <div class="d-block d-md-flex justify-content-between">
                                <div class="d-block w-100">
                                    <h5 style="font-family: 'Cairo', sans-serif" class="card-title">{{trans('main_trans.last_operations')}}</h5>
                                </div>
                                <div class="d-block d-md-flex nav-tabs-custom">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                               href="#students" role="tab" aria-controls="students"
                                               aria-selected="true">{{trans('main_trans.students')}}</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                               role="tab" aria-controls="teachers" aria-selected="false">{{trans('main_trans.sections')}}
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                               role="tab" aria-controls="parents" aria-selected="false">{{trans('Students_trans.Quizzes')}}
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">

                                {{--students Table--}}
                                  <div class="tab-pane fade active show" id="students" role="tabpanel" aria-labelledby="students-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr  class="table-success text-bg-dark">
                                                <th>#</th>
                                                <th>{{trans('Students_trans.name')}}</th>
                                                <th>{{trans('Students_trans.email')}}</th>
                                                <th>{{trans('Students_trans.gender')}}</th>
                                                <th>{{trans('Students_trans.Grade')}}</th>
                                                <th>{{trans('Students_trans.Classroom')}}</th>
                                                <th>{{trans('Students_trans.section')}}</th>
                                                <th>{{trans('main_trans.date_of_registration')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse(\App\Models\Student::whereIn('section_id', $ids)->latest()->take(5)->get() as $student)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$student->name}}</td>
                                                    <td>{{$student->email}}</td>
                                                    <td>{{$student->gender->Name}}</td>
                                                    <td>{{$student->grade->Name}}</td>
                                                    <td>{{$student->classroom->Name_Class}}</td>
                                                    <td>{{$student->section->Name_Section}}</td>
                                                    <td class="text-success">{{$student->created_at}}</td>
                                                    @empty
                                                        <td class="alert-danger" colspan="8">{{trans('main_trans.no_data')}}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{--section Table--}}
                                <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr  class="table-success text-bg-dark">
                                                <th>#</th>
                                                <th>{{trans('Students_trans.Grade')}}</th>
                                                <th>{{trans('Students_trans.Classroom')}}</th>
                                                <th>{{trans('Students_trans.section')}}</th>
                                                <th>{{trans('main_trans.Number_of_students')}}</th>
                                                <th>{{trans('Sections_trans.Status')}}</th>
                                            </tr>
                                            </thead>

                                            @forelse(\App\Models\Sections::whereIn('id',$ids)->latest()->take(5)->get() as $section)
                                                <tbody>
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $section->Grades->Name }}</td>
                                                    <td>{{ $section->My_classs->Name_Class }}</td>
                                                    <td>{{ $section->Name_Section }}</td>
                                                    <td>{{ $section->student->count()}}</td>
                                                    <td>
                                                        @if ($section->Status === 1)
                                                            <label
                                                                class="badge badge-success">{{ trans('Sections_trans.Status_Section_AC') }}</label>
                                                        @else
                                                            <label
                                                                class="badge badge-danger">{{ trans('Sections_trans.Status_Section_No') }}</label>
                                                        @endif

                                                    </td>



                                                    @empty
                                                        <td class="alert-danger" colspan="8">{{trans('main_trans.no_data')}}</td>
                                                </tr>
                                                </tbody>
                                            @endforelse
                                        </table>
                                    </div>
                                </div>

                                {{--Exam Table--}}
                                <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr  class="table-success text-bg-dark">
                                                <th>#</th>
                                                <th>{{trans('Students_trans.Subject_Name')}}</th>
                                                <th>{{trans('Students_trans.Quiz_name')}}</th>
                                                <th>{{trans('Students_trans.Grade')}}</th>
                                                <th>{{trans('Students_trans.Classroom')}}</th>
                                                <th>{{trans('Students_trans.section')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse(\App\Models\Quizze::latest()->take(5)->get() as $quizze)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$quizze->subject->name}}</td>
                                                    <td class="badge badge-success" >
                                                        <a href="{{route('Quizzes.show',$quizze->id)}}" style="font-size: medium" title="اذهب الى الاختبار"  >{{$quizze->name}}</a>
                                                    </td>
                                                    <td>{{$quizze->grade->Name}}</td>
                                                    <td>{{$quizze->classroom->Name_Class}}</td>
                                                    <td>{{$quizze->section->Name_Section}}</td>

                                                    @empty
                                                        <td class="alert-danger" colspan="8">{{trans('main_trans.no_data')}}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <livewire:calendar />

        <!--=================================
wrapper -->

        <!--=================================
footer -->

        @include('layouts.footer')
    </div><!-- main content wrapper end-->
</div>
</div>
</div>

<!--=================================
footer -->

@include('layouts.footer-scripts')
@livewireScripts
@stack('scripts')

</body>

</html>
