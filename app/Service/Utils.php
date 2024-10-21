<?php

declare(strict_types=1);

namespace App\Service;

use Yajra\DataTables\Facades\DataTables;

class Utils
{
    public static function getActionButtons($row, $editClass, $deleteClass, $editRoute, $deleteRoute, $datatableId, $displayEditButton = true, $displayDeleteButton = true)
    {
        $html = '';

        if ($displayEditButton) {
            $html .=  '
                <a href="javascript:void(0)"
                    data-toggle="tooltip"
                    data-id="'. $row->id .'"
                    data-original-title="Modifier"
                    class="edit btn btn-primary btn-sm '. $editClass .'"
                    onclick="openInModal(\''. $editRoute .'\')">
                    <i class="fas fa-edit"></i>
                </a>
            ';
        }

        if ($displayDeleteButton) {
            $html .=  '
                <a href="javascript:void(0)"
                    data-toggle="tooltip"
                    data-id="'. $row->id .'"
                    data-original-title="Supprimer"
                    class="btn btn-danger btn-sm '. $deleteClass .'"
                    onclick="fireDeleteAction(\''. $deleteRoute .'\', \''. $datatableId .'\')">
                    <i class="fas fa-trash-alt text-white"></i>
                </a>
            ';
        }


        return $html;
    }

    public static function getDataTableOf($query, $editClass, $deleteClass, $editRoute, $deleteRoute, $datatableId, $callable = null, $displayEditButton = true, $displayDeleteButton = true): mixed
    {
        $datatable = DataTables::of($query)->addIndexColumn();

        if ($callable) {
            $datatable = $callable($datatable);
        }

        return $datatable->addColumn(
            'actions',
            fn ($row) => static::getActionButtons(
                $row,
                $editClass,
                $deleteClass,
                route($editRoute, [$row->id]),
                route($deleteRoute, [$row->id]),
                $datatableId,
                $displayEditButton,
                $displayDeleteButton
            )
        )
        ->rawColumns(['actions', 'link'])
        ->make(true);
    }
}
