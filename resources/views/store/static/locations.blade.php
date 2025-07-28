<x-app-layout>
    @push('head')
        <!-- // Here are the styles -->
{{--        <link rel="stylesheet" href="{{ asset('css/locations.css') }}">--}}
        <style>

        </style>
    @endpush

    <section class="container py-10">
        <div class="opacity-80 text-black text-5xl font-bold leading-10">
            {{ __('header.topline.locations') }}
        </div>
    </section>
        <div class="block w-full h-full min-h-[600px]" id="map"></div>

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
                controlDiv.innerHTML = `
                    <select class="bg-white text-sm font-light mt-8 ml-12 px-3 py-2 rounded-sm" onclick="console.log(this.value)">
                        <option value="0" selected>All locations</option>
                        <option value="1">mun. Chișinău</option>
                        <option value="2">mun. Bălți</option>
                        <option value="3">or. Ungheni</option>
                    </select>
                `;
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(controlDiv);

                // Add markers to the map
                for (const store_location of locations) {
                    const AdvancedMarkerElement = new google.maps.marker.AdvancedMarkerElement({
                        map,
                        content: buildContent(store_location),
                        position: store_location.position,
                        title: store_location.description,
                    });
                    AdvancedMarkerElement.addListener("click", () => {
                        toggleHighlight(AdvancedMarkerElement, store_location);
                    });
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
                content.classList.add("property");
                content.innerHTML = `
                    <div class="location">
                        <h4>${property.name}</h4>
                        <div class="details">
                            <div class="address">${property.address}</div>
                            <div class="description">${property.description}</div>
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
                    name: 'Store #3',
                    address: 'mun. Chișinău, str. Albisoara 3/1',
                    description: 'Working hours — 09:00-20:00, Sunday — day-off',
                    type: 'store',
                    position: {
                        lat: 47.0144034,
                        lng: 28.8561766,
                    }
                }, {
                    name: 'Warehouse #1',
                    address: 'mun. Chișinău, str. Muncești 5',
                    description: 'Working hours — 09:00-20:00, Sunday — day-off',
                    type: 'warehouse',
                    position: {
                        lat: 47.0226291,
                        lng: 28.8670329,
                    }
                }, {
                    name: 'Store #7',
                    address: 'or. Ungheni, bd. Decebal 12',
                    description: 'Working hours — 09:00-20:00, Sunday — day-off',
                    type: 'store',
                    position: {
                        lat: 46.9918719,
                        lng: 28.8580194,
                    }
                }];

            initMap();

        </script>
    @endpush
</x-app-layout>
