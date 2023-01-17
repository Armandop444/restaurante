<?php
class View {
    function render($view){
        require "app/views/$view.php";
    }
}
?>