<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
/**
 * Build the DataTable class.
 *
 * @param QueryBuilder<Slider> $query Results from query() method.
 */
public function dataTable(QueryBuilder $query): EloquentDataTable
{
return (new EloquentDataTable($query))
->addColumn('action', function($query){
    $edit = "<a href='" . route('Slider.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";

    $delete = "<button class='btn btn-danger delete-item ms-2' data-url='" . route('Slider.destroy', $query->id) . "'><i class='far fa-trash-alt'></i></button>";

    return $edit . ' ' . $delete;
})
->addColumn('status', function($query){
$ativo= '<i class="badge badge-success">Ativo</i>';
$cancelado= '<i class="badge badge-danger">Inativo</i>';
if($query->status == 1){
return $ativo;
}else{
return $cancelado;
}})
->addColumn('serial', function($query){
    return $query->serial;
})
->addColumn('banner', function($query){
return $img = "<img src='".asset($query->banner)."'style='width:100%; height:auto;'>";
})
->rawColumns(['banner', 'action', 'editar', 'status'])
->setRowId('id');

}

/**
 * Get the query source of dataTable.
 *
 * @return QueryBuilder<Slider>
 */
public function query(Slider $model): QueryBuilder
{
return $model->newQuery();
}

/**
 * Optional method if you want to use the html builder.
 */
public function html(): HtmlBuilder
{
return $this->builder()
//->setTableId('#brasilTraducaoVtbShope')
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
Button::make('reload')
]);
}

/**
 * Get the dataTable columns definition.
 */
public function getColumns(): array
{
return [
Column::make('id')
->width(30) // ID bem estreito
->addClass('text-center'),

Column::make('banner')
->title('Imagem')
->width(80), // imagem pequena

Column::make('title_one')
->title('Título 1')
->width(150), // título um pouco maior


Column::make('status')
->title('Status')
->width(30), // status pequeno

Column::make('serial')
->title('Serial')
->width(30), // serial pequeno

Column::computed('action')
->title('Ações')
->exportable(false)
->printable(false)
->width(80) // largura dos botões
->addClass('text-center'),
];
}

/**
 * Get the filename for export.
 */
protected function filename(): string
{
return 'Slider_' . date('YmdHis');
}
}
