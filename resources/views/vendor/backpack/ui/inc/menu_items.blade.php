{{-- This file is used for menu items by any Backpack v7 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@if(backpack_user()->hasRoleCode('ADM') || backpack_user()->hasRoleCode('MS'))
    <x-backpack::menu-item title="Categories" icon="la la-tags" :link="backpack_url('category')" />

    <x-backpack::menu-item title="Products" icon="la la-box" :link="backpack_url('product')" />

    <x-backpack::menu-item title="Services" icon="la la-cogs" :link="backpack_url('service')" />

    <x-backpack::menu-item title="Projects" icon="la la-briefcase" :link="backpack_url('project')" />

    <li class="nav-item">
        <a class="nav-link" href="https://webmail.africaelectric.co" target="_blank" rel="noopener noreferrer">
            <i class="nav-icon la la-envelope"></i> Email
        </a>
    </li>

    @php $pendingCount = \App\Models\Order::where('status', 'pending')->count(); @endphp
    <li class="nav-item">
        <a class="nav-link" href="{{ backpack_url('order') }}">
            <i class="nav-icon la la-shopping-cart"></i> Orders
            @if($pendingCount > 0)
                <span class="badge bg-danger ms-auto">{{ $pendingCount }} new</span>
            @endif
        </a>
    </li>
@endif

@if(backpack_user()->hasRoleCode('DRV') || backpack_user()->hasRoleCode('ADM'))
    <x-backpack::menu-item title="My Deliveries" icon="la la-truck" :link="url('admin/driver')" />
@endif

@if(backpack_user()->hasRoleCode('ADM') || backpack_user()->hasRoleCode('HR'))
    <x-backpack::menu-dropdown title="Careers" icon="la la-briefcase">
        <x-backpack::menu-dropdown-item title="Job Listings" icon="la la-list" :link="backpack_url('job-listing')" />
        <x-backpack::menu-dropdown-item title="Applications" icon="la la-file-alt" :link="backpack_url('job-application')" />
    </x-backpack::menu-dropdown>
    <x-backpack::menu-dropdown title="Employees" icon="la la-users">
        <x-backpack::menu-dropdown-item title="Team Members" icon="la la-users" :link="backpack_url('team-member')" />
        <x-backpack::menu-dropdown-item title="Staffs" icon="la la-user" :link="backpack_url('user')" />
    </x-backpack::menu-dropdown>
@endif

@if(backpack_user()->hasRoleCode('ADM'))
    <x-backpack::menu-dropdown title="Roles & Permissions" icon="la la-user-shield">
        <x-backpack::menu-dropdown-item title="Company Positions" icon="la la-user-tag" :link="backpack_url('role')" />
        <x-backpack::menu-dropdown-item title="Staff Roles" icon="la la-id-badge" :link="backpack_url('role-user')" />
    </x-backpack::menu-dropdown>
@endif
