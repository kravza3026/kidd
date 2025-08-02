<x-app-layout>
    @push('head')
{{--        <link rel="stylesheet" href="{{ asset('css/locations.css') }}">--}}
    @endpush

    <section class="container py-10">
        <div class="opacity-80 text-black text-5xl font-bold leading-10">
            {{ __('header.topline.locations') }}
        </div>


{{--        <br/>--}}
{{--        @foreach($locations->groupBy('address.region_id') as $group => $locations)--}}
{{--            @foreach($locations as $location)--}}
{{--                @if($loop->first)--}}
{{--                    {{ $location->address->region->name }}--}}
{{--                @endif--}}
{{--            {{ $location->name }}<br/>--}}
{{--            @endforeach--}}
{{--        @endforeach--}}
{{--        <hr class="my-4">--}}
{{--        @foreach($locations as $location)--}}
{{--            {{ $location->name }} / {{ $location->open_hours }} / {{ $location->address->street_name }} {{ $location->address->building }}<br/>--}}
{{--        @endforeach--}}

</section>
<div class="block w-full h-full min-h-[90vh] -mb-7" id="map"></div>

@push('scripts')
<script>
    (g=>{let h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new
    Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
        key: "{{ config('services.google_maps.key') }}",
        v: "weekly",
        language: "{{ app()->getLocale() }}",
        region: "MD", // Set the region to Moldova
        libraries: "marker", // Load the places library if needed
        // v: "weekly", // or "beta", "alpha", etc.
    });

    // Initialize Google Maps
    let map;

    async function initMap() {
        const { Map } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

        // Create a new map instance
        map = new Map(document.getElementById("map"), {
            center: { lat: 47.015095, lng: 28.854760 }, // Center the map on Chișinău
            mapId: "b4965ddab758c5fcdf626e9d",
            zoom: 13,
            disableDefaultUI: true,
        });

        // Add a custom control to the map
        const controlDiv = document.createElement("div");
        controlDiv.classList.add("custom-control");

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(controlDiv);

        const select = document.createElement('select');
        select.classList.add('bg-white', 'text-sm', 'font-light', 'mt-8', 'ml-12', 'px-3', 'py-2', 'focus:outline-hidden', 'rounded-sm', 'border-none');

        const defaultOption = document.createElement('option');
        defaultOption.value = 0;
        defaultOption.selected = true;
        defaultOption.textContent = 'All locations';
        select.appendChild(defaultOption);

            locations.forEach((marker, index) => {
                const option = document.createElement('option');
                option.value = marker.address;
                option.textContent = marker.address;

                select.appendChild(option);
            });

        controlDiv.appendChild(select);

        select.addEventListener('change', () => {
            const selectedType = select.value;

                    markerViews.forEach(({ view, type }) => {
                        if (selectedType === '0' || selectedType === type) {
                            view.content.style.display = '';
                        } else {
                            view.content.style.display = 'none';

                            const selectedLocation = locations[index];
                            map.setCenter(selectedLocation.position);
                            map.setZoom(15);
                        }
                    });
                });

        const markerViews = [];

        for (const store_location of locations) {
            const markerView = new google.maps.marker.AdvancedMarkerElement({
                map,
                content: buildContent(store_location),
                position: store_location.position,
            });

            markerView.addListener("click", () => {
                toggleHighlight(markerView, store_location);
            });

            markerViews.push({
                view: markerView,
                type: store_location.address
            });

            // Якщо потрібен доступ до content для фільтрації
            store_location.content = markerView.content;
        }


    }

    // Function to toggle highlight on marker click
    // This function adds or removes a highlight class and adjusts the z-index
    function toggleHighlight(markerView, store_location) {
        if (markerView.content.classList.contains("highlight")) {
            markerView.content.classList.remove("highlight");
            markerView.zIndex = null;
        } else {
            markerView.content.classList.add("highlight");
            markerView.zIndex = 1;
        }
    }

    // Function to build the content for each marker
    function buildContent(property) {
        const content = document.createElement("div");
        content.classList.add("marker-content");
        content.innerHTML = `
                  <div class="custom-marker group relative " >
        <div class="text-red-500 duration-700 group-hover:text-charcoal">
                 <svg width="112" height="117" viewBox="0 0 112 117"  xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#filter0_dddii_969_9083)">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M80 47.3681C80 49.0851 79.7069 50.7362 79.1661 52.278C76.7083 59.576 69.4458 65.2448 65.9386 67.6401C64.7604 68.4448 63.2396 68.4448 62.0614 67.6401C58.5542 65.2448 51.2917 59.5759 48.8339 52.2779C48.2931 50.7362 48 49.085 48 47.3681C48 38.8806 55.1634 32 64 32C72.8366 32 80 38.8806 80 47.3681ZM64 53.0764C67.6819 53.0764 70.6667 50.1276 70.6667 46.49C70.6667 42.8525 67.6819 39.9037 64 39.9037C60.3181 39.9037 57.3333 42.8525 57.3333 46.49C57.3333 50.1276 60.3181 53.0764 64 53.0764Z" fill="currentColor"/>
                </g>
                <defs>
                <filter id="filter0_dddii_969_9083" x="0" y="0" width="112" height="116.244" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                <feOffset dx="-8" dy="8"/>
                <feGaussianBlur stdDeviation="5"/>
                <feComposite in2="hardAlpha" operator="out"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_969_9083"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                <feOffset dx="-8" dy="8"/>
                <feGaussianBlur stdDeviation="20"/>
                <feComposite in2="hardAlpha" operator="out"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0.992157 0 0 0 0 0.2 0 0 0 0 0.2 0 0 0 0.2 0"/>
                <feBlend mode="normal" in2="effect1_dropShadow_969_9083" result="effect2_dropShadow_969_9083"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                <feOffset dx="8" dy="8"/>
                <feGaussianBlur stdDeviation="10"/>
                <feComposite in2="hardAlpha" operator="out"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.08 0"/>
                <feBlend mode="normal" in2="effect2_dropShadow_969_9083" result="effect3_dropShadow_969_9083"/>
                <feBlend mode="normal" in="SourceGraphic" in2="effect3_dropShadow_969_9083" result="shape"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                <feOffset dx="2" dy="-12"/>
                <feGaussianBlur stdDeviation="6"/>
                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                <feBlend mode="normal" in2="shape" result="effect4_innerShadow_969_9083"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                <feOffset dx="-2" dy="2"/>
                <feGaussianBlur stdDeviation="4"/>
                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.4 0"/>
                <feBlend mode="normal" in2="effect4_innerShadow_969_9083" result="effect5_innerShadow_969_9083"/>
                </filter>
                </defs>
                </svg>
        </div>
        <div class="absolute w-fit min-w-[100px] opacity-0 group-hover:opacity-100 duration-300 top-8 left-10/12  bg-white text-xs text-black p-3 rounded ">
            <p class="text-[18px]"> ${property.name} </p>
            <p class="text-[14px opacity-80 leading-[140%] text-nowrap py-1">${property.address}</p>
            <p class="text-[14px opacity-40 leading-[140%] text-nowrap">${property.description.hours}</p>
            <p class="text-[14px opacity-40 leading-[140%] text-nowrap">${property.description.dayOff}</p>
            <div class="absolute bg-white opacity-100 w-5 h-5 -translate-x-full rotate-45 top-1/6 -z-1" ></div>
            </div>
        </div>
        `;
        return content;
    }

    // TODO Store Locations implementation
    // City from database will have relation with HasMany relation with locations

    // Define the locations with their details
    const locations = [
            {
                content:{
                    style:{
                        display:''
                    },
                },
                name: 'Store #3',
                address: 'mun. Chișinău, str. Albisoara 3/1',
                description: {
                    hours:'Working hours — 09:00-20:00',
                    dayOff:'Sunday — day-off'
                },
                type: 'store',
                position: {
                    lat: 47.0144034,
                    lng: 28.8561766,
                }
            }, {
                content:{
                    style:{
                        display:''
                    },
                },
                name: 'Warehouse #1',
                address: 'mun. Chișinău, str. Muncești 5',
                description: {
                    hours:'Working hours — 09:00-20:00',
                    dayOff:'Sunday — day-off'
                },
                type: 'warehouse',
                position: {
                    lat: 47.0226291,
                    lng: 28.8670329,
                }
            }, {
                content:{
                    style:{
                        display:''
                    },
                },
                name: 'Store #7',
                address: 'or. Ungheni, bd. Decebal 12',
                description: {
                    hours:'Working hours — 09:00-20:00',
                    dayOff:'Sunday — day-off'
                },
                type: 'store',
                position: {
                    lat: 46.9918719,
                    lng: 28.8580194,
                }
            }
        ];

    initMap();

</script>
@endpush
</x-app-layout>
