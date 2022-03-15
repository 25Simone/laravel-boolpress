<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Categories list
        $categories = [
            [
                "name"=> "thriller", 
                "description" => "Il thriller (dall'inglese to thrill, rabbrividire) è un genere di fiction che utilizza la suspense, la tensione e l'eccitazione come elementi principali della trama. È diffuso sia in letteratura, sia nel cinema o nella televisione."
            ],
            [
                "name"=> "comedy",
                "description" => "Il comedy è un genere di film che pone l'accento sull'umorismo. I film di questo genere solitamente hanno un lieto fine."
            ],
            [
                "name"=> "action",
                "description" => "l'action è una tipologia di cinema in cui la trama viene sostanzialmente raccontata per mezzo di un certo numero di scene d'azione, durante le quali uno o più protagonisti si trovano a dover affrontare una serie di sfide che richiedono coraggio e prodezza fisica."
            ],
            [
                "name"=> "fantasy",
                "description" => "Il fantasy è un genere caratterizzato da elementi, creature ed eventi fantastici, ambientato in un luogo spesso immaginario, talvolta non ben definito; narra spesso della lotta tra bene e male e generalmente, dopo numerose vicende, è il bene a trionfare."
            ],
            [
                "name"=> "adventure",
                "description" => "l'adventure è un genere che rispecchia un mondo eroico di battaglie e avventure. In questo genere tendono a dominare l'azione e i valori cavallereschi."
            ],
            [
                "name"=> "horror",
                "description" => "L'horror, è un genere di romanzi, film o altri tipi di opere che mira a suscitare nel lettore o spettatore sentimenti di spavento e orrore."
            ]
          ];

        foreach ($categories as $category) {
            // Instance a new line
            $newCategory = new Category();
            // Fill the line
            $newCategory->fill($category);
            // Save the line
            $newCategory->save();
        }
    }
}
