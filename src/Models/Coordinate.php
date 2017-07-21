<?php

namespace KilroyWeb\Coordinates\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    protected $fillable = [
        'city',
        'state',
        'zipcode',
        'county',
        'latitude',
        'longitude',
    ];

    public static function getCounties($attributes=[]){
        $query = static::onlyValidStates()->groupBy('county')->orderBy('county','ASC');
        if(isset($attributes['zipcodes'])){
            $query->whereIn('zipcode',$attributes['zipcodes']);
        }
        return $query->get();
    }

    public static function getCountiesGroupedByState($attributes=[]){
        $stateModels = [];
        foreach(static::getCounties($attributes) as $model){
            if(!isset($stateModels[$model->state])){
                $stateModels[$model->state] = [];
            }
            $stateModels[$model->state][] = $model;
        }
        ksort($stateModels);
        return $stateModels;
    }

    public static function getZipcodesForStateCounty($state, $county){
        $zipcodes = [];
        $models = static::where('state',$state)->where('county',$county)->get();
        foreach($models as $model){
            $zipcodes[] = $model->zipcode;
        }
        sort($zipcodes);
        return $zipcodes;
    }

    public static function findByZipcode($zipcode){
        return static::where('zipcode',$zipcode)->first();
    }

}
