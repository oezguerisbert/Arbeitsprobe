<?php
if (!isset($_SESSION)) {
    session_start();
}

/**
 * Datenbank Klasse
 *
 * Diese Klasse ist die Schnittstelle für sämtliche Datenbank-Aufrufe.
 * Sie automatisiert den Prozess und enthält Konfigurationen.
 *
 * Falls keine Konfiguration vorhanden ist wird diese getriggert und muss eingereicht werden.
 *
 * Beim entfernen der Datei `migration.lock` wird die Datenbank erneust befüllt, bzw resetted.
 */
class DB
{
    private static $_servername = "localhost";
    private static $_username = "root";
    private static $_password = "root";
    private static $_name = "mytable";
    private static $_conn = null;
    private static $_port = 3306;
    private static $_migrated = false;
    private static $_migrating = false;

    /**
     * Connection maker
     */
    private static function connection()
    {
        if (DB::$_conn === null) {
            try {
                $configFile = __DIR__ . "/../config.json";
                if (file_exists($configFile)) {
                    $config = file_get_contents(__DIR__ . "/../config.json");
                    $json = json_decode($config, true);
                    $db = $json['database'];
                    DB::$_servername = $db['host'];
                    DB::$_port = $db['port'];
                    DB::$_username = $db['user'];
                    DB::$_password = $db['password'];
                    DB::$_name = $db['dbname'];
                }
                $_conn = new PDO("mysql:host=" . DB::$_servername . ";port=" . DB::$_port . ";dbname=" . DB::$_name . "", DB::$_username, DB::$_password);
                // set the PDO error mode to exception
                $_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                DB::$_conn = $_conn;
                if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/Arbeitsprobe/migration.lock") && (isset($config) && ($db['migrate'] ?? true))) {
                    $res = DB::migrate();
                    DB::$_migrated = $res["result"];
                    if (count($res["errors"]) > 0) {
                        foreach ($res["errors"] as $err) {
                            print_r(array($err[0]), $err[1]);
                        }
                    }
                    fclose(fopen($_SERVER['DOCUMENT_ROOT'] . "/Arbeitsprobe/migration.lock", "a+"));
                    session_destroy();
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return DB::$_conn;
    }
    /**
     * Migration
     *
     * Migriert alle SQL-Dateien vom `sql/creates` & `sql/bundle` Ordner auf die Datenbank.
     *
     * @return boolean resultat der Migration
     */
    private static function migrate()
    {
        DB::$_migrating = true;
        $sqls = array();

        foreach (new DirectoryIterator(__DIR__ . '/../sql/bundle/') as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isDir()) {
                continue;
            }
            $sqls[] = file_get_contents($file->getPath() . "/" . $file->getFilename());

        }
        $result = true;
        $errors = array();
        foreach ($sqls as $key => $sql) {
            $c = DB::connection();
            try {
                $sqlResult = $c->exec($sql);

                $result &= $sqlResult;
            } catch (\Exception $e) {
                $errors[] = array($sql, $e->getMessage());
            }

        }
        return array("result" => $result, "errors" => $errors);
    }

    public static function reset()
    {
        $configFile = __DIR__ . "/../config.json";
        $result = null;
        if (file_exists($configFile)) {
            $config = json_decode(file_get_contents($configFile), true)['database'];
            $conn = new PDO("mysql:host=" . $config['host'] . ";port=" . $config['port'] . ";dbname=sys", $config['user'], $config['password']);
            $resetSQL = "DROP DATABASE IF EXISTS :dbname; CREATE DATABASE IF NOT EXISTS :dbname;";
            $prepareValues = array(":dbname" => $config['dbname']);
            foreach ($prepareValues as $pK => $pV) {
                $resetSQL = str_replace($pK, $pV, $resetSQL);
            }
            try {
                $result = $conn->exec($resetSQL);
            } catch (Exception $ex) {
                $result = $ex->getMessage();
            }
        }
        return $result;

    }

    /**
     * Migrations-Check
     *
     * Checkt ob die Migration durch ist.
     *
     * @return boolean migration
     */
    public static function checkMigration()
    {
        return DB::migrate();
    }

    /**
     * Runs the Query in a transaction
     *
     * @param string $sql
     * @param array $array
     */
    protected static function run(string $sql, array $values = null, string $fetchmode = null, $finalExecution = "")
    {
        $conn = DB::connection();
        $result = null;
        try {

            $conn->beginTransaction();
            $stmt = $conn->prepare($sql);
            $result2 = null;
            if ($values !== null) {
                $result2 = $stmt->execute($values);
            } else {
                $result2 = $stmt->execute();
            }
            if ($fetchmode !== null) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, $fetchmode);
            }

            if ($finalExecution != "") {
                $result = $stmt->$finalExecution();
            } else {
                $result = $result2;
            }

            $conn->commit();
        } catch (PDOException $e) {
            $result = array("error" => Errors::get(intval($e->getCode()), $e));
            $conn->rollBack();
        }

        return $result;
    }

}
