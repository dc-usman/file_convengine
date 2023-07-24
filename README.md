# Conversion Engine

This is a file conversion platform

TODO

# preserving orignal file by
addMedia()->preservingOriginal()->
MediaCollection();

# Modification of name and filename
addMedia()->usingname()->usingFileName()->withCustomProperties([
    'location' => 'Dublin ireland',
    'subject ' => 'library'])->toMediaCollection()

# deleting media
call delete on a model itself
laravel will fire the delete listener on the model and delete the respected media as well

Article::first()->delete;   


where as in other case wont delete the media automatically
Article::where('category_id',1)->delete   

# Downloading Media
the easiest way is to retrive media instace direct
it is resposible and converted itself to http request

return $media

# Retriveing Multiple Media at Once
 leave all media files before truncate 
Media::truncate ;

return MediaStream::create('your_file.zip')->addMedia(Media::all());

# lets define collection with behaviour

in your model add registerMediaCollections(){

     delete old files ,put validations

    $this->addMediaCollection('big-files')
    ->useDisk('s3')->singleFile()->acceptFile(function(File $file){
        return $file->mimeType === 'image/jpeg';
    });

    Put only single file in one collection and delete old files

     $this->addMediaCollection('big-files')
    ->useDisk('s3')->singleFile();          
}

# Regenerate Conversions
you have regenerate media conversion whenever you change the specifications of conversion
by 
php artisan media:regenerate 

# Get the path of Generated Conversion/orginal file path/orginal file url

yourModel::getFirstMedia('images')->getUrl('thumb');
yourModel::getFirstMedia('images')->getUrl();
yourModel::getFirstMedia('images')->getPath();

# nonqueued conversions

By default conversion are qued but you can also perform nonqueed conversions
$this->addMediaConversion('admin')->nonQueued()->width(100)->height(100);

# Image Optimizers

the default optimizers work like executing the batch command 
most of the times the defaults are enough.

# Saving Bandwidth with responsive images (wow feature)

with src-set in the browser you provide multiple images and depending upon the width 
the browser will pick one .
Media library will do the things like push the blured version and then downloaded the full image

YourModel::addMedia()->withResponsiveImages()->toMediaCollection()







