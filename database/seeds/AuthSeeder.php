<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Cache::flush('spatie.permission.cache');
        Cache::flush('spatie.role.cache');



        Role::create(['name' => 'client_agent']);
        Role::create(['name' => 'receptionist']);
        Role::create(['name' => 'financial_manager']);


        $receptionist = [
            'user_id' => 'RR0000001',
            'name' => 'Lahiruni Perera',
            'email' => 'receptionist@gmail.com',
            'password' => Hash::make('123456')
        ];

        $user = User::create($receptionist);
        $user->assignRole('receptionist');
        $user->syncRoles('receptionist');

        $client_agent = [
            'user_id' => 'CA0000001',
            'name' => 'Rameera Ravishka',
            'email' => 'c.agent@gmail.com',
            'password' => Hash::make('123456')
        ];

        $agent_user = User::create($client_agent);
        $agent_user->assignRole('client_agent');
        $agent_user->syncRoles('client_agent');

        $financial_manager = [
            'user_id' => 'FM0000001',
            'name' => 'Kasun Madhawa',
            'email' => 'f.manager@gmail.com',
            'password' => Hash::make('123456')
        ];

        $manager_user = User::create($financial_manager);
        $manager_user->assignRole('financial_manager');
        $manager_user->syncRoles('financial_manager');

//        $this->command->info("You have been created set of Permissions | Role and Define Super Admin \n email - admin@admin.com \n Password - 123456");
    }
}
