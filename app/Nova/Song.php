<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Audio;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;

class Song extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Song>
     */
    public static $model = \App\Models\Song::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static function indexQuery (NovaRequest $request, $query){

        if ($request->user()->role !== 'admin') {
            return $query -> where('artist_id', '=', $request->user()->id);
        }

        
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'feat', 'relise', 'mus_author', 'text_author'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {

        // $request->artist_id = $request->user()->id;
        return [

           // 'cover', 'track', 'artist', 'feat', 'name', 'description', 'relise', 'obscense', 'jenre', 'languge', 'musAutor', 'txtAuthor', 'songText',

            // Number::make('Artist_id')
            // -> default($request->user()->id),

            // 'artist_id' => $request->user()->id,

           Audio::make('Трэк', 'track')
           -> disk('public')
           -> acceptedTypes('.wave,.mp3')
           -> rules(['mimes:wave,mp3'])
           -> disableDownload()
           -> path('uid-'.$request->user()->id . '/songs')
           -> storeAs(function(Request $request) {
                $ext = explode('.', $request->track->getClientOriginalName());
                return $request->slug . '.' . end($ext);
           })
           -> required(),
           
           Slug::make('Slug')->from('name')
           -> required()
           -> withMeta(['extraAttributes' => [
               'readonly' => true,
               'type' => 'hidden',
           ]]),

            Text::make('Имя', 'name')
            -> required()
            -> creationRules('unique:songs,name')
            -> updateRules('unique:songs,name,{{recourceId}}')
            -> default('тест_1'),

            Textarea::make('Описание', 'description')-> required() -> default('какое то описание'),

            Image::make('Обложка', 'cover')
            -> acceptedTypes('.jpg,.jpeg,.png')
            -> rules(['mimes:jpg,jpeg,png'])
            -> disableDownload()
            -> path('uid-'.$request->user()->id . '/songs')
            -> storeAs(function(Request $request) {
                $ext = explode('.', $request->cover->getClientOriginalName());
                return $request->slug . '.' . end($ext);
            })
            // -> thumbnail(function () {
            //     return $this->cover;
            // })
            // ->preview(function () {
            //     return $this->cover;
            // })
            -> required(),

            // Image::make('Cover'),

            Text::make('Исполнитель', 'artist')
            -> required()
            ->default($request->user()->name),

            Text::make('Совместно', 'feat')-> nullable()-> default('хуит'),
            Date::make('дата релиза', 'relise')-> required(),
            Boolean:: make('Ненормативная лексика', 'obscense')-> required(),
            MultiSelect::make('Жанр', 'jenre')
            -> options([
                'rock' => 'рок',
                'rap' => 'рап',
                'pop' => 'поп',
                'hip-hop' => 'хип-хоп',
                'metal' => 'митол',
                'alternative' => 'альтернатива',
                'punk' => 'панк',
            ])
            -> required(),

            //Tag::make('JenreTags'),

            Text::make('Язык','languge')-> required()->default('ru'),
            Text::make('Автор музыки','mus_author')-> required()->default($request->user()->name),
            Text::make('Автор текста','text_author')-> required()->default($request->user()->name),
            Textarea::make('Текст песни','song_text')-> default('null')

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
