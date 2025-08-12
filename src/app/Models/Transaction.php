<?php

namespace App\Models;

use App\Providers\Model;

class Transaction extends Model
{
    protected string $table = 'transactions';
    protected array $fillable = ['date', 'check', 'description', 'amount'];
}
