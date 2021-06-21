<?php

declare(strict_types=1);

/*
 * This file is part of the EasyWeChatComposer.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyBaiduComposer\Traits;

use EasyBaidu\Kernel\BaseClient;
use EasyBaiduComposer\Delegation\DelegationTo;
use EasyBaiduComposer\EasyBaidu;

trait WithAggregator
{
    /**
     * Aggregate.
     */
    protected function aggregate()
    {
        foreach (EasyBaidu::config() as $key => $value) {
            $this['config']->set($key, $value);
        }
    }

    /**
     * @return bool
     */
    public function shouldDelegate($id)
    {
        return $this['config']->get('delegation.enabled')
            && $this->offsetGet($id) instanceof BaseClient;
    }

    /**
     * @return $this
     */
    public function shouldntDelegate()
    {
        $this['config']->set('delegation.enabled', false);

        return $this;
    }

    /**
     * @param string $id
     *
     * @return \EasyBaiduComposer\Delegation
     */
    public function delegateTo($id)
    {
        return new DelegationTo($this, $id);
    }
}
