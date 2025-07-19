<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white">
        <h3>
            Search Contacts
            <span class="htmx-indicator">
                Searching...
           </span>
        </h3>
        <input class="form-control" type="search"
               name="term" placeholder="Begin Typing To Search Users..."
               hx-get="/search"
               hx-trigger="input changed delay:500ms, search"
               hx-target="#search-results"
               hx-indicator=".htmx-indicator">

            <h3>Search Results</h3>
            <div id="search-results">
            </div>
    </div>
</x-app-layout>
