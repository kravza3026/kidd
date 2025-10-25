@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'kidd.')
<img src="https://kidd.md/assets/images/logo.svg" class="logo" alt="kidd.md Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
