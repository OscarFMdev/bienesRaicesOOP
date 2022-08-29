<footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>

        <?php 
        
        //Podemos usar date(d-m-Y) para poner el día, el mes y el año
        //si ponemos "Y" es completo 2022 y si ponemos "y" (minúscula) es solo 22

        $time = date('Y')

        ?>


        <p class="copyright">Todos los derechos reservados <?php echo $time ?> &copy;</p>
    </footer>
    <script src="/build/js/bundle.min.js"></script>
</body>
</html>