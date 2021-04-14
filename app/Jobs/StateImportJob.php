<?php

namespace App\Jobs;

use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class StateImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Batchable;

    public const DOMAIN = 'states';

    public string $url;

    public function __construct(public string $state)
    {
        if (!config('vaccine-notifier.api_url')) {
            throw new \Exception('Vaccine API base URL has not been set!');
        }

        $this->url = sprintf('%s%s', config('vaccine-notifier.api_url'), self::DOMAIN);
    }

    public function handle(): void
    {
        $start = microtime(true);
        $url = sprintf('%s/%s.json', $this->url, $this->state);

        try {
            $stateData = json_decode(file_get_contents($url));
        } catch (\Exception $e) {
            Log::critical(sprintf('Import for %s failed using URL %s', $this->state, $url));
            Log::critical($e->getMessage());
            throw $e;
        }
        Site::where('state', $this->state)->delete();
        $batch = [];
        $chunks = collect($stateData->features)->chunk(500);
        $now = now()->toDateTimeString();
        foreach($chunks as $chunk){
            foreach ($chunk as $location) {
                if (!$location->properties->postal_code) {
                    continue;
                }
                $appointments = $location->properties->appointments ?? [];
                $batch[] = [
                    'id' => $location->properties->id,
                    'lat' => $location->geometry->coordinates[1],
                    'long' => $location->geometry->coordinates[0],
                    'url' => $location->properties->url,
                    'name' => $location->properties->name,
                    'city' => $location->properties->city,
                    'state' => $location->properties->state,
                    'address' => $location->properties->address ?? 'N/A',
                    'provider' => $location->properties->provider,
                    'time_zone' => $location->properties->time_zone ?? 'America/New_York',
                    'postal_code' => $location->properties->postal_code,
                    'appointments' => $this->encode($location->properties->appointments),
                    'provider_brand' => $location->properties->provider_brand,
                    'carries_vaccine' => boolval($location->properties->carries_vaccine),
                    'appointment_types' =>  $this->encode($location->properties->appointment_types),
                    'provider_brand_id' => $location->properties->provider_brand_id,
                    'provider_brand_name' => $location->properties->provider_brand_name,
                    'provider_location_id' => $location->properties->provider_location_id,
                    'appointments_available' => boolval($location->properties->appointments_available),
                    'appointment_vaccine_types' =>  $this->encode($location->properties->appointment_vaccine_types),
                    'appointments_last_fetched' => $now,
                    'appointments_last_modified' => $now,
                    'appointments_available_all_doses' => boolval($location->properties->appointments_available_all_doses),
                    'appointments_available_2nd_dose_only' => boolval($location->properties->appointments_available_2nd_dose_only),
                    'moderna_available' => $this->hasVaccineType('moderna', $appointments),
                    'pfizer_available' => $this->hasVaccineType('pfizer', $appointments),
                    'jj_available' => $this->hasVaccineType('jj', $appointments),
                    'created_at' => $now,
                    'updated_at' => $now,

                ];
            }
            Site::insert($batch);
            $batch = [];
        }
        $end = microtime(true);
        $duration = $end - $start;
        Log::debug($duration);

    }

    private function encode($object): string
    {
        return ($object) ? json_encode($object) : "[]";
    }

    private function hasVaccineType(string $type, array $appointments): bool
    {
        return (bool) collect($appointments)
            ->filter(fn($appt) => property_exists($appt, 'vaccine_types'))
            ->filter(fn($appt) => in_array($type, $appt->vaccine_types))
            ->count();
    }


}
