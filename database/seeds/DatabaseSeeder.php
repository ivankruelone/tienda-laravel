<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->name = 'Iván Zúñiga Pérez';
        $user->email = 'domkruel@gmail.com';
        $user->password = bcrypt('garigol');
        $user->role = 'admin';
        $user->save();

        $category = new \App\Category;
        $category->category = 'Jeans';
        $category->save();

        $category = new \App\Category;
        $category->category = 'T-shirt';
        $category->save();

        $category = new \App\Category;
        $category->category = 'Sweatshirts';
        $category->save();

        $category = new \App\Category;
        $category->category = 'Shoes';
        $category->save();

        $gender = new \App\Gender;
        $gender->gender = 'Male';
        $gender->save();

        $gender = new \App\Gender;
        $gender->gender = 'Female';
        $gender->save();
    }
}
