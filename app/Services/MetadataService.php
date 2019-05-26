<?php
namespace App\Services;
use App\Metadata;
use Bouncer;

class MetadataService
{

    public function destroy(Metadata $metadata) : void
    {
        Disc::Where('metadata_id', $metadata)->update(array('metadata_id',NULL ));
        $metadata->delete();
        return;
    }

}
