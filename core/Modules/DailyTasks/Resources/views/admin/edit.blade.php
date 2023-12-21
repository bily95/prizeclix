<div class="card-body">
    <form action="{{ route('moder.dailytasks.update', $task->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Task Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $task->title }}" />
                </div>

                <div class="form-group">
                    <label for="type">@lang('Type')</label>
                    <select class="form-control" name="type">
                        <option value="earn">@lang('Earn')</option>
                        <option value="offer" @if ($task->type == 'offer') selected @endif>@lang('Offer')
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <x-bs::input type="number" name="reward" label="Task Rewards" value="{{ $task->reward }}" />
                <div class="require">
                    <x-bs::input type="number" name="require" value="{{ $task->require }}"
                        label="tasks Requires Earning coins" />
                </div>
                <div class="condition">
                    <x-bs::input type="string" name="condition" value="{{ $task->condition }}"
                        label="tasks Requires completed Offers" />
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('moder.dailytasks.index') }}" class="btn btn-dark">Cancel</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
