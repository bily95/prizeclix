<div>
    <div class="chat-container @if ($showChat) active @endif">
        @if ($showChat)
            <div class="chart-info position-absolute top-0">
                <div class="current-online">
                    <i class="fas fa-dot-circle info"></i> {{ showAmount($currentOnline, 0) }} online
                </div>
                <div class="support">
                    <a href="{{ route('user.ticket.open') }}">
                        <i class="fas fa-headset fa-2x me-5"></i>
                    </a>
                </div>
            </div>
            <div class="chat-messages" wire:boll>
                <div class="load-more text-center">
                    <div class="btn btn-sm btn-dark align-self-center p-0 px-2" wire:click="loadMore()">..</div>
                </div>
                @foreach ($chats as $message)
                    @if ($message->users)
                        <div class="chats-wrapper">
                            <div class="wrapper-top">
                                <div>
                                    <div class="chat-header">
                                        <div class="time">
                                            {{ diffForHumans($message->created_at) }}
                                        </div>
                                        <div class="user-image">
                                            <img src="{{ getUserImage($message->users) }}" alt="" />
                                        </div>
                                        <div class="username">
                                            <p class="user m-0 px-1 py-0">{{ ucfirst($message->users->username) }}
                                                @php
                                                    $level = \App\Models\User\UserProfile::level($message->user_id);
                                                    $color = \App\Models\UserLevelsColor::where('id')->first();
                                                @endphp
                                                <span class="badge" title="User Level"
                                                    style="background: {!! $color ? $color->color : '#cccc' !!}">{{ $level }}</span>
                                            </p>
                                            @if ($message->users->profile->user_id == 1)
                                                <p class="admin-chat info m-0 px-1 py-0">
                                                    Owner
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper-bottom">
                                <p>{{ $message->message }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="chart-form">
                @auth()
                    <form id="chat_form" wire:submit.prevent="sendMessage">
                        <input class="form-control" type="text" wire:model.defer="messageText"
                            placeholder="Say Something" />
                        <div class="animas-holder"></div>
                        <button type="submit" class="btn btn-info btn-dark">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                @else
                    <form id="chat_form" action="{{ route('user.login') }}">
                        <input class="form-control" type="text" wire:model.defer="messageText"
                            placeholder="Please Login" />
                    </form>
                @endauth
            </div>
        @endif
    </div>
</div>
