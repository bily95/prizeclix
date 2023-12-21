<form action="{{ route('moder.leaderboard.update', $level->id) }}" method="POST">
    <div class="card-body">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type">@lang('Type')</label>
                    <select class="form-control" name="type">
                        <option value="daily">@lang('Daily')</option>
                        <option value="monthly" @if ($level->type == 'monthly') selected @endif>
                            @lang('Monthly')</option>
                    </select>
                </div>
                <br>
            </div>
            <div class="col-md-6">
                <x-bs::input type="number" name="reward" label="Level Rewards" placeholder="100,200,300...."
                    :value="$level->reward" />
                <br>
            </div>
        </div>

        <a href="{{ route('moder.leaderboard.index') }}" class="btn btn-dark"
            >cancel</a>
        <button type="submit" class="btn btn-primary"
            >Save changes</button>
    </div>
</form>