<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TicketAttachment
 *
 * @property int $id
 * @property int $user_id
 * @property int $ticket_id
 * @property string|null $file_name
 * @property string|null $file_size
 * @property string|null $file_extension
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read string $full_disk_path
 * @property-read \App\Models\Ticket|null $ticket
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment whereFileExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAttachment whereUserId($value)
 * @mixin \Eloquent
 */
class TicketAttachment extends Model
{
    use HasFactory;
    use Auditable;

    protected $appends = [
        'full_disk_path',
    ];

    public function getFullDiskPathAttribute(): string
    {
        return $this->disk_path.''.$this->file_name;
    }

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Belongs To A Ticket.
     */
    public function ticket(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
