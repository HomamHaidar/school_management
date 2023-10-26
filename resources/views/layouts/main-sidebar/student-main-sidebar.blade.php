<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('dashboard.student')}}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>


        <!-- الامتحانات-->
        <li>
            <a href="{{route('student_exam.index')}}"><i class="fas fa-question-circle"></i><span
                    class="right-nav-text">{{trans('Students_trans.Quizzes')}}</span></a>
        </li>
        <li>
            <a href="{{route('show_book')}}"><i class="fas fa-book"></i><span
                    class="right-nav-text">{{trans('main_trans.library')}}</span></a>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{route('student_profile.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{trans('Students_trans.Profile')}}</span></a>
        </li>

    </ul>
</div>
