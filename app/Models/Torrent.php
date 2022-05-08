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
use App\Helpers\MediaInfo;
use App\Helpers\StringHelper;
use App\Notifications\NewComment;
use App\Notifications\NewThank;
use App\Traits\Auditable;
use Hootlex\Moderation\Moderatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use voku\helper\AntiXSS;

/**
 * App\Models\Torrent
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string|null $mediainfo
 * @property string|null $bdinfo
 * @property string $info_hash
 * @property string $file_name
 * @property int $num_file
 * @property float $size
 * @property mixed|null $nfo
 * @property int $leechers
 * @property int $seeders
 * @property int $times_completed
 * @property int|null $category_id
 * @property string $announce
 * @property int $user_id
 * @property string $imdb
 * @property string $tvdb
 * @property string $tmdb
 * @property string $mal
 * @property string $igdb
 * @property int|null $season_number
 * @property int|null $episode_number
 * @property int $stream
 * @property int $free
 * @property int $doubleup
 * @property int $highspeed
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\FeaturedTorrent[] $featured
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $moderated_at
 * @property int|null $moderated_by
 * @property int $anon
 * @property int $sticky
 * @property int $sd
 * @property int $internal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $bumped_at
 * @property string|null $fl_until
 * @property string|null $du_until
 * @property string|null $release_year
 * @property int $type_id
 * @property int|null $resolution_id
 * @property int|null $distributor_id
 * @property int|null $region_id
 * @property int $personal_release
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\Distributor|null $distributor
 * @property-read int|null $featured_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TorrentFile[] $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\History[] $history
 * @property-read int|null $history_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Warning[] $hitrun
 * @property-read int|null $hitrun_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Keyword[] $keywords
 * @property-read int|null $keywords_count
 * @property-read \App\Models\User|null $moderated
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Peer[] $peers
 * @property-read int|null $peers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlaylistTorrent[] $playlists
 * @property-read int|null $playlists_count
 * @property-read \App\Models\Region|null $region
 * @property-read \App\Models\TorrentRequest|null $request
 * @property-read \App\Models\Resolution|null $resolution
 * @property-write mixed $media_info
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subtitle[] $subtitles
 * @property-read int|null $subtitles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Thank[] $thanks
 * @property-read int|null $thanks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonTransactions[] $tips
 * @property-read int|null $tips_count
 * @property-read \App\Models\Type|null $type
 * @property-read \App\Models\User|null $uploader
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TorrentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent query()
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereAnnounce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereAnon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereBdinfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereBumpedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereDistributorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereDoubleup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereDuUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereEpisodeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereFlUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereHighspeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereIgdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereImdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereInfoHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereInternal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereLeechers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereMal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereMediainfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereModeratedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereModeratedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereNfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereNumFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent wherePersonalRelease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereReleaseYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereResolutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereSd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereSeasonNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereSeeders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereSticky($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereStream($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereTimesCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereTmdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereTvdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Torrent withAnyStatus()
 * @mixin \Eloquent
 */
class Torrent extends Model
{
    use HasFactory;
    use Moderatable;
    use Auditable;

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
     * Belongs To A Uploader.
     */
    public function uploader(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // Not needed yet but may use this soon.

        return $this->belongsTo(User::class)->withDefault([
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
     * Belongs To A Distributor.
     */
    public function distributor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Distributor::class);
    }

    /**
     * Belongs To A Region.
     */
    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Belongs To A Playlist.
     */
    public function playlists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PlaylistTorrent::class);
    }

    /**
     * Has Many Genres.
     */
    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_torrent', 'torrent_id', 'genre_id', 'id', 'id');
    }

    /**
     * Torrent Has Been Moderated By.
     */
    public function moderated(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'moderated_by')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Has Many Keywords.
     */
    public function keywords(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Keyword::class);
    }

    /**
     * Has Many History.
     */
    public function history(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * Has Many Tips.
     */
    public function tips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BonTransactions::class, 'torrent_id', 'id')->where('name', '=', 'tip');
    }

    /**
     * Has Many Thank.
     */
    public function thanks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Thank::class);
    }

    /**
     * Has Many HitRuns.
     */
    public function hitrun(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Warning::class, 'torrent');
    }

    /**
     * Has Many Featured.
     */
    public function featured(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FeaturedTorrent::class);
    }

    /**
     * Has Many Files.
     */
    public function files(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TorrentFile::class);
    }

    /**
     * Has Many Comments.
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Has Many Peers.
     */
    public function peers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Peer::class);
    }

    /**
     * Has Many Subtitles.
     */
    public function subtitles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subtitle::class);
    }

    /**
     * Relationship To A Single Request.
     */
    public function request(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TorrentRequest::class, 'filled_hash', 'info_hash');
    }

    /**
     * Set The Torrents Description After Its Been Purified.
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
     * Set The Torrents MediaInfo After Its Been Purified.
     */
    public function setMediaInfoAttribute(?string $value): void
    {
        $this->attributes['mediainfo'] = $value;
    }

    /**
     * Formats The Output Of The Media Info Dump.
     */
    public function getMediaInfo(): array
    {
        return (new MediaInfo())->parse($this->mediaInfo);
    }

    /**
     * Returns The Size In Human Format.
     */
    public function getSize(): string
    {
        $bytes = $this->size;

        return StringHelper::formatBytes($bytes, 2);
    }

    /**
     * Bookmarks.
     */
    public function bookmarked(): bool
    {
        return (bool) Bookmark::where('user_id', '=', \auth()->user()->id)
            ->where('torrent_id', '=', $this->id)
            ->first();
    }

    /**
     * Notify Uploader When An Action Is Taken.
     */
    public function notifyUploader($type, $payload): bool
    {
        $user = User::with('notification')->findOrFail($this->user_id);
        if ($type == 'thank') {
            if ($user->acceptsNotification(\auth()->user(), $user, 'torrent', 'show_torrent_thank')) {
                $user->notify(new NewThank('torrent', $payload));

                return true;
            }

            return true;
        }

        if ($user->acceptsNotification(\auth()->user(), $user, 'torrent', 'show_torrent_comment')) {
            $user->notify(new NewComment('torrent', $payload));

            return true;
        }

        return true;
    }

    /**
     * Torrent Is Freeleech.
     */
    public function isFreeleech($user = null): bool
    {
        $pfree = $user && ($user->group->is_freeleech || PersonalFreeleech::where('user_id', '=', $user->id)->first());

        return $this->free || \config('other.freeleech') || $pfree;
    }
}
