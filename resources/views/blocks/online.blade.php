<div class="col-md-10 col-sm-10 col-md-offset-1">
    <div class="clearfix visible-sm-block"></div>
    <div class="panel panel-chat shoutbox">
        <div class="panel-heading">
            <h4><i class="{{ config('other.font-awesome') }} fa-users"></i> {{ __('blocks.users-online') }}
                <span class="label label-default">{{ $users->count() }}</span>
            </h4>
        </div>

        <div class="panel-body">
            @foreach ($users as $user)
                @if ($user->hidden == 1 || !$user->isVisible($user, 'other', 'show_online'))
                    <span class="badge-user text-orange text-bold" style="margin-bottom: 10px;">
                        <i class="{{ config('other.font-awesome') }} fa-user-ninja"></i>
                        {{ strtoupper(__('common.hidden')) }}
                        @if (auth()->user()->group->is_modo)
                            <a href="{{ route('users.show', ['username' => $user->username]) }}">
                                {{ $user->username }}
                                @if ($user->warnings_count > 0)
                                    <i class="{{ config('other.font-awesome') }} fa-exclamation-circle text-orange"
                                       aria-hidden="true"
                                       data-toggle="tooltip" data-original-title="{{ __('common.active-warning') }}"></i>
                                @endif
                            </a>
                        @endif
                    </span>
                @else
                    <a href="{{ route('users.show', ['username' => $user->username]) }}">
                        <span class="badge-user text-bold"
                              style="color:{{ $user->primaryRole->color }}; background-image:{{ $user->primaryRole->effect }}; margin-bottom: 10px;">
                            <i class="{{ $user->primaryRole->icon }}" data-toggle="tooltip"
                               data-original-title="{{ $user->primaryRole->name }}"></i>
                            {{ $user->username }}
                            @if ($user->warnings_count > 0)
                                <i class="{{ config('other.font-awesome') }} fa-exclamation-circle text-orange"
                                   aria-hidden="true"
                                   data-toggle="tooltip" data-original-title="{{ __('common.active-warning') }}"></i>
                            @endif
                        </span>
                    </a>
                @endif
            @endforeach
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <span class="badge-user text-orange text-bold">
                            <i class="{{ config('other.font-awesome') }} fa-eye-slash" aria-hidden="true"></i>
                            {{ strtoupper(__('common.hidden')) }}
                        </span>
                        @foreach ($roles as $role)
                            <span class="badge-user text-bold"
                                  style="color:{{ $role->color }}; background-image:{{ $role->effect }};">
                                <i class="{{ $role->icon }}" aria-hidden="true"></i> {{ $role->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
