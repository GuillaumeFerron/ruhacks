<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Medication::class, function (Faker $faker) {
    $amount = $faker->numberBetween(1, 20);
    $formatter = new NumberFormatter("en_US", NumberFormatter::SPELLOUT);

    return [
        'name' => $faker->randomElement(medicinesNames()),
        'user_id' => 1,
        'quantity_amount' => $amount,
        'quantity_type' => $amount > 1 ? Str::plural($faker->randomElement([
            'tablet',
            'pill',
            'capsule',
        ])) : $faker->randomElement(['tablet', 'pill', 'capsule',]),
        'time' => $faker->time('H:i:00'),
        'frequency' => $faker->randomElement([
            'every day',
            'every ' . $formatter->format($faker->numberBetween(1, 12)) . ' hours',
            'every ' . $faker->numberBetween(1, 12) . ' hours',
            'daily',
            'weekly'
        ]),
        'start_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+30 days'),
        'refillable' => $faker->randomElement([0, 1]),
        'qty' => $faker->numberBetween(1, 30)
    ];
});

function medicinesNames()
{
    return [
        'Robarinex',
        'Silomid',
        'Estratonin',
        'Alitrebisome',
        'Aldudizem',
        'Divifranil',
        'Estrafinil Reflitora',
        'Rapalozin Desostrel',
        'Icoxone Dyphysine',
        'Crimenda Travoporin',
        'Glucofetan',
        'Duradocin',
        'Alphanium',
        'Regonadryl',
        'Acripiride',
        'Acispan',
        'Zanacline Fexonavir',
        'Alphapur Pralifen',
        'Betatisol Serolinum',
        'Abiside Declonuvia',
        'Alosenazol',
        'Microvac',
        'Butacion',
        'Rhinosulin',
        'Romixane',
        'Floxunogen',
        'Aliracil Clarigine',
        'Adrenacane Albendamara',
        'Tiatoin Halcipril',
        'Beclofetan Infuzenil',
        'Lacofenide',
        'Adrenem',
        'Loradenu',
        'Triracin',
        'Pemitate',
        'Acamsonide',
        'Bacgel Ometriene',
        'Deciprine Retadazole',
        'Silvaracil Beneminphen',
        'Alemzolam Dactistral',
        'Caffeilog',
        'Abirarase',
        'Cetroloride',
        'Fibrirase',
        'Somazyme',
        'Bexbutrol',
        'Albutevax Cetrodipine',
        'Ultratadine Altoletra',
        'Symbiside Lorazenalin',
        'Roxanonide Apromentin',
        'Allefribrate'
    ];
}
