<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-white">
                    {{ __("Iniciaste sesión!") }}
                </div>
                <div class="px-6 pb-2 text-white shadow-sm">
                    <a href="{{route('ticket.create')}}" class="py-3 px-5 bg-indigo-700 hover:bg-indigo-500 inline-flex rounded-md">Registrar Ticket</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Número del Ticket</th>
                    <th class="border px-4 py-2">Distribuidor</th>
                    <th class="border px-4 py-2">Vendedor</th>
                    <th class="border px-4 py-2">Nombre del Producto</th>
                    <th class="border px-4 py-2">Cantidad</th>
                    <th class="border px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr>
                    <td class="border px-4 py-2">{{ $ticket->ticket_number }}</td>
                    <td class="border px-4 py-2">{{ $ticket->distribuitor->name }}</td>
                    <td class="border px-4 py-2">{{ $ticket->vendor->name }}</td>
                    <td class="border px-4 py-2">{{ $ticket->product_name }}</td>
                    <td class="border px-4 py-2">{{ $ticket->quantity }}</td>
                    <td class="border px-4 py-2">{{ $ticket->total_amount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tickets->links() }}
    </div>
    <div class="pt-6 container mx-auto px-4">
        <p class="min-w-full bg-white">Este es el valor total de todos tus tickets: <span class="text-lg font-bold text-indigo-600">${{$granTotal}}</span></p>
    </div>
</x-app-layout>
