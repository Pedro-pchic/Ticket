<body class="font-sans antialiased">
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- Lado izquierdo --}}
    <div class="hidden lg:flex relative overflow-hidden bg-slate-900">
        <img
            src="{{ asset('images/login-bg.png') }}"
            alt="UDEVIPO"
            class="absolute inset-0 w-full h-full object-cover opacity-45"
        >

        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>

        <div class="relative z-10 flex flex-col justify-end p-12 text-white">
            <h1 class="text-4xl font-bold">Mesa de Ayuda TI</h1>
            <p class="mt-3 text-lg text-white/90">
                Control y seguimiento de solicitudes del Departamento de Informática.
            </p>
        </div>
    </div>

    {{-- Lado derecho --}}
    <div class="relative z-20 flex items-center justify-center bg-white px-6 py-12">
        <div class="w-full max-w-md">
            <div class="flex justify-center mb-8">
                <x-application-logo class="h-24 w-auto" />
            </div>

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                {{ $slot }}
            </div>
        </div>
    </div>

</div>
</body>
