<?php

use Illuminate\Database\Seeder;

class ServerInfosSeed extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('companies')->insert([
			'id' => 2,
			'name' => 'docker',
			'created_at' => date('Y-m-d H:i:s'),
		]);


		$company_id = DB::table('companies')->select('id')->where('name', 'docker')->first()->id;

		DB::table('users')->insert([
			'id' => 2,
			'name' => 'docker',
			'email' => 'docker'.str_random(2).'@docker.com',
			'password' => bcrypt('secret'),
			'company_id' => $company_id,
		]);

		DB::table('server_infos')->insert([
			'name' => 'monitor_db',
			'host' => 'db',
			'username' => 'dba',
			'password' => 'zoilo367',
			'created_at' => date('Y-m-d H:i:s'),
			'company_id' => $company_id,
		]);
	}
}
