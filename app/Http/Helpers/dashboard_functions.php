<?php


use App\Models\Admin;
use Illuminate\Support\Facades\Cache;
use App\Notifications\NewNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;


if(!function_exists('getRelationWithColumns')){

    function getRelationWithColumns($relations) : array
    {
        $relationsWithColumns = [];

        foreach ( $relations as $relation => $columns)
        {
            array_push($relationsWithColumns , $relation . ":" . implode(",",$columns));
        }

        return $relationsWithColumns;
    }

}

if ( !function_exists('getModelData') ) {

    function getModelData(Model $model, $relations = [], $orsFilters = [] , $andsFilters = [], $searchingColumns = null, $onlyTrashed = false) : array
    {

        $columns              = $searchingColumns ?? $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
        $relationsWithColumns = getRelationWithColumns($relations); // this fn takes [ brand => [ id , name ] ] then returns : brand:id,name to use it in with clause

        /** Get the request parameters **/
        $params = request()->all();

        // set passed filters from controller if exist
        if(!$onlyTrashed)
            $model   = $model->query()->with($relationsWithColumns);
        else
            $model   = $model->query()->onlyTrashed()->with( $relationsWithColumns );


        /** Get the count before search **/
        $itemsBeforeSearch = $model->count();

        // general search
        if(isset($params['search']['value']))
        {

            if (str_starts_with($params['search']['value'], '0'))
                $params['search']['value'] = substr($params['search']['value'], 1);

            /** search in the original table **/
            foreach ( $columns as $column)
                array_push($orsFilters, [ $column, 'LIKE', "%" . $params['search']['value'] . "%" ]);

        }

        // filter search
        if ($itemsBeforeSearch == $model->count()) {

            $searchingKeys = collect( $params['columns'] )->transform(function($entry) {

                return $entry['search']['value'] != null && $entry['search']['value'] != 'all' ? Arr::only( $entry , ['data', 'name' ,'search']) : null; // return just columns which have search values

            })->whereNotNull()->values();


            /** if request has filters like status **/
            if ( $searchingKeys->count() > 0  )
            {

                /** search in the original table **/
                foreach ($searchingKeys as $column)
                {
                    if ( ! ( $column['name'] == 'created_at' or  $column['name'] == 'date' ) )
                        array_push($andsFilters, [ $column['name'], '=',  $column['search']['value'] ]);
                    else
                    {
                        if( ! str_contains($column['search']['value'] , ' - ') ) // if date isn't range ( single date )
                            $model->orWhereDate( $column['name'] , $column['search']['value']);
                        else
                            $model->orWhereBetween( $column['name'] , getDateRangeArray( $column['search']['value'] ));
                    }
                }

            }

        }

        $model   = $model->where( function ($query) use ( $orsFilters ) {
            foreach ($orsFilters as  $filter)
            $query->orWhere([$filter]);
        });

        if ( $andsFilters )
            $model->where($andsFilters);

        if(isset($params['order'][0]))
        {
            $model->orderBy($params['columns'][$params['order'][0]['column']]['data'], $params['order'][0]['dir']);
        }

        $response = [
            "recordsTotal" => $model->count(),
            "recordsFiltered" => $model->count(),
            'data' => $model->skip($params['start'])->take($params['length'])->get()
        ];

        return $response;
    }
}


function storeAndPushNotification($title, $description, $url){
    /** add notification to first Admin **/
    $date = \Carbon\Carbon::now()->diffForHumans();
    $notification = new NewNotification($title, $description, $date,$url);
    $admin = Admin::first();
    $admin->notify($notification);

    /** push notifications to all admins **/
    $firebaseToken = Admin::whereNotNull('device_token')->pluck('device_token')->all();
    $SERVER_API_KEY = "AAAA_VGhzmU:APA91bGzau0KL1-qnUsxQs5OjcUa-6oGOoTVTPQb1yKrhRXcsM5AROUgR8_U6SVBi8zex3WqJkTj8DS4CJZUCg553qaArGnojwOHW4gqvWHZD-XY2Yti85Jh4-wk6WO12drTaXI3vycY";

    $data = [
        "registration_ids" => $firebaseToken,
        "notification" => [
            "alert_title" => $title,
            "title" => $title,
            "description" => $description,
            "date" => $date,
            "icon" => 'https://info.cegedim-healthcare.co.uk/hubfs/CHS_Tasks%20logo.png',
            "url" => $url,
            "id" => $admin->notifications->last()->id,
        ]
    ];

    $response = Http::withHeaders([
        "Authorization" => "key=$SERVER_API_KEY",
    ])->post('https://fcm.googleapis.com/fcm/send', $data);

    return $response;
}