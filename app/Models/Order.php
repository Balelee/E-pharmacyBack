<?php

namespace App\Models;

use App\Models\Pharmacy;
use App\Models\BaseModel;
use App\Models\OrderDetail;
use App\Models\OrderPharmacy;
use App\Models\Enums\OrderStatus;
use App\Models\Enums\PayementType;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperOrder
 */
class Order extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pharmacy_id',
        'priceTotal',
        'orderStatus',
        'adresLivraison',
        'modePayement',
    ];

    protected $casts = [
        'priceTotal' => 'double',
        'orderStatus' => OrderStatus::class,
        'modePayement' => PayementType::class,
    ];

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderPharmacies()
{
    return $this->hasMany(OrderPharmacy::class);
}


/*
Cette méthode permet d’accéder facilement aux pharmacies auxquelles une commande a été envoyée,
tout en gardant le statut de chaque tentative grâce à la colonne status dans la table pivot.
*/
public function pharmacies()
{
    return $this->belongsToMany(Pharmacy::class, 'order_pharmacy')
                ->withPivot('status')
                ->withTimestamps();
}
}
