<h1 class="page-title">Produits</h1>
<br />
<table class="table table-hover table-sm">
    <thead>
        <tr>
            <th width="1%">ID</th>
            <th>Catégorie</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Actif</th>
            <th width="10%">Actions</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach ($params['products'] as $product) {
    echo '<tr>';
    echo '<td>'.$product->id.'</td>';
    echo '<td>'.$product->category_id.'</td>';
    echo '<td>'.$product->name.'</td>';
    echo '<td>'.$product->price.'</td>';
    echo '<td>';?>
    {% button link="catalog_products_show" type="success" size="sm" icon="eye-o" content="" %}<?php
    echo '</td>';
    echo '</tr>';
}
?>
    </tbody>
</table>