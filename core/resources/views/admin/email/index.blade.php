@section('title', 'Manage Email template')
<div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">@lang('Manage Email Templates')</h5>
            <x-table :th="['Name', 'Subject', 'Status', 'Action']">
                <tr>
                    <td data-label="@lang('Name')">Master Template</td>
                    <td data-label="@lang('Subject')">----</td>
                    <td data-label="@lang('Status')">
                        {!! bolToText(1, true, 'Disabled', 'Enabled') !!}
                        
                    </td>
                    <td data-label="@lang('Action')">
                        <a href="{{ route('moder.email.edit-template', 'master') }}" 
                            class="btn btn-info btn-sm  ml-1 editGatewayBtn" title="@lang('Edit')">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @forelse($templates as $template)
                    <tr>
                        <td data-label="@lang('Name')">{{ Str::limit($template->name, 15) }}</td>
                        <td data-label="@lang('Subject')">{{ Str::limit($template->subj, 15) }}</td>
                        <td data-label="@lang('Status')">
                            {!! bolToText($template->email_status, true, 'Disabled', 'Enabled') !!}
                            <button type="button" class="btn btn-default btn-sm"
                                wire:click="updateStatus({{ $template->id }}, {{ $template->email_status }})">
                                <i class="fas fa-exchange-alt text-dark"></i>
                            </button>
                        </td>
                        <td data-label="@lang('Action')">
                            <a href="{{ route('moder.email.edit-template', $template->id) }}" 
                                class="btn btn-info btn-sm  ml-1 editGatewayBtn" title="@lang('Edit')">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ __('No Data Yet!') }}</td>
                    </tr>
                @endforelse
            </x-table>
            {{ $templates->links() }}
        </div>
    </div>
</div>
<x-js-notify livewire="true" />