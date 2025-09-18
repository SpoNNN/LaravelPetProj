<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Events\DonateSuccesfull;

class Donations extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'donator_name',
        'message',
        'amount',
        'anonymous',
        'status',
        'payment_id',
        'payment_data',
        'email',
        'return_token'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsPending(): void
    {
        $this->update(['status' => 'pending']);
    }

    public function markAsWaitingForCapture(): void
    {
        $this->update(['status' => 'waiting_for_capture']);
    }

    public function markAsSucceeded(): void
    {
        if ($this->email != null)
            event(new DonateSuccesfull($this));
        $this->update(['status' => 'succeeded']);
    }

    public function markAsCanceled(): void
    {
        $this->update(['status' => 'canceled']);
        $this->save();
    }
}

