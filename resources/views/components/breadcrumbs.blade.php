<nav {{ $attributes }}">
    <ul class="flex space-x-2 text-slate-500 font-medium">
        <li>
            <a href="/">Home</a>
        </li>
        @foreach ($links as $label => $v)
            <li>-></li>
            <li><a href="{{ $v }}">{{$label}}</a></li>
        @endforeach
    </ul>
</nav>