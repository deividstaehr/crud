<h2 class="title">
    Listagem de Produtos
</h2>
<br>
<!-- <p>
    <strong id="dFilter">Filtrar: </strong>
    <input type="text" name="entFiler" id="entFiler">
</p> -->
<table class="table table-striped table-inverse">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody id="tableProducts">
        <?php
            
            echo '<tr>';

            echo '</tr>';
        ?>
        <tr>
            <td scope="row">Produto 01</td>
            <td>R$ 3.99</td>
            <td>Descrição</td>
            <td>Categoria 01</td>
            <td class="links">
                <a class="btn btn-update btn-primary" href="" role="button">Alterar</a>
                <a class="btn btn-delete btn-danger" href="" role="button">Excluir</a>
            </td>
        </tr>
        <tr>
            <td scope="row">Produto 02</td>
            <td>R$ 24.50</td>
            <td>Descrição</td>
            <td>Categoria 01</td>
            <td class="links">
                <a class="btn btn-update btn-primary" href="" role="button">Alterar</a>
                <a class="btn btn-delete btn-danger" href="" role="button">Excluir</a>
            </td>
        </tr>
    </tbody>
</table>