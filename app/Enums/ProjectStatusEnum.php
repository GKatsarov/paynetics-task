<?php



namespace App\Enums;



enum ProjectStatusEnum:string {

   case New = 'new';
   case Pending = 'pending';
   case Failed = 'failed';
   case Done = 'done';
}
