<?php
namespace App\Traits;

use App\Models\PendaftaranAnggota;
use Illuminate\Support\Str;

trait UserStatusTrait
{

    public function spanStatus(string $status)
    {

        switch (\Str::lower($status)) {
            case 'waiting':
                $badge = 'badge-light-warning';
                break;

            case 'active':
                $badge = 'badge-light-success';
                break;

            case 'overdue':
                $badge = 'badge-light-primary';
                break;

            case 'decline':
                $badge = 'badge-light-danger';
                break;

            default:
                $badge = 'badge-light-default';
                break;
        }
        return '<span class="badge '.$badge.'>'.Str::upper($status).'</span>';
    }

}
