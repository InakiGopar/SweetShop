<x-app-layout>
    <div class="section-orders">
        <h1>Pedidos </h1>
        <!--Mensaje al usario que le informa si se completo la accion que solicito-->
        <livewire:message />
        
        <!--Lista de pedidos que cambia dinamicamente -->
        <livewire:order-list/>
    </div>
</x-app-layout>