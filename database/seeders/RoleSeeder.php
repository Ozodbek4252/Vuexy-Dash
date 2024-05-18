<?php

namespace Database\Seeders;

use App\Models\Lang;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create([
            'active' => true,
            'slug' => 'owner',
        ]);
        // En Translation for role1
        $role1->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'Owner',
            'column_name' => 'title',
        ]);
        $role1->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'Owner role',
            'column_name' => 'description',
        ]);
        // Uz Translation for role1
        $role1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Egasi',
            'column_name' => 'title',
        ]);
        $role1->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Egasi rol',
            'column_name' => 'description',
        ]);
        // Ru Translation for role1
        $role1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Владелец',
            'column_name' => 'title',
        ]);
        $role1->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Владелец роль',
            'column_name' => 'description',
        ]);

        $role2 = Role::create([
            'active' => true,
            'slug' => 'admin',
        ]);
        // En Translation for role2
        $role2->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'Admin',
            'column_name' => 'title',
        ]);
        $role2->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'Admin role',
            'column_name' => 'description',
        ]);
        // Uz Translation for role2
        $role2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Admin',
            'column_name' => 'title',
        ]);
        $role2->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Admin rol',
            'column_name' => 'description',
        ]);
        // Ru Translation for role2
        $role2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Админ',
            'column_name' => 'title',
        ]);
        $role2->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Админ роль',
            'column_name' => 'description',
        ]);

        $role3 = Role::create([
            'active' => true,
            'slug' => 'manager',
        ]);
        // En Translation for role3
        $role3->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'Manager',
            'column_name' => 'title',
        ]);
        $role3->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'Manager role',
            'column_name' => 'description',
        ]);
        // Uz Translation for role3
        $role3->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Menejer',
            'column_name' => 'title',
        ]);
        $role3->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Menejer rol',
            'column_name' => 'description',
        ]);
        // Ru Translation for role3
        $role3->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Менеджер',
            'column_name' => 'title',
        ]);
        $role3->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Менеджер роль',
            'column_name' => 'description',
        ]);

        $role4 = Role::create([
            'active' => true,
            'slug' => 'regular',
        ]);
        // En Translation for role4
        $role4->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'Regular',
            'column_name' => 'title',
        ]);
        $role4->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'Regular user',
            'column_name' => 'description',
        ]);
        // Uz Translation for role4
        $role4->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Oddiy',
            'column_name' => 'title',
        ]);
        $role4->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'Oddiy foydalanuvchi',
            'column_name' => 'description',
        ]);
        // Ru Translation for role4
        $role4->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Обычный',
            'column_name' => 'title',
        ]);
        $role4->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'Обычный пользователь',
            'column_name' => 'description',
        ]);
    }
}
