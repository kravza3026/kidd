<x-app-layout>
    <div class="max-w-2xl my-12 mx-auto border rounded-lg shadow-md p-6 text-sm font-sans bg-white">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-xl font-bold">REZERVARE</h1>
            <p class="text-gray-500">Cod rezervare: <span class="font-semibold">86U7JK</span></p>
            <p class="text-xs text-gray-400">Emis la: 02/01/2020 12:48:28</p>
            <p class="text-xs text-gray-400">Tipărit la: 02/01/2020 12:49:25</p>
        </div>

        <!-- Passenger Info -->
        <div class="mb-4">
            <p><span class="font-medium">Calator:</span> test Test</p>
            <p><span class="font-medium">Tel:</span> 0799999123</p>
        </div>

        <!-- Travel Details -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
            <div>
                <h2 class="font-semibold text-gray-700">Imbarcare:</h2>
                <p>Chisinau, Circ</p>
                <p>Str. Circului, 33</p>
            </div>
            <div>
                <h2 class="font-semibold text-gray-700">Plecare:</h2>
                <p>06:00</p>
                <p>duminica, 5 ian. 2020</p>
            </div>
            <div>
                <h2 class="font-semibold text-gray-700">Debarcare:</h2>
                <p>Milano, Cascina Gobba</p>
                <p>Sosire: 16:00, luni 6 ian. 2020</p>
            </div>
        </div>

        <!-- Pricing -->
        <div class="mb-4 border-t pt-4">
            <h3 class="font-semibold text-gray-800">Calatori</h3>
            <div class="flex justify-between text-sm">
                <p>Dus</p>
                <p>286,76 RON / 60 EUR</p>
            </div>
            <div class="flex justify-between text-sm">
                <p>Achitat:</p>
                <p class="text-red-600">0,00 RON / 0,00 EUR</p>
            </div>
            <div class="flex justify-between text-sm">
                <p>Rest de plata:</p>
                <p class="font-bold">286,76 RON / 60 EUR</p>
            </div>
            <p class="text-xs text-gray-400 mt-1">1 EUR = 4,7793 RON</p>
        </div>

        <!-- Contact -->
        <div class="mb-4 text-sm">
            <h3 class="font-semibold">Operator transport</h3>
            <p>Alverstur</p>
            <p>Tel: +40754022253; +393289041835; +37369259712</p>
            <p>Email: alverstur.rezervari@gmail.com</p>
        </div>

        <!-- QR & Footer -->
        <div class="text-xs text-gray-500">
            <p><strong>Traseu:</strong> Romania - Italia</p>
            <p><strong>Cod de verificare:</strong> Scanati acest cod cu telefonul pentru a verifica validitatea biletului.</p>
        </div>
    </div>

</x-app-layout>
