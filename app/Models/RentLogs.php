<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentLogs extends Model
{
    use HasFactory;

    protected $table = "rent_logs";

    protected $fillable = [
        'user_id',
        'laptop_id',
        'renturn_date',
        'loan_date',
    ];


    /**
     * Get the user that owns the RentLogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function laptop()
    {
        return $this->belongsTo(Laptop::class, 'laptop_id', 'id');
    }



}
