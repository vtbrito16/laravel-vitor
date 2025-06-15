<?php

namespace App\DataTables;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoriaDataTable extends DataTable
{
/**
 * Build the DataTable class.
 *
 * @param QueryBuilder<Categoria> $query Results from query() method.
 */
public function dataTable(QueryBuilder $query): EloquentDataTable
{
return (new EloquentDataTable($query))
->addColumn('icone', function ($query) {
return '<i class="' . e($query->icone) . '"></i>';
})
->addColumn('status', function ($query) {
return $query->status
? '<span class="badge badge-success">Ativo</span>'
: '<span class="badge badge-danger">Cancelado</span>';
})
->addColumn('editar', function ($query) {
$editar = "<a href='" . route('categoria.edit', $query->id) . "' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a>";
$excluir = "<button class='btn btn-sm btn-danger delete-item' data-url='" . route('categoria.destroy', $query->id) . "'><i class='far fa-trash-alt'></i></button>";
return $editar .  $excluir;
})
->rawColumns(['icone', 'status', 'editar'])
->setRowId('id');
}

/**
 * Get the query source of dataTable.
 *
 * @return QueryBuilder<Categoria>
 */
public function query(Categoria $model): QueryBuilder
{
return $model->newQuery();
}

/**
 * Optional method if you want to use the html builder.
 */
public function html(): HtmlBuilder
{
return $this->builder()
->setTableId('categoria-table')
->columns($this->getColumns())
->minifiedAjax()
->orderBy(1)
->selectStyleSingle()
->language([
'url' => asset('backend/assets/traducao-datatable-brasil/pt-BR.json'),
])
->buttons([
Button::make('excel'),
Button::make('csv'),
Button::make('pdf'),
Button::make('print'),
Button::make('reset'),
Button::make('reload'),
]);
}

/**
 * Get the dataTable columns definition.
 */
public function getColumns(): array
{
return [
Column::make('id')
->width(20)
->addClass('text-center align-middle'),

Column::make('icone')
->title('Ícone')
->width(60)
->addClass('text-center align-middle icone-coluna'),

Column::make('nome')
->title('Nome')
->width(190)
->addClass('align-middle nome-coluna'),

Column::make('status')
->title('Status')
->width(60)
->addClass('text-center align-middle'),

Column::computed('editar')
->title('Ações')
->exportable(false)
->printable(false)
->width(60)
->addClass('text-center align-middle'),
];
}

/**
 * Get the filename for export.
 */
protected function filename(): string
{
return 'Categoria_' . date('YmdHis');
}
}
