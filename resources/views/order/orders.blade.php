<x-app-layout>
    <div class="section-orders">
        <h1>Pedidos </h1>
        <!--Message to the user informing them if the action they requested was completed-->
        <livewire:message />
        
        <!--Dynamic list of products -->
        <livewire:order-list/>
    </div>
</x-app-layout>