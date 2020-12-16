<?php
require_once "./classes/Auftrag.class.php";
require_once "./classes/Modus.class.php";
require_once "./repositories/Base.repo.php";

class AuftragRepository extends BaseRepository
{
    public static function update(int $id, string $col, $value)
    {
        $stmt = AuftragRepository::stmt("UPDATE kxi_auftraege SET $col = :value WHERE id = :id;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute(array("id" => $id, "value" => $value));
        return $stmt->fetch();
    }
    public static function setVisibility(int $id, bool $b)
    {
        return AuftragRepository::update($id, "visible", $b ? 1 : 0);
    }
    public static function updateModus(int $id, string $modus)
    {
        $modus = ModusRepository::findByKuerzel($modus);
        if (!$modus) {
            return false;
        }
        return AuftragRepository::update($id, "modeid", $modus->getID());
    }
}
