<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\User;
use App\Models\FanartCategory;
use App\Models\UsersType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UsersTypeSeeder::class,
            UserSeeder::class,
            FanartCategorySeeder::class,
        ]);
    }
}
class UsersTypeSeeder extends Seeder
{
    public function run()
    {
        $UsersTypes = UsersType::get();

        if($UsersTypes->count() == 0 && $UsersTypes->count() < 9){
            DB::table('usersTypes')->insert([
                'type'=>'admin',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('usersTypes')->insert([
                'type'=>'moderator',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
            DB::table('usersTypes')->insert([
                'type'=>'userPremium',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('usersTypes')->insert([
                'type'=>'userSimple',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
        }
    }
}
class UserSeeder extends Seeder
{
    public function run()
    {
        $users = User::get();

        if($users->count() == 0){
            DB::table('users')->insert([
                'name'=>'Administrador',
                'email'=>'admin@fanart.com.br',
                'password'=>bcrypt('12345678'),
                'id_usersTypes'=>'1',
                'birthday'=>'1985-10-01',
                'created_at' => '2022-01-05 18:58:56',
                'updated_at' =>'2022-01-05 18:58:56',
            ]);
        }
    }

}
class FanartCategorySeeder extends Seeder
{
    public function run()
    {
        $FanartCategory = FanartCategory::get();

        if($FanartCategory->count() == 0 && $FanartCategory->count() < 9){
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'Anime',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'Cartoon',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'Free',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'Game',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'HQ',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'Mangá',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'Manhaus',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'Movie',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'Series',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
            DB::table('fanartCategories')->insert([
                'nameCategory'=>'SciFi',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
        }
    }
}
