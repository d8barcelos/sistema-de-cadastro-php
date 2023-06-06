<div class="container-fluid mt-4 mb-4">
    <?php
    if(!file_exists(__DIR__.'/../paginas/'.$page.'.php')){
        $page = '404';
    }
    include(__DIR__.'/../paginas/'.$page.'.php');
    ?>
</div>