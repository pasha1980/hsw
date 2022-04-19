<?php


namespace Context\Shipment\Factory;


use App\Models\File;
use App\Models\Port as DBPort;
use App\Models\Ship as DBShip;
use Context\Shipment\Entity\Berthing;
use Context\Shipment\Repository\BerthingRepository;
use Exception;
use App\Models\Berthing as DBBerthing;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class BerthingFactory
{
    /**
     * [
     *     "port" => 1,
     *     "ship" => 1,
     *     "pdf" => 1,
     *     "start" => "YYYY-mm-dd HH:ii:ss",
     *     "end" => "YYYY-mm-dd HH:ii:ss",
     *     "cargo" => "string",
     *     "const" => 1,
     *     "problems" => "string",
     *     "isLoad" => true,
     *     "isShortage" => true
     * ]
     * @param array $data
     * @return Berthing
     * @throws Exception
     */
    public static function create(array $data): Berthing
    {
        $dbBerthing = new DBBerthing();
        $dbBerthing->setPort(DBPort::query()->find($data['port'] ?? 0));
        $dbBerthing->setShip(DBShip::query()->find($data['ship'] ?? 0));
        $dbBerthing->setFile(File::query()->find($data['pdf'] ?? 0));
        $dbBerthing->dateStart = new \DateTime($data['start'] ?? null);
        $dbBerthing->dateEnd = new \DateTime($data['end']?? null);
        $dbBerthing->cargo = $data['cargo'] ?? null;
        $dbBerthing->const = $data['const'] ?? null;
        $dbBerthing->problems = $data['problems'] ?? null;
        $dbBerthing->isLoad = $data['isLoad'] ?? null;
        $dbBerthing->isShortage = $data['isShortage'] ?? null;

        try {
            $dbBerthing->save();
        } catch (Exception $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage());
        }

        return BerthingRepository::normalize($dbBerthing);
    }
}
