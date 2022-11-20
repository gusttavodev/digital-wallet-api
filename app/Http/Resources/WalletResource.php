<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id' => $this->id,
           'name' => $this->name,
           'total_amount' => round($this->totalAmount, 2),
           'format_total_amount' => 'R$ '.round($this->totalAmount, 2),
           'latest_transaction' => $this->transactions()->latest()->first(),
           'created_at' => $this->created_at,
           'updated_at' => $this->updated_at,
        ];
    }
}
