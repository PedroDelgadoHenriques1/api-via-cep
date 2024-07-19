<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function search($ceps)
    {
        // Explode os CEPs em um array
        $cepArray = explode(',', $ceps);

        $responses = [];
        
        foreach ($cepArray as $cep) {
            // Remove hífen e espaços
            $cep = str_replace(['-', ' '], '', $cep);

            if (strlen($cep) != 8) {
                // Adiciona um erro se o CEP não tiver 8 dígitos
                $responses[] = [
                    'cep' => $cep,
                    'error' => 'Formato de CEP inválido'
                ];
                continue;
            }

            // Configuração para desabilitar a verificação SSL (se necessário)
            $response = Http::withOptions(['verify' => false])
                            ->get("https://viacep.com.br/ws/{$cep}/json/");
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['erro']) && $data['erro']) {
                    // Tratar caso o CEP não seja encontrado
                    $responses[] = [
                        'cep' => $cep,
                        'error' => 'CEP não encontrado'
                    ];
                } else {
                    // Reorganiza os dados para garantir o formato correto
                    $responses[] = [
                        'cep' => str_replace('-', '', $data['cep']), // Remove hífen
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
                // Tratar caso a resposta não seja bem-sucedida
                $responses[] = [
                    'cep' => $cep,
                    'error' => 'Erro ao buscar o CEP'
                ];
            }
        }

        return response()->json($responses);
    }
}
