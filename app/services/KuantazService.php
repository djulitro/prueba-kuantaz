<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KuantazService
{
    public function getBeneficios()
    {
        return $this->getData('8f75c4b5-ad90-49bb-bc52-f1fc0b4aad02');
    }

    public function getFiltros()
    {
        return $this->getData('b0ddc735-cfc9-410e-9365-137e04e33fcf');
    }

    public function getFichas()
    {
        return $this->getData('4654cafa-58d8-4846-9256-79841b29a687');
    }

    private function getData($url)
    {
        $fullUrl = env('KUANTAZ_API_URL') . $url;

        $response = Http::get($fullUrl);

        if ($response->failed()) {
            throw new \Exception('Error fetching data from the API: HTTP ' . $response->status());
        }

        $data = $response->json();

        if ($data === null) {
            throw new \Exception('Error decoding JSON response: ' . json_last_error_msg());
        }

        return collect($data['data']);
    }
}
