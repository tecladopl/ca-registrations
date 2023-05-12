<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {


        $input = [
            'name' => 'Damian Kozłowski',
            'email' => 'dkozlowski@teclado.pl',
            'password' => 'Unununium1',
            'password_confirmation' => 'Unununium1',
        ];

        $creator = new CreateNewUser;
        $creator->create($input);
        $user = User::first();
        $user->email_verified_at = Carbon::now();
        $user->update();
    }

}
