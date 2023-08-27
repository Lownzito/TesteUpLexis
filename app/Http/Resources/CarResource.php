<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nome_veiculo'  => $this->nome_veiculo,
            'link'          => $this->link,
            'ano'           => $this->ano,
            'combustivel'   => $this->combustivel,
            'portas'        => $this->portas,
            'quilometragem' => $this->quilometragem,
            'cambio'        => $this->cambio,
            'cor'           => $this->cor,
            'photo_url'     => $this->photo_url,
            'preco'         => $this->preco
        ];
    }
}
