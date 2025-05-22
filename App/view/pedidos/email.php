<table border="1">
    <thead>
        <th>Id</th>
        <th>Produto</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Subtotal</th>
    </thead>
    <tbody>
        <?php foreach ($list as $row) { ?>
         <tr>
             <td><?php echo $row['id']; ?></td>
             <td><?php echo $row['nome']; ?></td>
             <td>R$ <?php echo $row['preco']; ?></td>
             <td><?php echo $row['quantidade']; ?></td>
             <td>R$ <?php echo $row['subtotal']; ?></td>
         </tr>
        <?php } ?>
        <tr>
            <td colspan="2">#</td>
            <td colspan="2">Total:</td>
            <td colspan="1">R$ <?php echo $total; ?> - <?php echo $total_item; ?> iten(s)</td>
        </tr>
        <tr>
            <td colspan="2">#</td>
            <td colspan="2">Frete:</td>
            <td colspan="1"><?php echo $frete; ?></td>
        </tr>
        <tr>
            <td colspan="2">#</td>
            <td colspan="1">Cupom:</td>
            <td><?php echo $cupom; ?></td>
            <td>R$ <?php echo $desconto; ?> Desconto</td>
        </tr>
    </tbody>
</table>

<p>
    <?php echo sprintf('%s, %s - %s<br />%s - %s, %s', $rua, $numero, $bairro, $cidade, $uf, $cep); ?>
</p>
