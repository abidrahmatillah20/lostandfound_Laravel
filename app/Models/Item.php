<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'location',
        'lost_or_found',
        'date',
        'image',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'pending'  => 'badge-warning',
            'approved' => 'badge-success',
            'rejected' => 'badge-danger',
            'returned' => 'badge-info',
            default    => 'badge-secondary',
        };
    }

    public function getTypeBadgeClass(): string
    {
        return $this->lost_or_found === 'lost' ? 'badge-danger' : 'badge-primary';
    }
}
