<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Watchlist
 *
 * @property int $id
 * @property int $user_id
 * @property int $staff_id
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Watchlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Watchlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Watchlist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Watchlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Watchlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Watchlist whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Watchlist whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Watchlist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Watchlist whereUserId($value)
 * @mixin \Eloquent
 */
class Watchlist extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A Uploader.
     */
    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // Not needed yet but may use this soon.

        return $this->belongsTo(User::class, 'staff_id', 'id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }
}
