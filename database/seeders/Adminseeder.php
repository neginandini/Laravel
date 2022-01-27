<?php

namespace Database\Seeders;
use App\Models\User;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'first_name' =>'Admin',
            'last_name' =>'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role_type'=>'admin',
            'status'=>1,
            'role_id'=>2]);
            User::create([
         'first_name' =>'Customer',
            'last_name' =>'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('customer123'),
            'role_type'=>'customer',
            'status'=>1,
            'role_id'=>5
            ]);
           
    }
}
