@extends('admin.layout.primary')
@section('title', __('Ads Zone'))
@section('panel')
    <div class="row">
        @isset($create)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Create New Ad')</h3>
                </div>
                <div class="card-body">
                    @isset($edit)
                        <form action="{{ route('moder.ads.update', $ads->id) }}" method="POST">
                            @method('put')
                            @csrf
                            <x-bs::input type="text" name="name" :placeholder="__('Ad Name')" :label="__('Ad Name')"
                                value="{{ $ads->name }}" />
                            <div class="form-group">
                                <label for="contents">@lang('Ad Code')</label>
                                <textarea name="contents" id="contents" rows="5" class="form-control">
                               {{ trim($ads->contents) }}
                           </textarea>
                            </div>
                            <div class="form-group">
                                <label for="size">@lang('Ad Size')</label>
                                <select name="size" id="size" class="form-control" style="box-shadow:none !important;">
                                    <option value="0">@lang('Select One')</option>
                                    <option value="728*90" @if ($ads->size == '728*90') selected="selected" @endif>728*90
                                    </option>
                                    <option value="250*250" @if ($ads->size == '250*250') selected="selected" @endif>250*250
                                    </option>

                                </select>
                            </div>
                            <x-bs::button type="submit" :label="__('Update')" />
                        </form>
                    @else
                        <form action="{{ route('moder.ads.store') }}" method="POST">
                            @csrf
                            <x-bs::input type="text" name="name" :placeholder="__('Ad Name')" :label="__('Ad Name')" />
                            <br>
                            <x-bs::textarea name="contents" :placeholder="__('Ad Code')" :label="__('Ad Code')" />
                            <br>
                            <x-bs::select name="size" :options="['728*90', '250*250']" :placeholder="__('Select One')" :label="__('Ad Size')" />
                            <br>
                            <x-bs::button type="submit" :label="__('Create')"
                                style="background:#067fda;border-color: #067fda;box-shadow:none;" />
                        </form>
                    @endisset
                </div>
            </div>
        @else
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title float-start">
                            @lang('Ads Zone') <i class="fas fa-question-circle" title="@lang('This ads will appear on the offerwall iframe')"></i>
                        </h5>
                        <a href="{{ route('moder.ads.create') }}" class="btn btn-primary float-end">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <x-table :th="['Name', 'Content', 'Size', 'Status', '']">
                            @forelse($ads as $item)
                                <tr>
                                    <td data-label="@lang('Title')">
                                        {{ $item->name }}
                                    </td>
                                    <td data-label="@lang('Content')" style="max-width: 250px;overflow:auto;" data-scrollbar>
                                        {!! $item->contents !!}
                                    </td>
                                    <td data-label="@lang('Size')">
                                        {{ $item->size }}
                                    </td>
                                    <td data-label="@lang('Status')">
                                        {!! bolToText($item->is_active, true, __('Inactive'), __('Active')) !!}
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <div class="d-flex">

                                            <a href="{{ route('moder.ads.edit', $item->id) }}" class="btn btn-info btn-sm me-1">
                                                <i class="fas fa-edit" title="Edit"></i>
                                            </a>
                                            <form action="{{ route('moder.ads.destroy', $item->id) }}" method="post">
                                                @method('delete') @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash" title="@lang('Delete')"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __('No ads yet') }}
                                    </td>
                                </tr>
                            @endforelse
                        </x-table>
                        {{ $ads->links() }}
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
<x-js-notify />
<x-select2 />
