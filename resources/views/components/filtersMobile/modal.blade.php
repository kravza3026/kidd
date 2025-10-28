
<div id="modalSlotContainer">
    @if($slot->isEmpty())
        <x-filtersMobile.all-filters />
    @else
        {{ $slot }}
    @endif

</div>



