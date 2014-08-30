<?php

use App\Models\Account,
    App\Models\Plan,
    Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('PlanSeeder');
        $this->call('AccountSeeder');
    }

}

class PlanSeeder extends Seeder
{

    public function run()
    {
        DB::table('plans')->delete();
        Plan::create(
                array(
                    'id'          => '1',
                    'name'        => 'Regular Member',
                    'description' => 'Regular Member',
                    'currency'    => 'USD',
                    'price'       => '0',
                    'limit_value' => '999',
                )
        );

        Plan::create(
                array(
                    'id'          => '2',
                    'name'        => 'Silver Member',
                    'description' => 'Silver Member',
                    'currency'    => 'USD',
                    'price'       => '99',
                    'limit_value' => '12',
                )
        );
    }

}

class AccountSeeder extends Seeder
{

    public function run()
    {
        DB::table('accounts')->delete();

        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Account::create(array(
                'id'           => $index,
                'first_name'   => $faker->firstName,
                'last_name'    => $faker->lastName,
                'email'        => $faker->email,
                'password'     => Hash::make('password'),
                'confirmed'    => 1,
                'confirmation' => md5(microtime() . Config::get('app.key')),
                'plan_id'      => 1
            ));
        }
    }

}
