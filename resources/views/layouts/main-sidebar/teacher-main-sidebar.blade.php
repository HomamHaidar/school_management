<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>

        <!-- الاقسام-->
        <li>
            <a href="{{route('sections')}}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{trans('main_trans.sections')}}</span></a>
        </li>

        <!-- الطلاب-->
        <li>
            <a href="{{route('students.index')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{trans('main_trans.students')}}</span></a>
        </li>




        <!-- Exams-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('Students_trans.Quizzes')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('Quizzes.index')}}">{{trans('Students_trans.Quizzes')}}</a> </li>


            </ul>
        </li


        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{trans('Students_trans.Reports')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('attendance.report')}}">
                        {{trans('Students_trans.Attendance_reports')}}
                    </a></li>
            </ul>

        </li>


        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('profile.show')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">  {{trans('Students_trans.Profile')}} </span></a>
        </li>

    </ul>
</div>
