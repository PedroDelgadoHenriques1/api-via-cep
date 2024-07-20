<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function search($ceps)
    {
        $cepArray = explode(',', $ceps);

        $responses = [];
        
        foreach ($cepArray as $cep) {
            $cep = str_replace(['-', ' '], '', $cep);

            if (strlen($cep) != 8) {
                $responses[] = [
                    'cep' => $cep,
                    'error' => 'Formato de CEP inválido'
                ];
                continue;
            }

            $response = Http::withOptions(['verify' => false])
                            ->get("https://viacep.com.br/ws/{$cep}/json/");
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['erro']) && $data['erro']) {
                    $responses[] = [
                        'cep' => $cep,
                        'error' => 'CEP não encontrado'
                    ];
                } else {
                    $responses[] = [
                        'cep' => str_replace('-', '', $data['cep']),
                        'label' => "{$data['logradouro']}, {$data['localidade']}",
                        'logradouro' => $data['logradouro'],
                        'complemento' => $data['complemento'] ?? 'N/A',
                        'bairro' => $data['bairro'],
                        'localidade' => $data['localidade'],
                        'uf' => $data['uf'],
                        'ibge' => $data['ibge'],
                        'gia' => $data['gia'] ?? 'N/A',
                        'ddd' => $data['ddd'] ?? 'N/A',
                        'siafi' => $data['siafi'] ?? 'N/A'
                    ];
                }
            } else {
                $responses[] = [
                    'cep' => $cep,
                    'error' => 'Erro ao buscar o CEP'
                ];
            }
        }

        return response()->json($responses);
    }
}
