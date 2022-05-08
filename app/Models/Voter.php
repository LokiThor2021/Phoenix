<?php
/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D Community Edition is open-sourced software licensed under the GNU Affero General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D Community Edition
 *
 * @author     HDVinnie <hdinnovations@protonmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 */

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voter
 *
 * @property int $id
 * @property int $poll_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Poll $poll
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\VoterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter wherePollId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereUserId($value)
 * @mixin \Eloquent
 */
class Voter extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Belongs To A Poll.
     */
    public function poll(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }
}
