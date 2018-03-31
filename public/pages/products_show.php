<br>
<h2 class="title">
    Listagem de Produtos
</h2>

<hr>
<br>

<p class="text-right">
    <a href="<?=core\Path::find('pages_path')?>products/store">
        <i class="fas fa-plus"></i> <strong>Novo produto</strong>
    </a>
</p>

<table class="table table-striped table-inverse table-hover">
    <thead>
        <tr>
            <th class="text-left">#</th>
            <th class="text-left">Nome</th>
            <th class="text-left">Preço</th>
            <th class="text-left">Descrição</th>
            <th class="text-left">Categoria</th>
            <th class="text-left">Ações (editar, excluir)</th>
        </tr>
    </thead>
    <tbody id="tableProducts">

        <?php
            
            foreach ($products as $product) {
                $str  = "<tr><td class='text-left' scope='row'>".$product->id."</td>";
                $str .= "<td class='text-left'>".$product->nome."</td>";
                $str .= "<td class='text-left'>R$ ".$product->preco."</td>";
                $str .= "<td class='text-left'>".$product->descricao."</td>";
                $str .= "<td class='text-left'>".$product->cat_nome."</td>";
                $str .= "<td class='links'>";
                $str .= "<a class='btn-update' href='".core\Path::find('pages_path')."products/update/".$product->id;
                $str .= "' role='button'><i class='fas fa-2x fa-edit'></i></a>";
                $str .= "<a class='btn-delete' href='' role='button'><i class='fas fa-2x fa-trash-alt'></i></a></td></tr>";

                echo $str;
            }
        ?>
        
    </tbody>
</table>