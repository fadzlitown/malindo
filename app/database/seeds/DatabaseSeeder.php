<?php

use App\Models\Account,
    App\Models\Brand,
    App\Models\Category,
    App\Models\FeatureCategory,
    App\Models\Model,
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

//        $this->call('PlanSeeder');
//        $this->call('AccountSeeder');
//        $this->call('CategorySeeder');
//        $this->call('BrandSeeder');
//        $this->call('ModelSeeder');
        $this->call('FeatureCategorySeeder');
        $this->call('FeatureCategoryInstanceSeeder');
        $this->call('FeatureCategoryInstanceMetaSeeder');
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

class CategorySeeder extends Seeder
{

    function run()
    {
        DB::table("models")->delete();
        DB::table("brands")->delete();
        DB::table("categories")->delete();

        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            Category::create([
                'id'   => $index,
                'name' => $faker->company
            ]);
        }
    }

}

class BrandSeeder extends Seeder
{

    function run()
    {
        DB::table("brands")->delete();

        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            Brand::create([
                'id'   => $index,
                'name' => $faker->company
            ]);
        }
    }

}

class ModelSeeder extends Seeder
{

    function run()
    {
        DB::table("models")->delete();

        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            Model::create([
                'id'   => $index,
                'name' => $faker->company
            ]);
        }
    }

}

class FeatureCategorySeeder extends Seeder
{

    function run()
    {
        DB::table("feature_categories_instances_metas")->delete();
        DB::table("feature_categories_instances")->delete();
        DB::table("feature_categories")->delete();

        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            FeatureCategory::create([
                'id'   => $index,
                'name' => $faker->word
            ]);
        }
    }

}

class FeatureCategoryInstanceSeeder extends Seeder
{

    function run()
    {
        DB::table("feature_categories_instances")->delete();

        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            \App\Models\FeatureCategoryInstance::create([
                'id'                  => $index,
                'name'                => $faker->word,
                'feature_category_id' => rand(1, 10)
            ]);
        }
    }

}

class FeatureCategoryInstanceMetaSeeder extends Seeder
{

    function run()
    {
        DB::table("feature_categories_instances_metas")->delete();

        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            \App\Models\FeatureCategoryInstanceMeta::create([
                'id'     => $index,
                'key'    => $faker->word,
                'value'  => $faker->word,
                'fci_id' => rand(1, 50)
            ]);
        }
    }

}
