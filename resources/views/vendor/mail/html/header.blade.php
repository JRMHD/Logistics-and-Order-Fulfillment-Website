@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('assets/img/logo_black_text.png') }}" class="logo" alt="{{ config('app.name') }} Logo"
                    style="height: 48px; width: auto; margin-bottom: 12px; filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.1));">
            @else
                <img src="{{ asset('assets/img/logo_black_text.png') }}" class="logo" alt="{{ config('app.name') }} Logo"
                    style="height: 48px; width: auto; margin-bottom: 12px; filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.1));"><br>
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
