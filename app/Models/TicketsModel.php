<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketsModel extends Model
{
    use HasFactory;

    protected $table = 'tickets_models';
    protected $fillable = [
        'ticket_number',
        'id_driver',
        'passenger_name',
        'destination',
        'order_date',
        'departure_date',
        'departure_time',
        'seat_number',
        'status',
        'type_carrier',
        'plate_number',
        'price'
    ];

    public function driver()
    {
        return $this->belongsTo(DriversModel::class, 'id_driver');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     // Saat tiket dibuat
    //     static::created(function ($ticket) {
    //         if ($ticket->status === 'confirmed' && $ticket->driver) {
    //             $ticket->driver->update(['status' => 'Aktif']);
    //         }
    //     });

    //     // Saat tiket diupdate
    //     static::updated(function ($ticket) {
    //         if ($ticket->isDirty('status') && $ticket->driver) {
    //             if ($ticket->status === 'confirmed') {
    //                 $ticket->driver->update(['status' => 'Aktif']);
    //             } else {
    //                 $hasOtherConfirmed = self::where('id_driver', $ticket->id_driver)
    //                     ->where('status', 'confirmed')
    //                     ->where('id', '!=', $ticket->id)
    //                     ->exists();

    //                 if (!$hasOtherConfirmed) {
    //                     $ticket->driver->update(['status' => 'Tersedia']);
    //                 }
    //             }
    //         }
    //     });

    //     // Saat tiket dihapus
    //     static::deleted(function ($ticket) {
    //         if ($ticket->driver) {
    //             $hasOtherConfirmed = self::where('id_driver', $ticket->id_driver)
    //                 ->where('status', 'confirmed')
    //                 ->exists();

    //             if (!$hasOtherConfirmed) {
    //                 $ticket->driver->update(['status' => 'Tersedia']);
    //             }
    //         }
    //     });
    // }

    protected static function booted()
    {
        // Setelah tiket dibuat
        static::created(function ($ticket) {
            self::updateDriverStatus($ticket);
        });

        // Setelah tiket diupdate
        static::updated(function ($ticket) {
            self::updateDriverStatus($ticket);
        });

        // Setelah tiket dihapus
        static::deleted(function ($ticket) {
            $ticket->driver?->update(['status' => 'Tersedia']);
        });
    }

    protected static function updateDriverStatus($ticket)
    {
        $driver = $ticket->driver;

        if (!$driver) {
            return;
        }

        $hasConfirmed = $driver->tickets()->where('status', 'confirmed')->exists();
        $hasSuccess   = $driver->tickets()->where('status', 'success')->exists();

        if ($hasConfirmed) {
            $driver->update(['status' => 'Aktif']);
        } else {
            $driver->update(['status' => 'Tersedia']);
        }
    }


}
