<?php

namespace App\Http\Livewire;

use App\Models\Resident;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ResidentTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Resident>
     */
    public function datasource(): Builder
    {
        return Resident::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('nik')

           /** Example of custom column using a closure **/
            ->addColumn('nik_lower', fn (Resident $model) => strtolower(e($model->nik)))

            ->addColumn('name')
            ->addColumn('gender')
            ->addColumn('religion')
            ->addColumn('job')
            ->addColumn('pob')
            ->addColumn('dob_formatted', fn (Resident $model) => Carbon::parse($model->dob)->translatedFormat('d F Y'))
            ->addColumn('address')
            ->addColumn('created_at_formatted', fn (Resident $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
      * PowerGrid Columns.
      *
      * @return array<int, Column>
      */
    public function columns(): array
    {
        return [
            Column::make('NIK', 'nik')
                ->sortable()
                ->searchable(),

            Column::make('Nama', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Jenis Kelamin', 'gender')
                ->sortable()
                ->searchable()
                ->hidden(true, false),

            Column::make('Agama', 'religion')
                ->sortable()
                ->searchable()
                ->hidden(true, false),

            Column::make('Pekerjaan', 'job')
                ->sortable()
                ->searchable(),
            Column::make('Tempat Lahir', 'pob')
                ->sortable()
                ->searchable()
                ->hidden(true, false),

            Column::make('Tanggal Lahir', 'dob_formatted', 'dob')
                ->sortable(),

            Column::make('Alamat', 'address')
                ->sortable()
                ->searchable(),
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('nik')->operators(['contains']),
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('job')->operators(['contains']),
            Filter::inputText('gender')->operators(['contains']),
            Filter::inputText('religion')->operators(['contains']),
            Filter::inputText('pob')->operators(['contains']),
            Filter::datepicker('dob'),
            Filter::inputText('address')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Resident Actions Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
       return [
           Button::make('create-surat', 'Buat Surat')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->openModal('create-surat-modal', function (Resident $resident) {
                   return ['resident' => $resident->id];
               })

//           Button::make('destroy', 'Delete')
//               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
//               ->route('resident.destroy', function(\App\Models\Resident $model) {
//                    return $model->id;
//               })
//               ->method('delete')
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Actions Buttons.
    |
    */

    /**
     * PowerGrid Resident Actions Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($resident) => $resident->id === 1)
                ->hide(),
        ];
    }
    */
}
