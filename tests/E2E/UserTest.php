<?php

/**
 * This file is part of the contentful-management.php package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */
declare(strict_types=1);

namespace Contentful\Tests\Management\E2E;

use Contentful\Tests\Management\BaseTestCase;

class UserTest extends BaseTestCase
{
    /**
     * @vcr e2e_user_get_me.json
     */
    public function testGetOwnUser()
    {
        $user = $this->getClient()->getUserMe();

        $this->assertSame('PHP SDK', $user->getFirstName());
        $this->assertSame('Tests', $user->getLastName());
        $this->assertSame('cidevdocs+php@contentful.com', $user->getEmail());
        $this->assertSame('https://www.gravatar.com/avatar/6474b043cb2a58f34b0576ccf83d56e2?s=50&d=https%3A%2F%2Fstatic.contentful.com%2Fgatekeeper%2Fusers%2Fdefault-43783205a36955c723acfe0a32bcf72eebe709cac2067249bc80385b78ccc70d.png', $user->getAvatarUrl());
        $this->assertTrue($user->isActivated());
        $this->assertTrue($user->isConfirmed());
        $this->assertInternalType('integer', $user->getSignInCount());
        $this->assertGreaterThan(1, $user->getSignInCount());
        $this->assertSame('4Q3e6duhma7V6czH7UXHzE', $user->getId());
        $this->assertLink('4Q3e6duhma7V6czH7UXHzE', 'User', $user->asLink());
        $this->assertSame('User', $user->getSystemProperties()->getType());

        $this->assertSame([], $user->asUriParameters());
    }
}
