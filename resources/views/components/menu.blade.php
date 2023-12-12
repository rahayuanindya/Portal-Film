<nav class="nav flex-column">
   @foreach ($list as $item)
        <a href="{{ route($item['route']) }}" class="nav-link {{ $isActive($item['label']) ? 'active' : ''}}">
            <i class="icon-menu {{ $item['icon'] }}"></i>{{ $item['label'] }}
        </a>
   @endforeach
</nav>