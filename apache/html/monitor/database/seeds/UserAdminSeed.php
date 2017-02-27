<?php

use Illuminate\Database\Seeder;

class UserAdminSeed extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('companies')->insert([
			'id' => 1,
			'name' => 'monitor',
			'created_at' => date('Y-m-d H:i:s'),
		]);

		$company_id = DB::table('companies')->select('id')->where('name', 'docker')->first()->id;

		DB::table('users')->insert([
			'id' => 1,
			'name' => 'admin',
			'email' => 'admin@monitor.com',
			'password' => bcrypt('Eak@829ij23#'),
			'company_id' => $company_id,
		]);


		$user_id = DB::table('users')->select('id')->where('name', 'admin')->first()->id;

		DB::table('roles')->insert([
			['name' => 'manage_admins'],
			['name' => 'manage_companys'],
			['name' => 'manage_users'],
			['name' => 'view_reports']
		]);

		$roles = DB::table('roles')->select('id')->get();

		foreach ($roles as $role_id) {
			DB::table('users_roles')->insert([
				'user_id' => $user_id,
				'role_id' => $role_id->id,
			]);
		}

	}
}
