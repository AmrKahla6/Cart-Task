<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $available = rand(0,1);
    if($available == 0){
        $quantity = 0;
    }else{
        $quantity = rand(0,100);
    }

    return [
        'name'      => $faker->name,
        'image'     => rand(1,10).'.png',
        'category'  => $faker->sentence(6),
        'price'     => $faker->numberBetween(50,300),
        'available' => $available,
        'quantity'  => $quantity,
    ];
 });
