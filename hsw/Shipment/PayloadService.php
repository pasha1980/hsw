<?php


namespace Context\Shipment;


use Illuminate\Http\Request;

class PayloadService
{
    private const SHIP_CREATE_DATA_FIELDS = [
        'name',
        'imo',
        'residence',
        'residencePort',
        'photo'
    ];

    private const PORT_CREATE_DATA_FIELDS = [
        'name'
    ];

    private const BERTHING_CREATE_DATA_FIELDS = [
        "port",
        "pdf",
        "start",
        "end",
        "cargo",
        "const",
        "problems",
        "isLoad",
        "isShortage"
    ];

    private const BERTHING_UPDATE_DATA_FIELDS = [
        "pdf",
        "start",
        "end",
        "cargo",
        "const",
        "problems"
    ];

    private static function baseNormalization(Request $request, array $fields): array
    {
        $data = [];
        foreach ($fields as $field) {
            if ($request->input($field) !== null) {
                $data[$field] = $request->input($field);
            }
        }
        return $data;
    }

    public static function normalizeShipCreateData(Request $request): array
    {
        return self::baseNormalization($request, self::SHIP_CREATE_DATA_FIELDS);
    }

    public static function normalizePortCreateData(Request $request): array
    {
        return self::baseNormalization($request, self::PORT_CREATE_DATA_FIELDS);
    }

    public static function normalizeBerthingCreateData(Request $request): array
    {
        return self::baseNormalization($request, self::BERTHING_CREATE_DATA_FIELDS);
    }

    public static function normalizeBerthingUpdateData(Request $request): array
    {
        return self::baseNormalization($request, self::BERTHING_UPDATE_DATA_FIELDS);
    }
}
