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

use App\Helpers\Bbcode;
use App\Helpers\Linkify;
use App\Notifications\NewComment;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use voku\helper\AntiXSS;

/**
 * App\Models\TorrentRequest
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string|null $imdb
 * @property string|null $tvdb
 * @property string|null $tmdb
 * @property string|null $mal
 * @property string $igdb
 * @property string $description
 * @property int $user_id
 * @property float $bounty
 * @property int $votes
 * @property int|null $claimed
 * @property int $anon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $filled_by
 * @property string|null $filled_hash
 * @property \Illuminate\Support\Carbon|null $filled_when
 * @property int $filled_anon
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon|null $approved_when
 * @property int $type_id
 * @property int|null $resolution_id
 * @property-read \App\Models\User|null $FillUser
 * @property-read \App\Models\User|null $approveUser
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TorrentRequestBounty[] $requestBounty
 * @property-read int|null $request_bounty_count
 * @property-read \App\Models\Resolution|null $resolution
 * @property-read \App\Models\Torrent|null $torrent
 * @property-read \App\Models\Type|null $type
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TorrentRequestFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereAnon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereApprovedWhen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereBounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereClaimed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereFilledAnon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereFilledBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereFilledHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereFilledWhen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereIgdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereImdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereMal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereResolutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereTmdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereTvdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequest whereVotes($value)
 * @mixin \Eloquent
 */
class TorrentRequest extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * The Attributes That Should Be Mutated To Dates.
     *
     * @var array
     */
    protected $casts = [
        'filled_when'   => 'datetime',
        'approved_when' => 'datetime',
    ];

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'requests';

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

    /**
     * Belongs To A User.
     */
    public function approveUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A User.
     */
    public function FillUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'filled_by')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A Category.
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Belongs To A Type.
     */
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Belongs To A Resolution.
     */
    public function resolution(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Resolution::class);
    }

    /**
     * Belongs To A Torrent.
     */
    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class, 'filled_hash', 'info_hash');
    }

    /**
     * Has Many Comments.
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'requests_id', 'id');
    }

    /**
     * Has Many BON Bounties.
     */
    public function requestBounty(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TorrentRequestBounty::class, 'requests_id', 'id');
    }

    /**
     * Set The Requests Description After Its Been Purified.
     */
    public function setDescriptionAttribute(string $value): void
    {
        $this->attributes['description'] = \htmlspecialchars((new AntiXSS())->xss_clean($value), ENT_NOQUOTES);
    }

    /**
     * Parse Description And Return Valid HTML.
     */
    public function getDescriptionHtml(): string
    {
        $bbcode = new Bbcode();

        return (new Linkify())->linky($bbcode->parse($this->description, true));
    }

    /**
     * Notify Requester When A New Action Is Taken.
     */
    public function notifyRequester($type, $payload): bool
    {
        $user = User::with('notification')->findOrFail($this->user_id);
        if ($user->acceptsNotification(\auth()->user(), $user, 'request', 'show_request_comment')) {
            $user->notify(new NewComment('request', $payload));

            return true;
        }

        return true;
    }
}
