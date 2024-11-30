<footer class="footer-app">
    <div class="footer-left">

        <div class="brand">
            <div class="img-title-brand">
                <p class="title">YsiProbamos</p>
                <figure></figure>
            </div>
            <p>&#169;2024 ysyprobamos</p>
            <p>Creado por Iñaki Gopar</p>
        </div>

        <div class="social-media">
            <div class="instagram"></div>
            <div class="facebook"></div>
        </div>
    </div>

    <div class="footer-medium">

            <ul class="links">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('product.products')}}">Nuestros Productos</a></li>
                <li><a href="">Sobre Nosotros</a></li>
                <li><a href="{{ route('profile.edit') }} ">Mi Perfil</a></li>
                <li><a href="{{route('order.orders')}}">Mis Pedidos</a></li>
            </ul>
        
    </div>

    <div class="footer-order">
        <p>
            Elaboramos productos con materia prima de calidad, pensando cuidadosamente
            la combinación de sabores para brindarte la mejor experiencia gastronomica posible.
            No te quedes con las ganas de darte ese lujo que mereces.
        </p>
        <button class="btn btn-primary">
            <a href="{{route('order.create')}}">Hace Tu Pedido Ya!</a>
        </button>
    </div>

</footer>