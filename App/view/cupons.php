<section class="jumbotron">
        <div class="container">
          <h1 class="jumbotron-heading">Cupons</h1>
        </div>
</section>
<div class="container" id="form_cupons">
<form action="" method="post" enctype="multipart/form-data">
     <input type="hidden" id="id_form" value="0" />
     <div class="row">
        <div class="col-sm-1">
          <label>&nbsp;</label>
          <input type="text" class="form-control" id="cod" value="0" disabled>
        </div>
        <div class="col-sm-3">
          <label for="codigo" class="form-label">Código:</label>
          <input type="text" class="form-control" id="codigo">
        </div>
        <div class="col-sm-2">
          <label for="desconto" class="form-label">Preço (R$):</label>
          <input type="text" class="form-control" id="desconto" placeholder="R$ 0,00">
        </div>
        <div class="col-sm-2">
          <label for="valor_minimo" class="form-label">Valor Mínimo (R$):</label>
          <input type="text" class="form-control" id="valor_minimo" placeholder="R$ 0,00">
        </div>
        <div class="col-sm-2">
          <label for="validade" class="form-label">Validade</label>
          <input type="text" class="form-control" id="validade" placeholder="00/00/0000">
        </div>
        <div class="col-sm-2">
          <label class="form-label">&nbsp;</label>
            <ul class="d-flex justify-content-end list-unstyled gap-3 mt-0">
                <li class="spinner-border text-primary d-none js_loadSalvar" role="status">
                      <span class="sr-only"></span>
                </li>
                <li style="margin-right: 8px">
                    <button type="button" class="btn btn-primary" id="btnSaveCupom">Salvar</button>
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
        <th>Código</th>
        <th>Desconto</th>
        <th>Valor Mínimo</th>
        <th>Validade</th>
        <th>&nbsp;</th>
    </thead>
    <tbody id="listTableBody">
            <!-- listar produtos dinamicamente -->
    </tbody>
</table>
</div>
</div>

