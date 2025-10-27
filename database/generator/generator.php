<?php

use Core\Database\Generator;
use App\Models\User;
use Core\Valid\Hash;

return new class implements Generator
{
    /**
     * Generate nilai database
     *
     * @return void
     */
    public function run()
    {
        $user = User::find('dani.rima@user.com', 'email');

        if (!$user->exist()) {
            $user = User::create([
                'name' => 'Maspuk - Azarima',
                'email' => 'dani.rima@user.com',
                'password' => Hash::make('12345678')
            ]);
        }

        $user->fill([
            'is_filter' => true,
            'is_active' => true,
            'is_confetti_animation' => true,
            'tz' => 'Asia/Jakarta',
            'access_key' => Hash::rand(25),
        ])->save();
    }
};
