<?php
if (session_start()) {
} else {
    session_start();
}

if ($_SESSION['idTUsuario'] != 1) {
} else {
    header('Location: ../user/panel.php');
}
$pagina = 0;
$pagina_admin = 2;
$video = 0;
$nombre_pagina = "Politicas de Privacidad";
require_once '../includes/header.php';
?>

<div class="politicas">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">
            <h1 style="text-align: center;">POLÍTICA DE REEMBOLSO Y GARANTÍA</h1>

            <p>En el caso de productos que sean mercancías irrevocables no-tangibles, no realizamos reembolsos después de que se envíe el producto, usted tiene la responsabilidad de entender antes de comprarlo. Le pedimos que lea cuidadosamente antes de comprarlo. Hacemos solamente excepciones con esta regla cuando la descripción no se ajusta al producto. Hay algunos productos que pudieran tener garantía y posibilidad de reembolso pero este será especificado al comprar el producto.
                En tales casos la garantía solo cubrirá fallas de fábrica y sólo se hará efectiva cuando el producto se
                haya usado correctamente. La garantía no cubre averías o daños ocasionados por uso indebido. Los términos de la garantía están asociados a fallas de
                fabricación y funcionamiento en condiciones normales de los productos y sólo se harán efectivos estos términos si el equipo ha sido usado correctamente. Esto incluye:</p>

                <ul>
                    <li> De acuerdo a las especificaciones técnicas indicadas para cada producto.</li>
                    <li> En condiciones ambientales acorde con las especificaciones indicadas por el fabricante.</li>
                    <li> En uso específico para la función con que fue diseñado de fábrica.</li>
                    <li> En condiciones de operación eléctricas acorde con las especificaciones y tolerancias indicadas.</li>
                </ul>

        </div>
    </div>
</div>

<?php require_once '../includes/footer.php' ?>