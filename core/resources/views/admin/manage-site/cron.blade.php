@extends('admin.layout.primary')
@section('title', __('Manage Cronjob'))
@section('panel')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                @lang('Manage Cronjob')
            </h6>
        </div>
        <div class="card-body p-3">
            @foreach ($crons as $key => $value)
                <div class="d-flex justify-content-between m-0 p-0">
                    <p class="p-0">{{ $key }}</p>
                    <p class="p-0" role="button" onclick="copyToClipboard(this)">curl -s {{ $value }}</p>
                </div>
            @endforeach

        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="search my-2">
                <form>
                    <div class="d-flex justify-content-center">
                        <input type="search" class="form-control" name="url" placeholder="search by url" />
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <x-table :th="['URL', 'status']" >
                @forelse ($cronjobs as $cron)
                    <tr>
                        <td>{{ $cron->url }}</td>
                        <td>{!! bolToText($cron->status, true, 'Fails', 'success') !!}</td>
                    </tr>
                @empty
                    <p>no records!</p>
                @endforelse
            </x-table>
            {{ $cronjobs->links() }}
        </div>
    </div>

@endsection
@push('script')
    <script>
        function copyToClipboard(element) {
            const textarea = document.createElement('textarea');
            textarea.value = element.innerText;

            document.body.appendChild(textarea);

            textarea.select();
            textarea.setSelectionRange(0, 99999);

            document.execCommand('copy');

            document.body.removeChild(textarea);

            element.style.backgroundColor = '#d4edda';

            setTimeout(() => {
                element.style.backgroundColor = '';
            }, 1000);
        }
    </script>
@endpush
