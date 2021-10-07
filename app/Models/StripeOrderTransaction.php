<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeOrderTransaction extends Model
{
    use HasFactory;

    public function setRefunded($refundId,$status)
    {
        return $this->update([
            'refund_id' => $refundId,
            'status' => $status,
        ]);
    }
}
