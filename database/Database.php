<?php

namespace App\Database;

use PDO;
use PDOException;
use PDOStatement;

/**
 * Class Database
 *
 * @package App\Database
 */
class Database
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * @var string
     */
    private string $dbName;

    /**
     * @var string
     */
    private string $dbUser;

    /**
     * @var string
     */
    private string $dbPassword;

    /**
     * @var string
     */
    private string $dbChar;

    /**
     * @var string
     */
    private string $dbHost;

    /**
     * @var string
     */
    private string $dbDriver;

    /**
     * @var bool|PDOStatement
     */
    private PDOStatement $stmt;

    /**
     * @var int
     */
    public int $fetchStyle = 4;


    /**
     * Connect to our database
     */
    public function connect()
    {
        $options = [
            //PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->dbDriver   ??= $_ENV['DB_DRIVER'];
        $this->dbHost     ??= $_ENV['DB_HOST'];
        $this->dbName     ??= $_ENV['DB_NAME'];
        $this->dbChar     ??= $_ENV['DB_CHARSET'];
        $this->dbUser     ??= $_ENV['DB_USERNAME'];
        $this->dbPassword ??= $_ENV['DB_PASSWORD'];

        $dsn = $this->dbDriver . ':host=' . $this->dbHost . ';dbname=' . $this->dbName . ';charset=' . $this->dbChar;

        try {
            $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPassword, $options);
        } catch (PDOException $e) {
            trigger_error("{$e->getMessage()} ErrorCode: {$e->getCode()}");
        }
    }

    /**
     * @param string $dbName
     * @return Database
     */
    public function setDbName(string $dbName): Database
    {
        $this->dbName = $dbName;
        return $this;
    }

    /**
     * @param string $dbUser
     * @return Database
     */
    public function setDbUser(string $dbUser): Database
    {
        $this->dbUser = $dbUser;
        return $this;
    }

    /**
     * @param string $dbPassword
     * @return Database
     */
    public function setDbPassword(string $dbPassword): Database
    {
        $this->dbPassword = $dbPassword;
        return $this;
    }

    /**
     * @param string $dbChar
     * @return Database
     */
    public function setDbChar(string $dbChar): Database
    {
        $this->dbChar = $dbChar;
        return $this;
    }

    /**
     * @param string $dbHost
     * @return Database
     */
    public function setDbHost(string $dbHost): Database
    {
        $this->dbHost = $dbHost;
        return $this;
    }

    /**
     * @param string $dbDriver
     * @return Database
     */
    public function setDbDriver(string $dbDriver): Database
    {
        $this->dbDriver = $dbDriver;
        return $this;
    }

    /**
     * @param       $sql
     * @param array $args
     *
     * @return $this|false|PDOStatement
     */
    public function prepare(string $sql, array $args = [])
    {
        $this->stmt = $this->pdo->prepare($sql);

        if (!empty($args)) {
            $this->stmt->execute($args);
        } else {
            $this->stmt->execute();
        }

        return $this;
    }

    /**
     * @param string $sql
     *
     * @return false|PDOStatement
     */
    public function query(string $sql)
    {
        return $this->pdo->query($sql);
    }

    /**
     * @param int $fetchStyle
     *
     * PDO::FETCH_LAZY   = 1, PDO::FETCH_ASSOC  = 2
     * PDO::FETCH_BOTH   = 4, PDO::FETCH_OBj    = 5
     * PDO::FETCH_COLUMN = 7, PDO::FETCH_CLASS  = 8
     *
     * @return mixed
     */
    public function fetchAll(int $fetchStyle = 0)
    {
        return $this->stmt->fetchAll($fetchStyle ? $fetchStyle : $this->fetchStyle);
    }

    /**
     * @return array
     */
    public function errorInfo()
    {
        return $this->stmt->errorInfo();
    }

    /**
     * @return string
     */
    public function errorCode()
    {
        return $this->stmt->errorCode();
    }

    /**
     * @param int $fetchStyle
     *
     * @return bool
     */
    public function fetch(int $fetchStyle = 0)
    {
        return $this->isConnected() ? $this->stmt->fetch($fetchStyle ? $fetchStyle : $this->fetchStyle) : false;
    }

    /**
     * @return mixed
     */
    public function fetchColumn()
    {
        return $this->isConnected() ? $this->stmt->fetchColumn() : false;
    }

    /**
     * @return string
     */
    protected function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @return mixed
     */
    private function isConnected()
    {
        return isset($this->pdo) && $this->stmt instanceof PDOStatement;
    }

    /**
     * Call native PDO methods.
     *
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public function __call(string $method, array $args)
    {
        return call_user_func_array([$this->pdo, $method], $args);
    }

    /**
     * Destroy connection
     */
    public function __destruct()
    {
        unset($this->pdo);
    }
}
