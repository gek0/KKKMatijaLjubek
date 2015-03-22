<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('username' => 'ljubek_admin',
                            'email' => 'kkkmatijaljubek@kkkmatijaljubek.hr',
                            'password' => \Illuminate\Support\Facades\Hash::make('admin')
                        )
                    );
    }

}