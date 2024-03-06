<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     * Faker($this->faker->~~)でダミーの値を作成することができる
     * keyがカラム名、valueがダミーの値
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tel = str_replace('-', '', $this->faker->phoneNumber); // ハイフンを削除する
        $address = mb_substr($this->faker->address, 9); // 先頭の郵便番号7桁と半角スペースを除く
        
        return [
            'name' => $this->faker->name,
            'kana' => $this->faker->kanaName,
            'tel' => $tel,
            'email' => $this->faker->email,
            'postcode' => $this->faker->postcode,
            'address' => $address,
            'birthday' => $this->faker->dateTime,
            'gender' => $this->faker->numberBetween(0, 2),
            'memo' => $this->faker->realText(50),
        ];
    }
}
