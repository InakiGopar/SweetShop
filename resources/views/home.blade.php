<x-app-layout>
    <div class="py-12 home-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <h2> hola {{ Auth::user()->name }}! </h2>
                <p>
                    Bienvenido a nuestra pagina, aqui encontraras todos nuestros productos y podras hacer
                    tus pedidos!!
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
