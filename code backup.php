<?php

//  thumbnail and move to S3
foreach ($request->file('images') as $key => $value) {
    $s3 = \Storage::disk('s3');
    $filenamewithextension = $value->getClientOriginalName();

    //get filename without extension
    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

    //get file extension
    $extension = $value->getClientOriginalExtension();

    //filename to store
    $filenametostore = $filename.'_'.time().'.'.$extension;

    //thumbnail name
    $thumbnail = $filename.'_thumbnail_'.time().'.'.$extension;

    //small thumbnail name
    $smallthumbnail = $filename.'_small_'.time().'.'.$extension;

    //medium thumbnail name
    $mediumthumbnail = $filename.'_medium_'.time().'.'.$extension;

    //large thumbnail name
    $largethumbnail = $filename.'_large_'.time().'.'.$extension;

    //Upload File
    $value->storeAs('public/listing_images', $filenametostore);
    $value->storeAs('public/listing_images/thumbnail', $thumbnail);
    $value->storeAs('public/listing_images/thumbnail', $smallthumbnail);
    $value->storeAs('public/listing_images/thumbnail', $mediumthumbnail);
    $value->storeAs('public/listing_images/thumbnail', $largethumbnail);

    //create small thumbnail
    $thumbnailpath = public_path('storage/listing_images/thumbnail/'.$smallthumbnail);
    $this->createThumbnail($thumbnailpath, 90, 50);

    $smallthumbnailpath = public_path('storage/listing_images/thumbnail/'.$smallthumbnail);
    $this->createThumbnail($smallthumbnailpath, 150, 93);

    //create medium thumbnail
    $mediumthumbnailpath = public_path('storage/listing_images/thumbnail/'.$mediumthumbnail);
    $this->createThumbnail($mediumthumbnailpath, 300, 185);

    //create large thumbnail
    $largethumbnailpath = public_path('storage/listing_images/thumbnail/'.$largethumbnail);
    $originalpath = public_path('storage/listing_images/'.$filenametostore);

    $this->createThumbnail($largethumbnailpath, 550, 340);
    $s3filePathlargeimage = '/large_image/' . $largethumbnail;
    $s3filePathmediumimage = '/medium_image/' . $mediumthumbnail;
    $s3filePathsmallimage = '/small_image/' . $smallthumbnail;
    $s3filePaththumbnailimage = '/thumbnail/' . $thumbnail;
    $s3filePathorigiinalimage = '/original/' . $filenametostore;


    $s3->put($s3filePathlargeimage, file_get_contents($largethumbnailpath), 'public');
    $s3->put($s3filePathmediumimage, file_get_contents($mediumthumbnailpath), 'public');
    $s3->put($s3filePathsmallimage, file_get_contents($smallthumbnailpath), 'public');
    $s3->put($s3filePaththumbnailimage, file_get_contents($thumbnailpath), 'public');
    $s3->put($s3filePathorigiinalimage, file_get_contents($originalpath), 'public');
}
