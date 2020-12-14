<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('investments_for_user_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/nsc-for-users*") ? "c-show" : "" }} {{ request()->is("admin/kisan-vikar-patra-for-users*") ? "c-show" : "" }} {{ request()->is("admin/policy-for-users*") ? "c-show" : "" }} {{ request()->is("admin/insurance-for-users*") ? "c-show" : "" }} {{ request()->is("admin/fd-for-users*") ? "c-show" : "" }} {{ request()->is("admin/fd-recurring-for-users*") ? "c-show" : "" }} {{ request()->is("admin/bank-accounts*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.investmentsForUser.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('nsc_for_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.nsc-for-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/nsc-for-users") || request()->is("admin/nsc-for-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.nscForUser.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('kisan_vikar_patra_for_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.kisan-vikar-patra-for-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/kisan-vikar-patra-for-users") || request()->is("admin/kisan-vikar-patra-for-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.kisanVikarPatraForUser.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('policy_for_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.policy-for-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/policy-for-users") || request()->is("admin/policy-for-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.policyForUser.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('insurance_for_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.insurance-for-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/insurance-for-users") || request()->is("admin/insurance-for-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.insuranceForUser.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('fd_for_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.fd-for-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fd-for-users") || request()->is("admin/fd-for-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.fdForUser.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('fd_recurring_for_user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.fd-recurring-for-users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fd-recurring-for-users") || request()->is("admin/fd-recurring-for-users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.fdRecurringForUser.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bank_account_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bank-accounts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bank-accounts") || request()->is("admin/bank-accounts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bankAccount.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('settings_for_admin_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/bank-for-admins*") ? "c-show" : "" }} {{ request()->is("admin/branch-of-banks-for-admins*") ? "c-show" : "" }} {{ request()->is("admin/holders-for-admins*") ? "c-show" : "" }} {{ request()->is("admin/nominees-for-admins*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.settingsForAdmin.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('bank_for_admin_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bank-for-admins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bank-for-admins") || request()->is("admin/bank-for-admins/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bankForAdmin.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('branch_of_banks_for_admin_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.branch-of-banks-for-admins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/branch-of-banks-for-admins") || request()->is("admin/branch-of-banks-for-admins/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.branchOfBanksForAdmin.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('holders_for_admin_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.holders-for-admins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/holders-for-admins") || request()->is("admin/holders-for-admins/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.holdersForAdmin.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('nominees_for_admin_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.nominees-for-admins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/nominees-for-admins") || request()->is("admin/nominees-for-admins/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.nomineesForAdmin.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>