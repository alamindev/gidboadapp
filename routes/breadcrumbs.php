<?php
use App\User;
use App\Permission;
use App\Role;
use App\Fuel;
use App\PowerPlant;
use App\PowerInfo;
use App\DistributionInfo;
use App\Distribution;
use App\Map;
use App\MapOption;
use App\Slider;
use App\General;
use App\ManualCap;
use App\HowTo;

// Home
Breadcrumbs::register('admin', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin'));
});
// for users
Breadcrumbs::register('users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-users', route('users.index'));
});
Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('Create-new-user', route('users.create'));
});
Breadcrumbs::register('users.show', function ($breadcrumbs, $id) {
    $user = User::findOrFail($id);
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push("view" . '-' . $user->name, route('users.show', $user->id));
});
Breadcrumbs::register('users.edit', function ($breadcrumbs, $id) {
    $user = User::findOrFail($id);
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push("edit" . '-' . $user->name, route('users.edit', $user->id));
});
// for roles
Breadcrumbs::register('roles.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-roles', route('roles.index'));
});
Breadcrumbs::register('roles.create', function ($breadcrumbs) {
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push('Create-new-Role', route('roles.create'));
});
Breadcrumbs::register('roles.show', function ($breadcrumbs, $id) {
    $role = Role::findOrFail($id);
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push("view" . '-' . $role->name, route('roles.show', $role->id));
});
Breadcrumbs::register('roles.edit', function ($breadcrumbs, $id) {
    $role = Role::findOrFail($id);
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push("edit" . '-' . $role->name, route('roles.edit', $role->id));
});
// for permission
Breadcrumbs::register('permissions.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-permissions', route('permissions.index'));
});
Breadcrumbs::register('permissions.create', function ($breadcrumbs) {
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push('Create-new-Permission', route('permissions.create'));
});
Breadcrumbs::register('permissions.show', function ($breadcrumbs, $id) {
    $permission = Permission::findOrFail($id);
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push("view" . '-' . $permission->name, route('permissions.show', $permission->id));
});
Breadcrumbs::register('permissions.edit', function ($breadcrumbs, $id) {
    $permission = Permission::findOrFail($id);
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push("edit" . '-' . $permission->name, route('permissions.edit', $permission->id));
});
// for fuel
Breadcrumbs::register('fuels.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-fuels', route('fuels.index'));
});
Breadcrumbs::register('fuels.create', function ($breadcrumbs) {
    $breadcrumbs->parent('fuels.index');
    $breadcrumbs->push('Create-new-fuel-type', route('fuels.create'));
});
Breadcrumbs::register('fuels.show', function ($breadcrumbs, $id) {
    $fuel = Fuel::where('id', $id)->first();
    $breadcrumbs->parent('fuels.index');
    $breadcrumbs->push("show" . '-' . $fuel->name, route('fuels.show', $fuel->id));
});
Breadcrumbs::register('fuels.edit', function ($breadcrumbs, $fuel) {
    $breadcrumbs->parent('fuels.index');
    $breadcrumbs->push("edit" . '-' . $fuel->name, route('fuels.edit', $fuel->id));
});
// for manual
Breadcrumbs::register('manuals.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-manuals', route('manuals.index'));
});
Breadcrumbs::register('manuals.create', function ($breadcrumbs) {
    $breadcrumbs->parent('manuals.index');
    $breadcrumbs->push('Create-new-fuel-type', route('manuals.create'));
});
Breadcrumbs::register('manuals.edit', function ($breadcrumbs, $id) {
    $manual = ManualCap::where('id', $id)->first();
    $breadcrumbs->parent('manuals.index');
    $breadcrumbs->push("edit" . '-' . $manual->name, route('manuals.edit', $manual->id));
});
// for powser
Breadcrumbs::register('powers.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-powers-plant', route('powers.index'));
});
Breadcrumbs::register('powers.create', function ($breadcrumbs) {
    $breadcrumbs->parent('powers.index');
    $breadcrumbs->push('Create-new-power-plant', route('powers.create'));
});
Breadcrumbs::register('powers.edit', function ($breadcrumbs, $power) {
    $breadcrumbs->parent('powers.index');
    $breadcrumbs->push("edit" . '-' . $power->name, route('powers.edit', $power->id));
});
// for Power information
Breadcrumbs::register('power-info.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-power-information', route('power-info.index'));
});

Breadcrumbs::register('power-info.create', function ($breadcrumbs) {
    $breadcrumbs->parent('power-info.index');
    $breadcrumbs->push('Create-new-power-information', route('power-info.create'));
});
Breadcrumbs::register('power-info.show', function ($breadcrumbs, $id) {
    $power_info = PowerInfo::find($id);
    $breadcrumbs->parent('power-info.index');
    $breadcrumbs->push("view-Power-infomation", route('power-info.show', $power_info->id));
});
Breadcrumbs::register('power-info.edit', function ($breadcrumbs, $id) {
    $power_info = PowerInfo::find($id);
    $breadcrumbs->parent('power-info.index');
    $breadcrumbs->push("edit-power-information", route('power-info.edit', $power_info->id));
});
// for google map options
Breadcrumbs::register('map-option.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-map-option', route('map-option.index'));
});

Breadcrumbs::register('map-option.edit', function ($breadcrumbs, $id) {
    $map = MapOption::find($id);
    $breadcrumbs->parent('map-option.index');
    $breadcrumbs->push("edit-map-option", route('map-option.edit', $map->id));
});

// for google map api
Breadcrumbs::register('map-info.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-map-info', route('map-info.index'));
});

Breadcrumbs::register('map-info.create', function ($breadcrumbs) {
    $breadcrumbs->parent('map-info.index');
    $breadcrumbs->push('Create-new-fuel-type', route('map-info.create'));
});
Breadcrumbs::register('map-info.show', function ($breadcrumbs, $id) {
    $map = Map::find($id);
    $breadcrumbs->parent('map-info.index');
    $breadcrumbs->push("show-map-info", route('map-info.show', $map->id));
});
Breadcrumbs::register('map-info.edit', function ($breadcrumbs, $id) {
    $map = Map::find($id);
    $breadcrumbs->parent('map-info.index');
    $breadcrumbs->push("edit-map-info", route('map-info.edit', $map->id));
});
// for export import
Breadcrumbs::register('distributions.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-distributions', route('distributions.index'));
});

Breadcrumbs::register('distributions.create', function ($breadcrumbs) {
    $breadcrumbs->parent('distributions.index');
    $breadcrumbs->push('Create-new-distributions', route('distributions.create'));
});
Breadcrumbs::register('distributions.edit', function ($breadcrumbs, $id) {
    $dis = Distribution::find($id);
    $breadcrumbs->parent('distributions.index');
    $breadcrumbs->push("edit-distributions", route('distributions.edit', $dis->id));
});
// for Distribution Power information
Breadcrumbs::register('distributions-info.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-distributions-informition', route('distributions-info.index'));
});

Breadcrumbs::register('distributions-info.create', function ($breadcrumbs) {
    $breadcrumbs->parent('distributions-info.index');
    $breadcrumbs->push('Create-new-distributions-informition', route('distributions-info.create'));
});
Breadcrumbs::register('distributions-info.show', function ($breadcrumbs, $id) {
    $distributioninfo = DistributionInfo::find($id);
    $breadcrumbs->parent('distributions-info.index');
    $breadcrumbs->push("view-distributions-info", route('distributions-info.show', $distributioninfo->id));
});
Breadcrumbs::register('distributions-info.edit', function ($breadcrumbs, $id) {
    $distributioninfo = DistributionInfo::find($id);
    $breadcrumbs->parent('distributions-info.index');
    $breadcrumbs->push("edit-distribution-informition", route('distributions-info.edit', $distributioninfo->id));
});
// for slider
Breadcrumbs::register('slider.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('All-sliderrmation', route('slider.index'));
});

Breadcrumbs::register('slider.create', function ($breadcrumbs) {
    $breadcrumbs->parent('slider.index');
    $breadcrumbs->push('Create-new-slider', route('slider.create'));
});
Breadcrumbs::register('slider.show', function ($breadcrumbs, $id) {
    $slider = Slider::find($id);
    $breadcrumbs->parent('slider.index');
    $breadcrumbs->push("view-slidermation", route('users.show', $slider->id));
});
Breadcrumbs::register('slider.edit', function ($breadcrumbs, $id) {
    $slider = Slider::find($id);
    $breadcrumbs->parent('slider.index');
    $breadcrumbs->push("edit-sliderrmation", route('slider.edit', $slider->id));
});
// for website general setting
Breadcrumbs::register('general-setting.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('add-general-setting', route('general-setting.index'));
});

Breadcrumbs::register('general-setting.edit', function ($breadcrumbs, $id) {
    $general = General::find($id);
    $breadcrumbs->parent('general-setting.index');
    $breadcrumbs->push("update-general-setting", route('general-setting.edit', $general->id));
});
// for total capacity
Breadcrumbs::register('total-capacity.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('add-total-capacity', route('total-capacity.index'));
});

Breadcrumbs::register('total-capacity.edit', function ($breadcrumbs, $id) {
    $general = General::find($id);
    $breadcrumbs->parent('total-capacity.index');
    $breadcrumbs->push("update-total-capacity", route('total-capacity.edit', $general->id));
});
// for help and about
Breadcrumbs::register('howtos.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('add-how-to', route('howtos.index'));
});

Breadcrumbs::register('howto.edit', function ($breadcrumbs, $id) {
    $howto = HowTo::find($id);
    $breadcrumbs->parent('howtos.index');
    $breadcrumbs->push("update-how-to", route('howtos.edit', $howto->id));
});
