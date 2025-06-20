<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RolesEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        $readerRole = Role::create( [ 'name' => RolesEnum::Reader->value ] );
        $writerRole = Role::create( [ 'name' => RolesEnum::Writer->value ] );
        $adminRole = Role::create( [ 'name' => RolesEnum::Admin->value ] );

        $siteControl = Permission::create( [ 'name' => PermissionEnum::SiteControl->value ] );
        $readArticle = Permission::create( [ 'name' => PermissionEnum::ReadArticle->value ] );
        $writeArticle = Permission::create( [ 'name' => PermissionEnum::WriteArticle->value ] );

        $adminRole->syncPermissions( [ $siteControl, $readArticle, $writeArticle ] );
        $writerRole->syncPermissions( [ $readArticle, $writeArticle ] );
        $readerRole->syncPermissions( [ $readArticle ] );
    }
}
