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
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use voku\helper\AntiXSS;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $topic_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $dislikes
 * @property-read int|null $dislikes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonTransactions[] $tips
 * @property-read int|null $tips_count
 * @property-read \App\Models\Topic|null $topic
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Belongs To A Topic.
     */
    public function topic(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Topic::class);
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

    /**
     * A Post Has Many Likes.
     */
    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Like::class)->where('like', '=', 1);
    }

    /**
     * A Post Has Many Dislikes.
     */
    public function dislikes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Like::class)->where('dislike', '=', 1);
    }

    /**
     * A Post Has Many Tips.
     */
    public function tips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BonTransactions::class);
    }

    /**
     * Set The Posts Content After Its Been Purified.
     */
    public function setContentAttribute(string $value): void
    {
        $this->attributes['content'] = \htmlspecialchars((new AntiXSS())->xss_clean($value), ENT_NOQUOTES);
    }

    /**
     * Parse Content And Return Valid HTML.
     */
    public function getContentHtml(): string
    {
        $bbcode = new Bbcode();

        return (new Linkify())->linky($bbcode->parse($this->content, true));
    }

    /**
     * Post Trimming.t.
     */
    public function getBrief(int $length = 100, bool $ellipses = true, bool $stripHtml = false): string
    {
        $input = $this->content;
        //strip tags, if desired
        if ($stripHtml) {
            $input = \strip_tags($input);
        }

        //no need to trim, already shorter than trim length
        if (\strlen((string) $input) <= $length) {
            return $input;
        }

        //find last space within length
        $lastSpace = \strrpos(\substr($input, 0, $length), ' ');
        $trimmedText = \substr($input, 0, $lastSpace);

        //add ellipses (...)
        if ($ellipses) {
            $trimmedText .= '...';
        }

        return $trimmedText;
    }

    /**
     * Get A Post From A ID.
     */
    public function getPostNumber(): string
    {
        return $this->topic->postNumberFromId($this->id);
    }

    /**
     * Get A Posts Page Number.
     */
    public function getPageNumber(): float
    {
        $result = ($this->getPostNumber() - 1) / 25 + 1;

        return \floor($result);
    }
}
