<section class="jumbotron">
        <div class="container">
          <h1 class="jumbotron-heading">Finalizar Pedido</h1>
        </div>
</section>

<div class="container">
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
        <th>Id</th>
        <th>Produto</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Subtotal</th>
    </thead>
    <tbody id="listTableBody">
            <!-- listar produtos dinamicamente -->
    </tbody>
</table>
</div>
</div>
<?php if ($total_item) { ?>
            
<div class="container">
<form action="" method="post" enctype="multipart/form-data">
    
<div class="row">
    <div class="col-ms-12">
        <div id="cep-group">
          <label for="cep">CEP:</label>
          <input type="text" id="cep" maxlength="9" placeholder="00000-000">
          <button type="button" id="buscar-cep" class="btn btn-secondary">Buscar</button>
        </div>
    </div>
  </div>
<div style="width: 100%; float: left">

<div class="row mt-3">
    <div class="col-sm-4">
        <label class="form-label" for="rua">Logradouro:</label>
        <input class="form-control form-control-lg" type="text" id="rua" readonly disabled />
    </div>
    <div class="col-sm-1">
        <label class="form-label" for="numero">Numero:</label>
        <input class="form-control form-control-lg" type="text" id="numero" />
    </div>
    <div class="col-sm-3">
        <label class="form-label" for="bairro">Bairro:</label>
        <input class="form-control form-control-lg" type="text" id="bairro" readonly disabled />
    </div>
</div>
<div class="row mt-3">
    <div class="col-sm-4">
        <label class="form-label" for="cidade">Cidade:</label>
        <input class="form-control form-control-lg" type="text" id="cidade" readonly disabled />
    </div>
    <div class="col-sm-1">
        <label class="form-label" for="uf">UF:</label>
        <input class="form-control form-control-lg" type="text" id="uf" readonly disabled />
    </div>
</div>
</div>

<div class="row">
    <div class="col-ms-12 text-end mt-5">
       <button class="btn btn-primary js_bt_finalizar_pedido">Finalizar</button>
    </div>
</div>

</form>

</div>
<?php } ?>

