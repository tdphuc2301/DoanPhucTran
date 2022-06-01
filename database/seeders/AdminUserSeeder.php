<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayUsernameUser = ['manager', 'CN1_admin', 'CN2_admin','CN1_shipper','CN2_shipper'];
        $arraySearchNameUser = ['manager', 'CN1_admin', 'CN2_admin','CN1_shipper','CN2_shipper'];
        $arrayNameEmail = ['manager@gmail.com', 'CN1_admin@gmail.com', 'CN2_admin@gmail.com','CN1_shipper@gmail.com', 'CN2_shipper@gmail.com'];
        $arrayNamePassword = ['manager', 'CN1_admin', 'CN2_admin','CN1_shipper','CN2_shipper'];
        $arrayNameUser = ['manager', 'CN1_admin', 'CN2_admin','CN1_shipper','CN2_shipper'];
        $arrayRoleUser = [1, 2, 2,3,3];
        $arrayBranchIdUser = [null, 1, 2,1,2];
        for ($i = 0; $i < count($arrayUsernameUser); $i++) {
            DB::table('users')->insert([
                'name' => $arrayNameUser[$i],
                'username' => $arrayUsernameUser[$i],
                'email' => $arrayNameEmail[$i],
                'password' => Hash::make($arrayNamePassword[$i]),
                'role_id' => $arrayRoleUser[$i],
                'branch_id' => $arrayBranchIdUser[$i],
                'search' => $arraySearchNameUser[$i],
            ]);
        }
    }
}
