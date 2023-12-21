@props([
    'th' => [],
])

<div class="table-responsive px-2">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                @foreach ($th as $item)
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ $item }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
