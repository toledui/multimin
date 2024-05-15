<x-app-layout>
    <div class="pt-8 w-64 mx-auto">
        <form action="{{ route('ticket.store') }}" method="POST">
            @csrf
            <div class="flex flex-col">
                <label class="text-white" for="ticket_number">Número del Ticket:</label>
                <input type="text" name="ticket_number" id="ticket_number" required>
            </div>
            <div class="flex flex-col">
                <label class="text-white" for="distribuitor_id">Distribuidor:</label>
                <select name="distribuitor_id" id="distribuitor_id" required>
                    @foreach($distribuitors as $distribuitor)
                        <option value="{{ $distribuitor->id }}">{{ $distribuitor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label class="text-white" for="vendor_id">Vendedor:</label>
                <select name="vendor_id" id="vendor_id" required>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label class="text-white" for="product_name">Nombre del Producto:</label>
                <input type="text" name="product_name" id="product_name" required>
            </div>
            <div class="flex flex-col">
                <label class="text-white" for="quantity">Cantidad:</label>
                <input type="number" name="quantity" id="quantity" required>
            </div>
            <div class="flex flex-col">
                <label class="text-white" for="total_amount">Monto Total:</label>
                <input type="number" name="total_amount" id="total_amount" step="0.01" required>
            </div>
            <div class="pt-6 text-white">
                <button class="bg-indigo-700 px-6 py-2 hover:bg-indigo-500 rounded-md" type="submit">Registrar Ticket</button>
            </div>
        </form>
    </div>
</x-app-layout>