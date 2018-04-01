<br>
<h2 class="title">
    Alterar Produto
</h2>

<hr>
<br>

<form method="post" action="<?=core\Path::find('pages_path')?>products/update">
<div class="form-group row">
        <label for="proId" class="col-sm-2 col-form-label">Id</label>
        <div class="col-sm-10">
            <input type="text" class="form-control reset-width" id="proId" value="<?=$id?>" size="5" disabled required>
        </div>
    </div>

    <div class="form-group row">
        <label for="proName" class="col-sm-2 col-form-label">Nome</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="proName" name="proName" value="<?=$product->nome?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="proPreco" class="col-sm-2 col-form-label">Preço</label>
        <div class="col-sm-10 input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">R$</div>
            </div>
            <input type="number" class="form-control reset-width" id="proPreco" name="proPreco" value="<?=$product->preco?>" size="10" step="0.1" min="0.00" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="proDesc" class="col-sm-2 col-form-label">Descrição</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="proDesc" id="proDesc" cols="30" rows="5" required><?=$product->descricao?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <label for="proCat" class="col-sm-2 col-form-label">Categoria</label>
        <div class="col-sm-10">
            <select class="custom-select mr-sm-2" name="proCat" id="proCat" required>
                <?=$categories?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <input type="submit" class="btn btn-primary" value="Alterar" name="submit">
        </div>
    </div>
</form>