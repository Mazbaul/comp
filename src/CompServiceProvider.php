<?php

namespace Anik\Comp;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class CompServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->app['validator']->extend('composite_unique', function ($attribute, $value, $parameters, $validator) {
                  // Custom validation logic
                   $ign = explode('-',end($parameters));
                   //dd($ign);exit;
                   $ingid ='';
                   if($ign[0] == 'ignore'){
                     $ingid = $ign[1];
                     array_pop($parameters);
                   }

                  // remove first parameter and assume it is the table name
                  $table = array_shift( $parameters );

                  // start building the conditions
                  $fields = [ $attribute => $value ]; // current field

                  // iterates over the other parameters and build the conditions for all the required fields
                  while ( $field = array_shift( $parameters ) ) {
                      $fields[ $field ] = \Request::get( $field );
                  }
                  // query the table with all the conditions
                  $result = \DB::table( $table )
                               ->select( \DB::raw( 1 ) )
                               ->where( $fields )
                               ->when(!empty($ingid), function ($query) use($ingid){
                                      return $query->where('stl_id','!=',$ingid);
                                 })
                               ->first();

                  return empty( $result );
              },'This field has composite key validation');
      }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
