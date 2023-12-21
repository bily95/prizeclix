<x-table :th="['#', 'Type', 'Requires', 'Rewards', 'Action']">
    @php $id = 1;  @endphp
    @forelse($tasks as $task)
        <tr>
            <td>
                {{ $id++ }}
            </td>
            <td>
                {{ ucfirst($task->type) }}
            </td>
            <td>
                {{ $task->require }} {{ GENERAL_SETTING['cur_sym'] }}
                @if ($task->condition)
                    /{{ $task->condition }} Offers
                @endif
            </td>
            <td>
                {{ $task->reward }}
            </td>

            <td data-label="@lang('Action')">
                <a href="{{ route('moder.dailytasks.edit', $task->id) }}" class="btn btn-icon btn-3 px-2 py-1 btn-info">
                    <span class="btn-inner--icon"><i class="material-icons">edit</i></span>
                </a>
                <a href="{{ route('moder.dailytasks.delete', $task->id) }}" class="btn btn-icon btn-3 px-2 py-1 btn-danger">
                    <span class="btn-inner--icon"><i class="material-icons">delete</i></span>
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td class="text-muted text-center" colspan="100%">{{ __('No Data Yet!') }}</td>
        </tr>
    @endforelse
</x-table>
{{ $tasks->links() }}

