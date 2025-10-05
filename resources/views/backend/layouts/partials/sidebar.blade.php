 <!-- sidebar menu area start -->
 @php
     $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">Admin</h2> 
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))

                    <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="ti-dashboard"></i><span>Dashboard</span></a></li>

                    @endif

                    @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Roles & Permissions
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            @endif
                            @if ($usr->can('role.create'))
                                <li class="{{ Route::is('admin.roles.create')  ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('exam-forms.create') || $usr->can('exam-forms.view') ||  $usr->can('exam-forms.edit') ||  $usr->can('exam-forms.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-graduation-cap"></i><span>
                            Exam Forms
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.exam_forms.create') || Route::is('admin.exam_forms.index') || Route::is('admin.exam_forms.edit') || Route::is('admin.exam_forms.show') ? 'in' : '' }}">
                            @if ($usr->can('exam-forms.view'))
                                <li class="{{ Route::is('admin.exam_forms.index')  || Route::is('admin.exam_forms.edit') ? 'active' : '' }}"><a href="{{ route('admin.exam_forms.index') }}">All Exam Forms</a></li>
                            @endif
                            @if ($usr->can('exam-forms.create'))
                                <li class="{{ Route::is('admin.exam_forms.create')  ? 'active' : '' }}"><a href="{{ route('admin.exam_forms.create') }}">Create Exam Forms</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    
                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">
                            
                            @if ($usr->can('admin.view'))
                                <li class="{{ Route::is('admin.admins.index')  || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                            @endif

                            @if ($usr->can('admin.create'))
                                <li class="{{ Route::is('admin.admins.create')  ? 'active' : '' }}"><a href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('submissions.list') ||  $usr->can('submissions.view'))
                    <li class="{{ Route::is('admin.submissions.index')  || Route::is('admin.submissions.edit') ? 'active' : '' }}">
                        <a href="{{ route('admin.submissions.index') }}" aria-expanded="true"><i class="fa fa-circle-o"></i><span>Submissions</span></a>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->