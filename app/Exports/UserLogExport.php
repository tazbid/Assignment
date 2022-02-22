<?php

namespace App\Exports;

use App\Models\UserLogModel;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserLogExport implements FromCollection, WithMapping, WithHeadings
{
    public function headings(): array
    {
        return [
            'Id',
            'User',
            'IP',
            'Request',
            'Url',
            'Referer',
            'Languages',
            'User Agent',
            'Headers',
            'Device',
            'Platform',
            'Browser',
            'Created At',
            'Updated At',
        ];
    }
   
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return UserLogModel::with('user')->get();
    }

     /**
     * @var log $log
     */
    public function map($log): array
    {
        return [
            $log->id,
            $log->visitor_id ? $log->user->name: "guest(".$log->ip.")",
            $log->ip,
            $log->request,
            $log->url,
            $log->referer,
            $log->languages,
            $log->useragent,
            $log->headers,
            $log->device,
            $log->platform,
            $log->browser,
            $log->created_at,
            $log->updated_at,
        ];
    }
}
