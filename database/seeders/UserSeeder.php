<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		User::factory()->create([
			'name' => 'Administrator',
			'email' => 'admin@example.com',
		]);

		User::factory(3)->create();
	}
}
