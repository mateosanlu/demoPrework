    </main>

    <footer class="footer mt-auto py-3">
        <div class="nav justify-content-center border-bottom pb-3 mb-3"></div>
        <p class="text-center text-muted">&copy; 2022 Mateo Sandoval Luna</p>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="exitModal" tabindex="-1" aria-labelledby="exitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exitModalLabel">Cerrar sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea cerrar sesión?
                </div>
                <div class="modal-footer">
                    <a href="<?php echo BASE_URL.'login/cerrar'; ?>" class="btn btn-primary">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
    
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo BASE_URL.'public/js/'; ?>jquery.min.js"></script>
    <script src="<?php echo BASE_URL.'public/js/'; ?>popper.min.js" ></script>
    <script src="<?php echo $_layoutParams['path_js']; ?>bootstrap.min.js"></script>


    
    <!-- Custom JS Files -->
    <?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
        <?php for($i=0; $i < count($_layoutParams['js']); $i++): ?>
        <script src="<?php echo $_layoutParams['js'][$i] ?>" type="text/javascript"></script>      
        <?php endfor; ?>
    <?php endif; ?>


</body>
</html>