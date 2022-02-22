<?php

namespace Database\Seeders;

use App\Models\DeliveryRoute\DeliveryRouteModel;
use App\Models\DeliveryType\DeliveryTypeModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Weight\WeightModel;
use App\Traits\UserTrait;

class DataSeeder extends Seeder
{
    use UserTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //super admin
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        //registering a superuser account
        $superAdmin = User::create(
            [
                'name' => $this->superadminSeedName,
                'email' => $this->superadminSeedEmail,
                'status' => $this->userActive,
                'email_verified_at' => now(),
                'password' => bcrypt('123456'), // password = 123456
                'remember_token' => Str::random(10),
            ]
        );
        //assigning role to super admin
        $superAdmin->assignRole($superAdminRole);

        //weight
        WeightModel::create(
            [
                'weight_name' => 'Between 0 to 5 kg',
            ]
        );

        //delivery type
        DeliveryTypeModel::create(
            [
                'delivery_type_name' => 'Regular service',
            ]
        );
        DeliveryTypeModel::create(
            [
                'delivery_type_name' => 'Express Service',
            ]
        );

        //delivery route
        DeliveryRouteModel::create(
            [
                'delivery_route_name' => 'ISD (Inside Dhaka)',
            ]
        );
        DeliveryRouteModel::create(
            [
                'delivery_route_name' => 'OSD (Outside Dhaka)',
            ]
        );
    }
}
