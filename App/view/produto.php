<section class="jumbotron">
        <div class="container">
          <h1 class="jumbotron-heading">Produto</h1>
        </div>
</section>
<div class="container" id="form_produto">

<form action="" method="post" enctype="multipart/form-data">
     <input type="hidden" id="id_form" value="0" />
     <div class="row">
        <div class="col-sm-1">
          <label for="nome" class="form-label">id</label>
          <input type="text" class="form-control" id="cod" value="0" disabled>
        </div>
        <div class="col-sm-4">
          <label for="nome" class="form-label">Name:</label>
          <input type="text" class="form-control" id="nome">
        </div>
        <div class="col-sm-2">
          <label for="preco" class="form-label">Preço (R$):</label>
          <input type="text" class="form-control" id="preco" placeholder="R$ 0,00">
        </div>
        <div class="col-sm-2">
          <label for="variacao" class="form-label">Variação:</label>
          <input type="text" class="form-control" id="variacao">
        </div>
        <div class="col-sm-1">
          <label for="quantidade" class="form-label">Quantidade</label>
          <input type="number" class="form-control" id="quantidade" placeholder="0">
        </div>
        <div class="col-sm-2">
          <label class="form-label">&nbsp;</label>
            <ul class="d-flex justify-content-end list-unstyled gap-3 mt-0">
                <li class="spinner-border text-primary d-none js_loadSalvar" role="status">
                      <span class="sr-only"></span>
                </li>
                <li style="margin-right: 8px">
                    <button type="button" class="btn btn-primary" id="btnSaveProduct">Salvar</button>
                </li>
            </ul>
        </div>
    </div>
</form>

</div>

<div class="container">
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
        <th>Id</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Variação</th>
        <th>Quantidade</th>
        <th>&nbsp;</th>
    </thead>
    <tbody id="listTableBody">
            <!-- listar produtos dinamicamente -->
    </tbody>
</table>
</div>
</div>


