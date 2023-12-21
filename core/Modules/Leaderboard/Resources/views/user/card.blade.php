<div class="row justify-content-center align-items-center">
    @foreach ($levels as $index => $level)
        <div
            class="col-md-3
        @if ($index == 0) order-sm-0 order-md-1
        @elseif($index == 1)
         order-sm-1 order-md-0 mt-5
        @else
        order-{{ $index }} mt-5 @endif
        ">
            <div class="card">
                <div class="card-body text-center">
                    <div class="user-panel panel">
                        <div class="panel-body text-center" style="border: none">
                            <img src="{{ asset('/asset/static/app/imgs/ranks/crown.png') }}" height="50px" width="50px" class="d-block" />
                            @if (isset($topUsers[$index]))
                                <img src="{{ getUserImage($topUsers[$index]->users) }}" 
                                height="50px"
                                width="50px"
                                class="round-circle" />
                                <h5 class="">
                                    {{ $topUsers[$index]->users->username }}
                                    <span class="d-block text-info">
                                        {{ $topUsers[$index]->total_earning }}
                                        {{ GENERAL_SETTING['cur_sym'] }}
                                    </span>
                                </h5>
                            @else
                            <img src="{{ asset('/asset/static/app/imgs/loading.gif') }}" 
                                height="50px"
                                width="50px"
                                class="round-circle bg-dark" />
                            <h5 class="">
                                Be The Rank
                                <span class="d-block text-info">
                                    {{ $level->reward }}
                                    {{ GENERAL_SETTING['cur_sym'] }}
                                </span>
                            </h5>
                            @endif
                        </div>
                    </div>
                    
                    <div class="panel">
                        <div class="panel-body text-center">
                            <img src=@if ($index == 1) "{{ asset('/asset/static/app/imgs/ranks/two.png') }}"
                            @elseif($index == 0)
                            "{{ asset('/asset/static/app/imgs/ranks/one.png') }}"
                            @else 
                            "{{ asset('/asset/static/app/imgs/ranks/three.png') }}" @endif
                                height="50px" width="50px" />
                            <h5 class="card-text">Reward: {{ $level->reward }}
                                {{ GENERAL_SETTING['cur_sym'] }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
