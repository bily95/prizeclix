<x-table :th="['#', 'Level place', 'Rewards', '']">
    @php $id = 1;  @endphp
    @forelse($levels as $level)
        <tr>
            <td>
                {{ $id++ }}
            </td>
            <td>
                {{ $level->type }}
            </td>
            <td>
                {{ $level->reward }}
            </td>

            <td data-label="@lang('Action')">
                <a href="{{ route('moder.leaderboard.edit', $level->id) }}"
                    class="btn btn-info btn-sm">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('moder.leaderboard.delete', $level->id) }}"
                    class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td class="text-muted text-center" colspan="100%">{{ __('No Data Yet!') }}</td>
        </tr>
    @endforelse

</x-table>
    {{ $levels->links() }}
