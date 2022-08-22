<?php
namespace App\Traits;

use DateTimeInterface;

trait DataTrait{

    protected function serializeDate(DateTimeInterface $date)
    {
        return jdate($date)->format('Y-m-d H:i:s');
    }
}
