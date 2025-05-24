<a class="btn btn-primary">
    <span class="fa fa-plus"></span>
    Usuário
</a>


<section class="bs-example widget-shadow p-15" id="listar">
       
</section>

<script type="text/javascript">
    $(document).ready( ()=> {
        const table = new DataTable("#tabela", {
             language: {
                url: "<?php echo asset("/js/pt-BR.js") ?>",
            }
        })
       
    })
</script>