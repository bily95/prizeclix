@extends('admin.layout.primary')
@section('title', __('Completed tasks '))
@section('panel')
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start" style="margin-top:5px;">@lang('Completed Tasks')</h4>
                <button type="button" data-bs-toggle="modal" data-bs-target="#storeLevel"
                    class="btn btn-sm btn-dark float-end">
                    <i class="fas fa-plus"></i> @lang('New task')
                </button>
            </div>
            <div class="card-body">
                <div class="table-header">
                    <form action="{{ route('moder.dailytasks.history') }}" method="get" class="history-search">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-center">
                                    <input type="search" name="search" class="form-control"
                                        value="{{ request('search') }}"
                                        placeholder="Search for user by: username, firstname, lastname, email, as well task title" />
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="for-group" onchange="$('.history-search').submit()">
                                    <select class="form-control" name="type">
                                        <option value="all" @if (request('type', 'all') === 'all') selected @endif>Show All
                                        </option>
                                        <option value="offer" @if (request('type') === 'offer') selected @endif>Offers Only
                                        </option>
                                        <option value="earn" @if (request('type') === 'earn') selected @endif>Earns Only
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <x-table :th="['#', 'Username', 'Type', 'Rewards', 'Date']">
                    @php $currentPage = $tasks->currentPage(); @endphp
                    @forelse($tasks as $index => $task)
                        <tr>
                            <td>
                                {{ $currentPage + $index++ }}
                            </td>
                            <td>
                                {{ $task->user->username }}
                            </td>
                            <td>
                                {{ $task->type }}
                            </td>
                            <td>
                                {{ $task->reward }}
                            </td>

                            <td data-label="@lang('Date')">
                                {{ showDateTime($task->created_at) }}
                                <br>
                                {{ diffForHumans($task->created_at) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ __('No Data Yet!') }}</td>
                        </tr>
                    @endforelse
                </x-table>
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
@endsection
