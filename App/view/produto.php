<section class="jumbotron">
        <div class="container">
          <h1 class="jumbotron-heading">Produto</h1>
        </div>
</section>
<div class="container">

     <div class="row">
        <div class="col-sm-4">
          <label for="nome" class="form-label">Name:</label>
          <input type="text" class="form-control" id="nome">
        </div>
        <div class="col-sm-2">
          <label for="preco" class="form-label">Preço (R$):</label>
          <input type="text" class="form-control" id="preco" placeholder="R$ 0,00">
        </div>
        <div class="col-sm-1">
          <label for="variacao" class="form-label">Variação:</label>
          <input type="text" class="form-control" id="variacao" placeholder="0">
        </div>
        <div class="col-sm-1">
          <label for="estoque" class="form-label">Estoque</label>
          <input type="text" class="form-control" id="estoque" placeholder="0">
        </div>
        <div class="col-sm-4">
          <label class="form-label">&nbsp;</label>
            <ul class="d-flex justify-content-end list-unstyled gap-3 mt-0">
                <li class="spinner-border text-primary d-none" role="status">
                      <span class="sr-only"></span>
                </li>
                <li style="margin-right: 8px">
                    <button class="btn btn-primary">Salvar</button>
                </li>
            </ul>
        </div>
    </div>
  </div>
<div class="container">
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
        <th>Id</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Variação</th>
        <th>Estoque</th>
        <th>&nbsp;</th>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>camiseta 1</td>
        <td>9</td>
        <td>8</td>
        <td>7</td>
        <td class="text-end">

            <ul class="d-flex justify-content-end list-unstyled gap-3 mt-0">
                <li>
                    <div class="btn btn-success">Comprar</div>
                </li>
                <li>
                    <div class="btn btn-primary">Editar</div>
                </li>
            </ul>


        </td>
    </tr>
    </tbody>
</tbody>
</table>
</div>
</div>


