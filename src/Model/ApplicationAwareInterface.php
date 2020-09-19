<?php

declare(strict_types=1);

namespace FromHome\Common\Model;

use Illuminate\Contracts\Foundation\Application;

interface ApplicationAwareInterface extends ContainerAwareInterface
{
    public function getApplication(): Application;

    /**
     * @return mixed
     */
    public function setApplication(Application $application);
}
