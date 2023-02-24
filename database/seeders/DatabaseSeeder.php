<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        # seed em unidades 
        ############################################### roda primeiro isso aqui
        \App\Models\Unidade::factory()->create([
            'descricao' => 'Escritório Central',
        ]);
        \App\Models\Unidade::factory()->create([
            'descricao' => 'Guarujá',
        ]);
        \App\Models\Unidade::factory()->create([
            'descricao' => 'Itajaí',
        ]);
        \App\Models\Unidade::factory()->create([
            'descricao' => 'Suape',
        ]);

        # seed em usuários
        \App\Models\User::factory(1)->create();

        #seed em temas
        \App\Models\Tema::factory(900)->create();

        #seed de participantes
        \App\Models\Participante::factory(1000)->create();
        
        #seed de eventos
        \App\Models\Evento::factory(0)->create();        

    }
}