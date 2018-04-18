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
                $str .= "<form action='".core\Path::find('pages_path')."products/delete' method='post'>"
                        . "<input type='hidden' name='proId' value='".$product->id."'>"
                        . "<button type='submit' class='btn-delete'><i class='fas fa-2x fa-trash-alt'></i></button>"
                        . "</form></td></tr>";

                echo $str;
            }
        ?>
        
    </tbody>
</table>

<!-- Modal 

 role='button' data-toggle='modal' data-target='#confirm'

<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modelTitle">Excluir Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <br>
        Você realmente deseja excluir o produto <strong id="productNameModel"></strong>?
        <br><br>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" id="btn-confirm-delete" href="">Sim</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>-->