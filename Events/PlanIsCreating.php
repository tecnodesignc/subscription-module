<?php
namespace Modules\Subscription\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class PlanIsCreating  extends AbstractEntityHook implements EntityIsChanging
{

}
