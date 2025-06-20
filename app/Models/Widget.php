<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model {

    protected $table = 'widgets';

    protected $fillable = [
        'key',
        'image',
        'title',
        'content',
        'active'
    ];

    public static function getTitle( string $key ) {
        $widget = Widget::query()->where( 'key', '=', $key )->where( 'active', '=', 1 )->first();

        if ( $widget ) {
            return $widget->title;
        } else '';
    }
    public static function getContent( string $key ) {
        $widget = Widget::query()->where( 'key', '=', $key )->where( 'active', '=', 1 )->first();

        if ( $widget ) {
            return $widget->content;
        } else '';
    }
}
