<?php

namespace App\EmailProvider;

use SendinBlue\Client\Model\GetLists;

class SendInBlueApiTransform
{
    public static function getSelectList( GetLists $results ) : array
    {
        $transform = [];

        foreach ($results->getLists() as $row) {
            $transform[] = [
                'id' => $row['id'],
                'name' => $row['name'],
            ];
        }

        return  $transform;
    }

}
