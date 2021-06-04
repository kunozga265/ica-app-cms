<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dr. Enson
        $author= new Author([
            "avatar"      => "images/enson_lwesya.jpg",
            "name"        =>  "Rev. Dr. Enson Lwesya",
            "title"       =>  "Senior Pastor",
            "slug"        => Str::slug("Rev. Dr. Enson Lwesya"),
            "ica_pastor"  => 1,
            "biography"   => "This is a biography"
        ]);
        $author->save();

        //Dr. Mkwaila
        $author= new Author([
            "avatar"      => "images/andrew_mkwaila.jpg",
            "name"        =>  "Dr. Andrew Mkwaila",
            "title"       =>  "Executive Pastor",
            "slug"        => Str::slug("Dr. Andrew Mkwaila"),
            "ica_pastor"  => 1,
            "biography"   => "This is a biography"
        ]);
        $author->save();

        //Ps. Seira
        $author= new Author([
            "avatar"    => "images/avatar.png",
            "name"          =>  "Ps. Seira",
            "title"         =>  "Children's Pastor",
            "slug"        => Str::slug("Ps. Seira"),
            "ica_pastor"  => 0,
            "biography"   => "This is a biography"
        ]);
        $author->save();

        //Ps. Jerry Zimba
        $author= new Author([
            "avatar"    => "images/jerry_zimba.jpg",
            "name"          =>  "Ps. Jerry Zimba",
            "title"         =>  "Youth Pastor",
            "slug"        => Str::slug("Ps. Jerry Zimba"),
            "ica_pastor"  => 0,
            "biography"   => "This is a biography"
        ]);
        $author->save();
    }
}
