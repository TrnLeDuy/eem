<?php

namespace Modules\Contact\Repositories\Cache;

use Modules\Contact\Repositories\ContactDetailRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheContactDetailDecorator extends BaseCacheDecorator implements ContactDetailRepository
{
    public function __construct(ContactDetailRepository $contactdetail)
    {
        parent::__construct();
        $this->entityName = 'contact.contactdetails';
        $this->repository = $contactdetail;
    }
}
