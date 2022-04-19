<?php


namespace Context\Shipment;


use Illuminate\Http\Request;

class PayloadService
{
    private const SHIP_REQUEST_DATA_FIELDS = [
        'name',
        'imo',
        'residence',
        'residencePort',
        'photo'
    ];

    private const PORT_REQUEST_DATA_FIELDS = [
        'name'
    ];

    private const BERTHING_REQUEST_DATA_FIELDS = [
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

    public static function normalizeShipRequestData(Request $request): array
    {
        return self::baseNormalization($request, self::SHIP_REQUEST_DATA_FIELDS);
    }

    public static function normalizePortRequestData(Request $request): array
    {
        return self::baseNormalization($request, self::PORT_REQUEST_DATA_FIELDS);
    }

    public static function normalizeBerthingRequestData(Request $request): array
    {
        return self::baseNormalization($request, self::BERTHING_REQUEST_DATA_FIELDS);
    }
}
