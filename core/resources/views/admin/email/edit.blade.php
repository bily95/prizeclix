@section('title', 'Manage Email template')
<div class="container">
    <div class="row">
        <div class="col-md-6 order-sm-2 order-md-1">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-responsive-sm">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th>@lang('Short Code')</th>
                                    <th>@lang('Description')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($template['shortcodes'] as $shortcode => $key)
                                    <tr>
                                        <th data-label="@lang('Short Code')">@php echo "{{ ". $shortcode ." }}"  @endphp</th>
                                        <td data-label="@lang('Description')">{{ __($key) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-muted text-center">{{ __('No Shortcodes!') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--card end -->
        </div>

        <div class="col-md-6 order-md-1 order-sm-2">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5>{{ __($template['name']) }}</h5>
                </div>
                <form action="" wire:submit.prevent="update" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            @if($template['name'] != 'Master')
                            <div class="form-group col-md-8">
                                <label class="font-weight-bold">@lang('Subject') <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" required
                                    placeholder="@lang('Email subject')" name="subject" value="{{ $template['subj'] }}" />
                            </div>
                            <div class="form-group col-md-4" wire:ignore>
                                <label class="font-weight-bold">@lang('Status') <span
                                        class="text-danger">*</span></label>
                                <input id="mail" type="checkbox" wire:model="template.email_status"
                                    data-value="{{ $template['email_status'] }}" />
                                Enable Sending
                            </div>
                            @endif
                            <div class="form-group col-md-12" wire:ignore>
                                <label class="font-weight-bold">@lang('Message')
                                    <span class="text-danger">*</span></label>
                                <textarea name="email_body" wire:model="template.email_body"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-primary mr-2">@lang('Submit')</button>
                        <button class="btn btn-warning btn-block" type="submit"
                            wire:click.prevent="cancelEdit()">Cancel </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<x-text-editor livewire="true" />
<x-js-notify livewire="true" />
<x-bootstrap-toggle livewire="true" />
