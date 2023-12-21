<x-table :th="['Rank', 'User', GENERAL_SETTING['cur_text'], 'Rewards']">
    @forelse($users as $index => $user)
    <tr>
        <td data-label="@lang('Rank')">#{{ (++$index) }}</td>
        <td data-label="@lang('User Name')">{{ $user->users->username }}</td>
        <td data-label="{{ GENERAL_SETTING['cur_text'] }}">
            {{ $user->total_earning }} {{ GENERAL_SETTING['cur_sym'] }}
        </td>
        <td data-label="Rewards">
            {{ isset($levels[$index-1]) ?  $levels[$index-1]->reward : 0}} {{ GENERAL_SETTING['cur_sym'] }}
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="text-center">@lang('Data not found')</td>
    </tr>
@endforelse
</x-table>

