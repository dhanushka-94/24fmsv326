<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $clients = [
            ['name' => 'Softlogic', 'logo' => '/images/clients/softlogic.png'],
            ['name' => 'DFCC Bank', 'logo' => '/images/clients/dfcc-bank.png'],
            ['name' => 'Union Assurance', 'logo' => '/images/clients/union-assurance.png'],
            ['name' => 'Seylan Bank', 'logo' => '/images/clients/seylan-bank.png'],
            ['name' => 'Dialog', 'logo' => '/images/clients/dialog.png'],
            ['name' => 'Sustagen', 'logo' => '/images/clients/sustagen.png'],
            ['name' => 'Airtel', 'logo' => '/images/clients/airtel.png'],
            ['name' => 'Daraz', 'logo' => '/images/clients/daraz.png'],
            ['name' => 'Sunquick', 'logo' => '/images/clients/sunquick.png'],
            ['name' => 'Unilever', 'logo' => '/images/clients/unilever.png'],
            ['name' => 'Uber Eats', 'logo' => '/images/clients/uber-eats.png'],
            ['name' => 'Nestlé', 'logo' => '/images/clients/nestle.png'],
            ['name' => 'Fonterra', 'logo' => '/images/clients/fonterra.png'],
            ['name' => 'Maliban', 'logo' => '/images/clients/maliban.png'],
            ['name' => 'Dilmah', 'logo' => '/images/clients/dilmah.png'],
            ['name' => 'Causeway Paints', 'logo' => '/images/clients/causeway-paints.png'],
            ['name' => 'Janashakthi', 'logo' => '/images/clients/janashakthi.png'],
            ['name' => 'Coca-Cola', 'logo' => '/images/clients/coca-cola.png'],
        ];

        $dialogOld = Client::where('name', 'Dialog Axiata')->first();
        if ($dialogOld) {
            $dialogOld->update(['name' => 'Dialog']);
        }

        $cbl = Client::where('name', 'Ceylon Biscuits')->first();
        if ($cbl && ! Client::where('name', 'Maliban')->exists()) {
            $cbl->update(['name' => 'Maliban']);
        }

        $keepNames = array_column($clients, 'name');

        foreach ($clients as $index => $data) {
            Client::updateOrCreate(
                ['name' => $data['name']],
                [
                    'logo' => $data['logo'],
                    'sort_order' => $index,
                    'is_published' => true,
                ]
            );
        }

        Client::whereNotIn('name', $keepNames)->update(['is_published' => false]);
    }

    public function down(): void
    {
        // Intentionally left blank — brand logo sync is not reversible.
    }
};
