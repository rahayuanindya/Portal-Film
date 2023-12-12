<nav class="nav flex-column">
   @foreach ($list as $item)
        <a href="#" class="nav-link {{ $isActive($item['label']) ? 'active' : ''}}">
            {{ $item['label'] }}
        </a>
   @endforeach
</nav>