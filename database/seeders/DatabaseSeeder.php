<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * SEED USERS | PERMISSION | ROLES
         */
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['guard_name' => 'admin', 'name' => 'dashboard']);
        Permission::create(['guard_name' => 'admin', 'name' => 'employer menu']);
        Permission::create(['guard_name' => 'admin', 'name' => 'job seeker menu']);
        Permission::create(['guard_name' => 'admin', 'name' => 'manage users']);
        Permission::create(['guard_name' => 'admin', 'name' => 'additional']);
        Permission::create(['guard_name' => 'admin', 'name' => 'settings']);

        // create roles and assign existing permissions
        $role1 = Role::create(['guard_name' => 'admin', 'name' => 'employer']);
        $role1->givePermissionTo('dashboard');
        $role1->givePermissionTo('employer menu');


        $role2 = Role::create(['guard_name' => 'admin', 'name' => 'job seeker']);
        $role2->givePermissionTo('dashboard');
        $role2->givePermissionTo('job seeker menu');

        $role3 = Role::create(['guard_name' => 'admin', 'name' => 'admin']);
        $role3->givePermissionTo('dashboard');
        $role3->givePermissionTo('employer menu');
        $role3->givePermissionTo('job seeker menu');
        $role3->givePermissionTo('manage users');
        $role3->givePermissionTo('settings');
        $role3->givePermissionTo('additional');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create users
        $user = \App\Models\User::factory()->create([
            'name' => 'Работадатель',
            'email' => 'employer@email.com',
            'password' => bcrypt('123456789')
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Вакант',
            'email' => 'jobseeker@email.com',
            'password' => bcrypt('123456789')
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Админ',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456789')
        ]);
        $user->assignRole($role3);

        /**
         * SEED SETTINGS TABLE
         */
        $settings = [
            0 => [
                'title' => 'Логотип сайта',
                'key' => 'site_logo',
                'value' => 'images/setting/vfNEzTyGhS4DyWs.png',
                'type' => '<div class="input-group"><div class="custom-file"><input type="file" class="custom-file-input" style="width: 100%;" name="value" id="value"><label class="custom-file-label" for="value">Выбрать файл</label></div></div>'
            ],
            1 => [
                'title' => 'Названия сайта',
                'key' => 'site_name',
                'value' => 'AgrobankTask',
                'type' => '<input type="text" id="value" class="form-control" style="width: 100%;" name="value">'
            ],
            2 => [
                'title' => 'Мета заголовка',
                'key' => 'meta_title',
                'value' => '',
                'type' => '<input type="text" id="value" class="form-control" style="width: 100%;" name="value">'
            ],
            3 => [
                'title' => 'Мета описание',
                'key' => 'meta_description',
                'value' => '',
                'type' => '<textarea id="value" class="form-control" style="width: 100%;" name="value"></textarea>'
            ],
            4 => [
                'title' => 'Мета ключевые слова',
                'key' => 'meta_keywords',
                'value' => '',
                'type' => '<textarea id="value" class="form-control" style="width: 100%;" name="value"></textarea>'
            ],
            5 => [
                'title' => 'Электронная почта',
                'key' => 'email',
                'value' => '',
                'type' => '<input type="text" id="value" class="form-control" style="width: 100%;" name="value">'
            ],
            6 => [
                'title' => 'Телефон номер',
                'key' => 'phone_number',
                'value' => '',
                'type' => '<input type="text" id="value" class="form-control" style="width: 100%;" name="value">'
            ],
            7 => [
                'title' => 'Telegram',
                'key' => 'telegram',
                'value' => '',
                'type' => '<input type="text" id="value" class="form-control" style="width: 100%;" name="value">'
            ],
            8 => [
                'title' => 'WhatsApp',
                'key' => 'whatsapp',
                'value' => '',
                'type' => '<input type="text" id="value" class="form-control" style="width: 100%;" name="value">'
            ],
            9 => [
                'title' => 'Адрес офиса',
                'key' => 'office_address',
                'value' => '',
                'type' => '<input type="text" id="value" class="form-control" style="width: 100%;" name="value">'
            ],
        ];

        foreach ($settings as $array)
        {
            \App\Models\Admin\Setting::create($array);
        }

        /**
         * POSITIONS TABLE
         */
        $positions = [
            0 => [
                'title' => 'Frontend developer',
            ],
            1 => [
                'title' => 'Backend developer',
            ],
            2 => [
                'title' => 'Tester',
            ],
        ];

        foreach ($positions as $array)
        {
            \App\Models\Admin\Position::create($array);
        }
    }
}
