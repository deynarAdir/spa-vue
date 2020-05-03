<?php

use App\Customer;
use App\User;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		"name" => "Deynar Adir",
    		"email" => "deynar@gmail.com",
    		"password" => bcrypt(123456)
    	]);
        // factory(Customer::class, 50)->create();
    }
}
