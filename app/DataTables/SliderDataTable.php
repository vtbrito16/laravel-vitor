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
$edit = "<a href='".route('Slider.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
$delete = "<a href='".route('Slider.destroy', $query->id)."' class='btn btn-danger ml-2'><i class='far fa-trash-alt'></i></a>";
return $edit . $delete;

})
->addColumn('banner', function($query){
return $img = "<img src='".asset($query->banner)."'style='width:100%; height:auto;'>";
})
->rawColumns(['banner', 'action'])
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

Column::computed('action')
->title('Ações')
->exportable(false)
->printable(false)
->width(70) // largura dos botões
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
