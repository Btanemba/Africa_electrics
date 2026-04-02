{{-- This file is used for menu items by any Backpack v7 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Categories" icon="la la-tags" :link="backpack_url('category')" />

<x-backpack::menu-item title="Products" icon="la la-box" :link="backpack_url('product')" />

<x-backpack::menu-dropdown title="Careers" icon="la la-briefcase">
    <x-backpack::menu-dropdown-item title="Job Listings" icon="la la-list" :link="backpack_url('job-listing')" />
    <x-backpack::menu-dropdown-item title="Applications" icon="la la-file-alt" :link="backpack_url('job-application')" />
</x-backpack::menu-dropdown>
