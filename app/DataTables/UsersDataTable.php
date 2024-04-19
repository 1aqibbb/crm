<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($user) {
                $action = '<a class="btn btn-primary me-2" href="javascript:;" data-user-id="' . $user->id . '">
                                    <i class="fa fa-trash mr-2"></i>
                                    ' . trans('Update') . '
                                </a>';
                $action .= '<a class="btn btn-danger deleteUser .delete-btn" href="javascript:;" data-user-id="' . $user->id . '">
                                    <i class="fa fa-trash mr-2"></i>
                                    ' . trans('Delete') . '
                                </a>';

                return $action;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'name', 'email'])
            ->removeColumn('updated_at')
            ->removeColumn('created_at');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CompanyShare $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $user)
    {
        $user = User::where('id', '>', '0');
        return $user;
    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */

    public function html()
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()

            ->destroy(true)
            ->orderBy(1)
            ->responsive(true)
            ->serverSide(true)
            ->stateSave(false)

              ->searching(true);  // Enable searching

    }
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            '#' => ['data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'visible' => false],

            __('modules.job.startDate') => ['data' => 'email', 'searchable' => true],
            __('modules.job.jobTitle') => ['data' => 'name'],


            Column::computed('action', __('Action'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->addClass('text-center')
        ];
    }
    protected function filename(): string
    {
        // Construct the filename with a prefix 'employees_' and the current date and time
        return 'employees_' . date('YmdHis');
    }




}
