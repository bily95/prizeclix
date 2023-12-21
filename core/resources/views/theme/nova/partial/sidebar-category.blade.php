<li><a class="slide-item" href="{{ route('user.offer-network.index') }}">
    @lang('All Offers')
    ({{ array_sum(array_column($categories, 'count')) }})
</a>
</li>
@foreach ($categories as $cate)
    <li><a class="slide-item" href="{{ route('user.offer-network.browse', [$cate['id'], $cate['name']]) }}">
            {{ @$cate['name'] }}
            ({{ @$cate['count'] }})
        </a>
    </li>
@endforeach
