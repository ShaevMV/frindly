<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FriendlyTicket
 *
 * @property int $id
 * @property string $email
 * @property string $fio
 * @property string $seller
 * @property int $count
 * @property float $price
 *
 * @package App\Models
 */
class FriendlyTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'fio',
        'seller',
        'price',
    ];
}
