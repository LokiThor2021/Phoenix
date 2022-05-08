<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int $priority_id
 * @property int|null $staff_id
 * @property int|null $user_read
 * @property int|null $staff_read
 * @property string $subject
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $closed_at
 * @property \Illuminate\Support\Carbon|null $reminded_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TicketAttachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Models\TicketCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\TicketPriority|null $priority
 * @property-read \App\Models\User|null $staff
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket stale()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket status($status)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePriorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereRemindedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStaffRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserRead($value)
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    use HasFactory;
    use Auditable;

    protected $casts = [
        'closed_at'   => 'datetime',
        'reminded_at' => 'datetime',
    ];

    public function scopeStatus($query, $status)
    {
        if ($status === 'all') {
            return $query;
        }

        if ($status === 'closed') {
            return $query->whereNotNull('closed_at');
        }

        if ($status === 'open') {
            return $query->whereNull('closed_at');
        }
    }

    public function scopeStale($query)
    {
        return $query->with(['comments' => function ($query) {
            $query->latest('id');
        }, 'comments.user'])
            ->has('comments')
            ->where('reminded_at', '<', \strtotime('+ 3 days'))
            ->orWhereNull('reminded_at');
    }

    public static function checkForStaleTickets(): void
    {
        $open_tickets = self::status('open')
            ->whereNotNull('staff_id')
            ->get();

        foreach ($open_tickets as $open_ticket) {
            Comment::checkForStale($open_ticket);
        }
    }

    /**
     * Belongs To A User (Created).
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A Staff User (Assigned).
     */
    public function staff(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Belongs To A Ticket Priority.
     */
    public function priority(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TicketPriority::class);
    }

    /**
     * Belongs To A Ticket Category.
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }

    /**
     * Has Many Ticket Attachments.
     */
    public function attachments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TicketAttachment::class);
    }

    /**
     * Has Many Comments.
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
