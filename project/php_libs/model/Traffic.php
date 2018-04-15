<?php
class Traffic extends Database
{
    const TABLE = 'traffics';

    public function getIndex()
    {
        $fetch_traffics = $this->select(self::TABLE);
        foreach ($fetch_traffics as $traffic) {
            $traffics[$traffic['id']] = $traffic['name'];
        }
        return $traffics;
    }
}
